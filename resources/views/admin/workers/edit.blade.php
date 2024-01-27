@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Worker Edit
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.worker.update", [$worker->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Worker Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $worker->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">Worker Name</span>
            </div>

            <div class="form-group">
                <label for="gate_pass_number">Gate Pass Number</label>
                <input class="form-control {{ $errors->has('gate_pass_number') ? 'is-invalid' : '' }}" type="number" name="gate_pass_number" id="gate_pass_number" value="{{ old('gate_pass_number', $worker->gate_pass_number ) }}" required>
                @if($errors->has('gate_pass_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gate_pass_number') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label for="vendor_id">Vendor code</label>
                <input class="form-control {{ $errors->has('vendor_id') ? 'is-invalid' : '' }}" type="text" name="vendor_id" id="vendor_id" value="{{ old('vendor_id', $worker->vendor_id) }}" required>
                @if($errors->has('vendor_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vendor_id') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>


            {{-- <div class="form-group">
                <label for="ageing_in_days">Expire Age</label>
                <input class="form-control {{ $errors->has('ageing_in_days') ? 'is-invalid' : '' }}" type="number" name="ageing_in_days" id="ageing_in_days" value="{{ old('ageing_in_days', $asset->ageing_in_days) }}" required>
                @if($errors->has('ageing_in_days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ageing_in_days') }}
                    </div>
                @endif
                <span class="help-block"></span>
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
