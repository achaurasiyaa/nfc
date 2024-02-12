@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.item.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.items.update", [$item->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.item.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $item->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.name_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $item->quantity) }}" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label for="supplier_name">Supplier Name</label>
                <input class="form-control {{ $errors->has('supplier_name') ? 'is-invalid' : '' }}" type="text" name="supplier_name" id="supplier_name" value="{{ old('supplier_name', $item->supplier_name) }}" required>
                @if($errors->has('supplier_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier_name') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>


            <div class="form-group">
                <label for="ageing_in_days">Expire Age in Months</label>
                <input class="form-control {{ $errors->has('ageing_in_days') ? 'is-invalid' : '' }}" type="number" name="ageing_in_days" id="ageing_in_days" value="{{ old('ageing_in_days', $item->ageing_in_days) }}" required>
                @if($errors->has('ageing_in_days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ageing_in_days') }}
                    </div>
                @endif
                <span class="help-block"></span>
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
                <span class="help-block">{{ trans('cruds.item.fields.name_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="supplier_name">Category</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="supplier_name" value="{{ old('name', $item->name) }}" readonly required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
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
