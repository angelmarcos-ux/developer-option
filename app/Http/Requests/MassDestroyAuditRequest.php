<?php

namespace App\Http\Requests;

use App\Models\Audit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAuditRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('audit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:audits,id',
        ];
    }
}
