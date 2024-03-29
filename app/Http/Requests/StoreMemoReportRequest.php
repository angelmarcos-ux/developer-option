<?php

namespace App\Http\Requests;

use App\Models\MemoReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMemoReportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('memo_report_create');
    }

    public function rules()
    {
        return [];
    }
}
