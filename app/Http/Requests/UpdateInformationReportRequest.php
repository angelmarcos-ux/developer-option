<?php

namespace App\Http\Requests;

use App\Models\InformationReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInformationReportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('information_report_edit');
    }

    public function rules()
    {
        return [
            'info_reports' => [
                'required',
            ],
        ];
    }
}
