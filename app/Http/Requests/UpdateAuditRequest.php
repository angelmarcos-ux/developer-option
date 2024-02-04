<?php

namespace App\Http\Requests;

use App\Models\Audit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAuditRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('audit_edit');
    }

    public function rules()
    {
        return [
            'middle_initial' => [
                'string',
                'min:1',
                'max:1',
                'nullable',
            ],
            'suffix' => [
                'string',
                'nullable',
            ],
            'bill_paid' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
