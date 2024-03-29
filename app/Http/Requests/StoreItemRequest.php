<?php

namespace App\Http\Requests;

use App\Asset;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'         => 'required',
            'supplier_name' => 'required',
            'quantity' => 'required',
            'ageing_in_days' => 'required',
        ];

    }
}
