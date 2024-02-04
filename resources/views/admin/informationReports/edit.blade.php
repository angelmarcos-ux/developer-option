@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.informationReport.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.information-reports.update", [$informationReport->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="info_reports">{{ trans('cruds.informationReport.fields.info_reports') }}</label>
                <textarea class="form-control {{ $errors->has('info_reports') ? 'is-invalid' : '' }}" name="info_reports" id="info_reports" required>{{ old('info_reports', $informationReport->info_reports) }}</textarea>
                @if($errors->has('info_reports'))
                    <div class="invalid-feedback">
                        {{ $errors->first('info_reports') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.informationReport.fields.info_reports_helper') }}</span>
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