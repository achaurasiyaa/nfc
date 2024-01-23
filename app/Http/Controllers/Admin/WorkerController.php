<?php

namespace App\Http\Controllers\Admin;

use App\Worker;
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
    public function index()
    {

        abort_if(Gate::denies('worker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workers = Worker::all();

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
    public function Vimport(array $row)
    {
        return new Worker([
            'name' => $row[0],
            'email' => $row[1],
            // Add other fields as needed
        ]);
    }
    
    public function CbulkUpload(Request $request)
    {
        // dd($request);
        // $request->validate([
        //     'csv_file' => 'required|file|mimes:csv,txt',
        // ]);

        try {
            // $import = new WorkersImport();
            
            Excel::import($this->Vimport($request->file('csv_file')) );

            return back()->with('success', 'Bulk upload successful!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error uploading CSV file: ' . $e->getMessage());
        }
    }

    public function DbulkUpload(StoreWorkerRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'csv_file' => 'required|file|mimes:csv,txt',
        // ]);

        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }
        // dd('ss');
        try {
            $file = $request->file('csv_file');
            // dd($file);
            $handle = fopen($file->getRealPath(), "r");
            // dd($request);
            // Skip the header row if it exists
            $header = fgetcsv($handle, 1000, ",");

            $workers = [];

            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                // Add each worker to the array
                $workers[] = [
                    'name' => $row[0],
                    'email' => $row[1],
                    'gate_pass_number' => $row[2], // Adjust column indices based on your CSV
                    'vendor_id' => $row[3], // Adjust column indices based on your CSV
                    // Add other fields as needed
                ];
            }

            fclose($handle);
            dd($workers);
            // Insert workers in a single batch
            Worker::insert($workers);

            return back()->with('success', 'Bulk upload successful!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error uploading CSV file: ' . $e->getMessage());
        }
    }


    // public function bulkUpload(Request $request)
    // {
    //     $file = $request->file('file');
    //     $fileContents = file($file->getPathname());

    //     foreach ($fileContents as $line) {
    //         $data = str_getcsv($line);

    //         Worker::create([
    //             'name' => $data[0],
    //             'gate_pass_number' => $data[1],
    //             'vendor_id' => $data[2],
    //             // Add more fields as needed
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'CSV file imported successfully.');
    // }
    public function bulkUpload(Request $request)
    {
        // Check if a file is present in the request
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Check if the file is valid
            if ($file->isValid()) {
                $fileContents = file($file->getPathname());

                foreach ($fileContents as $line) {
                    $data = str_getcsv($line);
        dd($data);
                    Worker::create([
                        'name' => $data[0],
                        'gate_pass_number' => $data[1],
                        'vendor_id' => $data[2],
                        // Add more fields as needed
                    ]);
                }

                return redirect()->back()->with('success', 'CSV file imported successfully.');
            } else {
                // Handle invalid file
                return redirect()->back()->with('error', 'Invalid file uploaded.');
            }
        } else {
            // Handle case when no file is uploaded
            return redirect()->back()->with('error', 'No file uploaded.');
        }
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

}
