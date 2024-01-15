@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.asset.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.assets.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.asset.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">Quantity</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" id="quantity" value="{{ old('quantity', '') }}" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="supplier_name">Supplier Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="supplier_name" id="supplier_name" value="{{ old('name', '') }}" required>
                @if($errors->has('supplier_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
            </div>

            <div class="form-group">
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
                <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
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
