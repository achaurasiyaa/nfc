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
}
