@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Add Worker
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.worker.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">Worker Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.worker.fields.name_helper') }}</span> --}}
            </div>
            <div class="form-group">
                <label class="required" for="gate_pass_number">Gate Pass Number</label>
                <input class="form-control {{ $errors->has('gate_pass_number') ? 'is-invalid' : '' }}" type="text" name="gate_pass_number" id="gate_pass_number" value="{{ old('gate_pass_number', '') }}" required>
                @if($errors->has('gate_pass_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gate_pass_number') }}
                    </div>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.worker.fields.name_helper') }}</span> --}}
            </div>
            <div class="form-group">
                <label class="required" for="vendor_id">Vendor ID</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="vendor_id" id="vendor_id" value="{{ old('vendor_id', '') }}" required>
                @if($errors->has('vendor_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vendor_id') }}
                    </div>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.worker.fields.name_helper') }}</span> --}}
            </div>

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
                <span class="help-block">{{ trans('cruds.worker.fields.name_helper') }}</span>
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
