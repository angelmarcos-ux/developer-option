<?php

namespace App\Http\Requests;

use App\Models\InformationReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInformationReportRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('information_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:information_reports,id',
        ];
    }
}
