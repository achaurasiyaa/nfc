<?php

namespace App\Http\Controllers\Admin;

use App\Vendor;
use App\Worker;
use App\IssueRecord;
Use App\ItemNfcRel;
use App\Item;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVendorRequest;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class IssueRecordController extends Controller
{
    // public function index()
    // {
    //     // dd('ew');
    //     abort_if(Gate::denies('issue_record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $issueRecords = IssueRecord::all();
    //     foreach($issueRecords as $issueRecord ){
    //         $worker = Worker::find($issueRecord->worker_id);
    //       $vendor = Vendor::find($worker->vendor_id);
          
    //     }
    //     dd($issueRecord);

    //     return view('admin.issue_record.index', compact('issueRecord'));
    // }
    public function index()
{
    // Check for permission (assuming you are using Gates)
    abort_if(Gate::denies('issue_record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    // Fetch all issue records with related data
    $issueRecords = IssueRecord::with(['worker.vendor', 'nfcTag.item'])->get();

    // You can use the following loop to access related data
    foreach ($issueRecords as $issueRecord) {
        // Access related data
        $workerName = $issueRecord->worker->name;
        $vendorName = $issueRecord->worker->vendor->name;
        $nfcTagId = $issueRecord->nfcTag->nfc_serial_number;
        $itemName = $issueRecord->nfcTag->item->name;

        // Do something with the data (e.g., create a new structure to pass to the view)
        $formattedIssueRecords[] = [
            'worker_name' => $workerName,
            'vendor_name' => $vendorName,
            'nfc_tag_id' => $nfcTagId,
            'item_name' => $itemName,
            'issue_date' => $issueRecord->issue_date,
            'is_expired' => $issueRecord->is_expired,
            'expire_date' => $issueRecord->expire_date,
            // Add other fields as needed
        ];
    }

    // dd($formattedIssueRecords); // Uncomment for debugging

    return view('admin.issue_record.index', compact('formattedIssueRecords'));
}

    public function create()
    {
        // dd('wqar');
        abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vendor.create');
    }

    public function store(StoreVendorRequest $request)
    {
        // dd($request);
        $vendor = Vendor::create($request->all());

        return redirect()->route('admin.vendor.index');

    }

    public function edit(Vendor $vendor)
    {
        // dd('asd');
        abort_if(Gate::denies('vendor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vendor.edit', compact('vendor'));
    }

    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        try
        {
            $vendor->update($request->all());
        }
        catch (\Exception $e) {
            // Log or display the error message
            dd($e->getMessage());
        }

        return redirect()->route('admin.vendor.index');

    }

    public function show(Vendor $vendor)
    {
        abort_if(Gate::denies('vendor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vendor.show', compact('vendor'));
    }

    public function destroy(Vendor $vendor)
    {
        abort_if(Gate::denies('vendor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendor->delete();

        return back();

    }

    public function massDestroy(MassDestroyVendorRequest $request)
    {
        Vendor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function addWorkers(Worker $request)
    {
        return view('workers.create');
    }
}
