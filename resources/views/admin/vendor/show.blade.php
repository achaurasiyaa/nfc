@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.vendor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vendor.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>{{ trans('cruds.vendor.fields.id') }}</th>
                        <td>{{ $vendor->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.vendor.fields.name') }}</th>
                        <td>{{ $vendor->name }}</td>
                    </tr>
                    <tr>
                        <th>Vendor Code</th>
                        <td>{{ $vendor->vendor_code }}</td>
                    </tr>
                    <tr>
                        <th>Vendor Email</th>
                        <td>{{ $vendor->email }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vendor.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
