<?php

namespace App\Http\Requests;

use App\Models\ListOfName;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateListOfNameRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('list_of_name_edit');
    }

    public function rules()
    {
        return [
            'house_number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'first_name' => [
                'string',
                'nullable',
            ],
            'middle_initial' => [
                'string',
                'min:1',
                'max:1',
                'nullable',
            ],
            'customers_number' => [
                'string',
                'min:13',
                'max:13',
                'nullable',
            ],
            'meter_number' => [
                'string',
                'required',
            ],
        ];
    }
}
