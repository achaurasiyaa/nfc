@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.vendor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vendor.update", [$vendor->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.vendor.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $vendor->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="vendor_code">Vendor Code</label>
                <input class="form-control {{ $errors->has('vendor_code') ? 'is-invalid' : '' }}" type="text" name="vendor_code" id="vendor_code" value="{{ old('vendor_code', $vendor->vendor_code) }}" required>
                @if($errors->has('vendor_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vendor_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.name_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="email">Vendor email</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $vendor->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
