<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('invoice_create');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'prev_reading' => [
                'string',
                'nullable',
            ],
            'present_reading' => [
                'string',
                'nullable',
            ],
            'water_usage' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'price_per_cb' => [
                'string',
                'nullable',
            ],
            'discount' => [
                'string',
                'nullable',
            ],
            'system_lost' => [
                'string',
                'nullable',
            ],
            'total_amount' => [
                'string',
                'nullable',
            ],
            'get_pay_until_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
