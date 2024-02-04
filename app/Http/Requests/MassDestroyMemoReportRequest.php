<?php

namespace App\Http\Requests;

use App\Models\MemoReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMemoReportRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('memo_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:memo_reports,id',
        ];
    }
}
