<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Item;
use App\Worker;
use App\Asset;
use App\Vendor;
use App\IssueRecord;
Use App\ItemNfcRel;
use Illuminate\Support\Facades\DB;

class AssignWorkerController extends Controller
{
    public function index()
    {
        // dd('as8');
        // abort_if(Gate::denies('item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $nonAssignedItems = DB::table('item_nfc_rel')
        // ->leftJoin('issue_records', 'item_nfc_rel.id', '=', 'issue_records.nfc_tag_id')
        // ->whereNull('issue_records.nfc_tag_id')
        // ->select('item_nfc_rel.*')
        // ->get();
        $nonAssignedItems = DB::table('item_nfc_rel')
        ->leftJoin('issue_records', 'item_nfc_rel.id', '=', 'issue_records.nfc_tag_id')
        ->leftJoin('items', 'item_nfc_rel.item_id', '=', 'items.id') // Assuming items table has the 'item_id' column
        ->whereNull('issue_records.nfc_tag_id')
        ->select('item_nfc_rel.*', 'items.name') // Add 'items.item_name' to the select statement
        ->get();
        // $item = Item::where($nonAssignedItems->item_id);
        // dd($nonAssignedItems);
        return view('admin.assign_worker.index', compact('nonAssignedItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.items.create');
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->all());

        return redirect()->route('admin.items.index');

    }

    public function edit(Item $item)
    {
        abort_if(Gate::denies('item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.items.edit', compact('item'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        try
        {
            $item->update($request->all());
        }
        catch (\Exception $e) {
            // Log or display the error message
            dd($e->getMessage());
        }

        return redirect()->route('admin.items.index');

    }

    public function show(Item $item)
    {
        abort_if(Gate::denies('item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.items.show', compact('item'));
    }

    public function destroy(Item $item)
    {
        abort_if(Gate::denies('item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $item->delete();

        return back();

    }

    public function massDestroy(MassDestroyItemRequest $request)
    {
        Item::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function addWorkers(Worker $request)
    {

        return view('workers.create');
    }

    public function assignWorker()
    {
        dd('assignWorker');
    }
    public function assignItem(Request $request, $nfc_serial_number)
    {
        dd('assignItem');
        // Find the ItemNfcRel by nfc_serial_number
        $itemNfcRel = ItemNfcRel::where('nfc_serial_number', $nfc_serial_number)->first();

        // Assuming you have a form field named 'worker_id' to specify the worker
        $request->validate([
            'worker_id' => 'required|exists:workers,id',
        ]);

        // Assign the worker to the ItemNfcRel
        $itemNfcRel->update([
            'worker_id' => $request->input('worker_id'),
        ]);

        // You can also perform additional logic or redirect to a specific page
        return redirect()->route('admin.assign_worker.index')->with('success', 'Item assigned successfully');
    }
    public function getWorkers()
    {
        dd('jjjjj');
        $workers = Worker::all();
        dd($workers);
        return response()->json($workers);
    }
}
