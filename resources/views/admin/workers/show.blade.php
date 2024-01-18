@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Worker
        {{-- {{ trans('global.show') }} {{ trans('cruds.asset.title') }} --}}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.worker.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Worker ID
                        </th>
                        <td>
                            {{ $worker->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Worker Name
                        </th>
                        <td>
                            {{ $worker->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Vendor ID
                        </th>
                        <td>
                            {{ $worker->vendor_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Gate Pass Number
                        </th>
                        <td>
                            {{ $worker->gate_pass_number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.worker.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
