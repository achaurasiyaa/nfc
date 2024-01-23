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

class AssignWorkerController extends Controller
{
    public function index()
    {
        // dd('as8');
        // abort_if(Gate::denies('item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = Item::all();

        return view('admin.assign_worker.index', compact('items'));
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
}
