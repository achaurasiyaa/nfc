@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.vendor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vendor.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.vendor.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.name_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label class="required" for="contact">contact</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" value="{{ old('contact', '') }}" required>
                @if($errors->has('contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.name_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="contact">Vendor contact</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" value="{{ old('contact', '') }}" required>
                {{-- @if($errors->has('contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact') }}
                    </div>
                @endif --}}
                <span class="help-block"></span>
            </div>
            {{-- <div class="form-group">
                <label class="required" for="supplier_name">Supplier Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="supplier_name" id="supplier_name" value="{{ old('name', '') }}" required>
                @if($errors->has('supplier_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.name_helper') }}</span>
            </div> --}}

            {{-- <div class="form-group">
                <label class="required" for="ageing_in_days">Expire Age</label>
                <select class="form-control {{ $errors->has('ageing_in_days') ? 'is-invalid' : '' }}" name="ageing_in_days" id="ageing_in_days" required>
                    <option value="" selected disabled>Select Age</option>

                    @for ($month = 1; $month <= 12; $month++)
                        <option value="{{ $month }}">{{ $month }} month{{ $month > 1 ? 's' : '' }}</option>
                    @endfor
                </select>

                @if($errors->has('ageing_in_days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ageing_in_days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.name_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
