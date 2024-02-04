@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.report.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.update", [$report->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="lastname_id">{{ trans('cruds.report.fields.lastname') }}</label>
                <select class="form-control select2 {{ $errors->has('lastname') ? 'is-invalid' : '' }}" name="lastname_id" id="lastname_id">
                    @foreach($lastnames as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lastname_id') ? old('lastname_id') : $report->lastname->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lastname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lastname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.lastname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="first_name_id">{{ trans('cruds.report.fields.first_name') }}</label>
                <select class="form-control select2 {{ $errors->has('first_name') ? 'is-invalid' : '' }}" name="first_name_id" id="first_name_id">
                    @foreach($first_names as $id => $entry)
                        <option value="{{ $id }}" {{ (old('first_name_id') ? old('first_name_id') : $report->first_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">{{ trans('cruds.report.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $report->middle_name) }}">
                @if($errors->has('middle_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_payment_date">{{ trans('cruds.report.fields.last_payment_date') }}</label>
                <input class="form-control date {{ $errors->has('last_payment_date') ? 'is-invalid' : '' }}" type="text" name="last_payment_date" id="last_payment_date" value="{{ old('last_payment_date', $report->last_payment_date) }}" required>
                @if($errors->has('last_payment_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_payment_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.last_payment_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="balance">{{ trans('cruds.report.fields.balance') }}</label>
                <input class="form-control {{ $errors->has('balance') ? 'is-invalid' : '' }}" type="number" name="balance" id="balance" value="{{ old('balance', $report->balance) }}" step="1">
                @if($errors->has('balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bill_paid">{{ trans('cruds.report.fields.bill_paid') }}</label>
                <input class="form-control {{ $errors->has('bill_paid') ? 'is-invalid' : '' }}" type="number" name="bill_paid" id="bill_paid" value="{{ old('bill_paid', $report->bill_paid) }}" step="1">
                @if($errors->has('bill_paid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bill_paid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.bill_paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.report.fields.paid_pending') }}</label>
                <select class="form-control {{ $errors->has('paid_pending') ? 'is-invalid' : '' }}" name="paid_pending" id="paid_pending">
                    <option value disabled {{ old('paid_pending', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Report::PAID_PENDING_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('paid_pending', $report->paid_pending) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('paid_pending'))
                    <div class="invalid-feedback">
                        {{ $errors->first('paid_pending') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.paid_pending_helper') }}</span>
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