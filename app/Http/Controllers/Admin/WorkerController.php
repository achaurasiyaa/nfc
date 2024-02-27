<?php

namespace App\Http\Controllers\Admin;

use App\Worker;
use App\Vendor;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkerRequest;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Maatwebsite\Excel\Facades\Excel;



class WorkerController extends Controller
{
    public function index(Request $request)
    {

        abort_if(Gate::denies('worker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query = Worker::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('gate_pass_number', 'like', '%' . $searchTerm . '%');
        }

        $workers = $query->paginate(20);
        // $workers = Worker::paginate(10);

        // $workers = Worker::all();

        return view('admin.workers.index', compact('workers'));
    }

    public function create()
    {
        abort_if(Gate::denies('worker_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workers.create');
    }

    public function store(StoreWorkerRequest $request)
    {
        $worker = Worker::create($request->all());

        return redirect()->route('admin.worker.index');

    }

    public function edit(Worker $worker)
    {
        abort_if(Gate::denies('worker_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workers.edit', compact('worker'));
    }

    public function update(UpdateworkerRequest $request, Worker $worker)
    {
        try
        {
            $worker->update($request->all());
        }
        catch (\Exception $e) {
            // Log or display the error message
            dd($e->getMessage());
        }

        return redirect()->route('admin.worker.index');

    }

    public function show(Worker $worker)
    {
        abort_if(Gate::denies('worker_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workers.show', compact('worker'));
    }

    public function destroy(Worker $worker)
    {
        abort_if(Gate::denies('worker_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worker->delete();

        return back();

    }

    public function massDestroy(MassDestroyWorkerRequest $request)
    {
        Worker::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function addWorkers(Worker $request)
    {
        return view('workers.create');
    }

    public function getWorkerDetailsByGatePassNumber(Request $request)
    {
        dd('1111111');
        // Validate the request
        $request->validate([
            'gate_pass_number' => 'required|string',
        ]);

        // Get worker details based on the gate pass number
        $workerDetails = Worker::where('gate_pass_number', $request->input('gate_pass_number'))->first();

        if (!$workerDetails) {
            // Worker not found, return an error response
            return response()->json(['error' => 'Worker not found'], 404);
        }

        // Return the worker details as JSON response
        return response()->json(['worker' => $workerDetails]);
    }

    // public function bulkUpload(Request $request)
    // {
    //     // Check if a file is present in the request
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         if ($file->isValid()) {
    //             $fileContents = file($file->getPathname());

    //             // Extract headers from the first line
    //             $headers = str_getcsv(array_shift($fileContents));

    //             foreach ($fileContents as $line) {
    //                 $data = str_getcsv($line);
    //                 if (count($headers) !== count($data)) {
    //                     dd("Mismatch in row : Headers count does not match data count");
    //                 }
    //                 $rowData = array_combine($headers, $data);

    //                 $existingRecord = Worker::where('gate_pass_number', $rowData['gate_pass_number'])->exists();;
    //                 $vendorIdExists = Vendor::where('id', $rowData['vendor_id'])->exists();

    //                 if (!$existingRecord && $vendorIdExists) {
    //                     Worker::create([
    //                         'name' => $rowData['name'],
    //                         'gate_pass_number' => $rowData['gate_pass_number'],
    //                         'mobile' => $rowData['mobile'],
    //                         'vendor_id' => $rowData['vendor_id'],

    //                         // Add more fields as needed
    //                     ]);
    //                 } else {
    //                     // Skip the record as gate_pass_number is already registered
    //                     // You can log or handle this case as needed
    //                     continue;
    //                 }
    //             }

    //             return redirect()->back()->with('success', 'File imported successfully.');
    //         } else {
    //             // Handle invalid file
    //             return redirect()->back()->with('error', 'Invalid file uploaded.');
    //         }
    //     } else {
    //         // Handle case when no file is uploaded
    //         dd('No file uploaded.'); // Add a helpful message for debugging
    //         return redirect()->back()->with('error', 'No file uploaded.');
    //     }
    // }

    public function bulkUpload(Request $request)
    {
        // Check if a file is present in the request
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if ($file->isValid()) {
                $fileContents = file($file->getPathname());

                // Extract headers from the first line
                $headers = str_getcsv(array_shift($fileContents));

                $existingRecordsToDownload = [];

                foreach ($fileContents as $line) {
                    $data = str_getcsv($line);
                    if (count($headers) !== count($data)) {
                        dd("Mismatch in row : Headers count does not match data count");
                    }
                    $rowData = array_combine($headers, $data);

                    $existingRecord = Worker::where('gate_pass_number', $rowData['gate_pass_number'])->exists();
                    $vendorIdExists = Vendor::where('id', $rowData['vendor_id'])->exists();

                    if (!$existingRecord && $vendorIdExists) {
                        Worker::create([
                            'name' => $rowData['name'],
                            'gate_pass_number' => $rowData['gate_pass_number'],
                            'mobile' => $rowData['mobile'],
                            'vendor_id' => $rowData['vendor_id'],
                            // Add more fields as needed
                        ]);
                    } else {
                        // Record exists, add it to the list for download
                        $existingRecordsToDownload[] = $rowData;
                    }
                }

                // Create a CSV file with existing records
                $csvFileName = 'faield_report.csv';
                $csvFilePath = storage_path('app/' . $csvFileName);

                $file = fopen($csvFilePath, 'w');
                fputcsv($file, $headers); // Write headers

                foreach ($existingRecordsToDownload as $record) {
                    fputcsv($file, $record);
                }

                fclose($file);

                // Provide a link to download the CSV file
                return response()->download($csvFilePath)->deleteFileAfterSend(true);
            } else {
                // Handle invalid file
                return redirect()->back()->with('error', 'Invalid file uploaded.');
            }
        } else {
            // Handle case when no file is uploaded
            dd('No file uploaded.'); // Add a helpful message for debugging
            return redirect()->back()->with('error', 'No file uploaded.');
        }
    }
    public function downloadCsvTemplate()
    {
        $headers = ['name', 'gate_pass_number', 'mobile', 'vendor_id']; // Add more headers as needed

        // Create a CSV file with headers only
        $csvFileName = 'csv_template.csv';
        $csvFilePath = storage_path('app/' . $csvFileName);

        $file = fopen($csvFilePath, 'w');
        fputcsv($file, $headers);
        fclose($file);

        // Provide a link to download the CSV file
        return response()->download($csvFilePath)->deleteFileAfterSend(true);
    }


    public function searchWorker(Request $request)
    {
        $gatePassNumber = $request->input('gate_pass_number');
        $worker = Worker::where('gate_pass_number', 'like', '%' . $gatePassNumber . '%')->first();
        return response()->json(['name' => $worker ? $worker->name : '']);
    }

}
