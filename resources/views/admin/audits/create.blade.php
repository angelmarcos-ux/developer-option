@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.audit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.audits.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="lastname_id">{{ trans('cruds.audit.fields.lastname') }}</label>
                <select class="form-control select2 {{ $errors->has('lastname') ? 'is-invalid' : '' }}" name="lastname_id" id="lastname_id">
                    @foreach($lastnames as $id => $entry)
                        <option value="{{ $id }}" {{ old('lastname_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lastname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lastname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.audit.fields.lastname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="firstname_id">{{ trans('cruds.audit.fields.firstname') }}</label>
                <select class="form-control select2 {{ $errors->has('firstname') ? 'is-invalid' : '' }}" name="firstname_id" id="firstname_id">
                    @foreach($firstnames as $id => $entry)
                        <option value="{{ $id }}" {{ old('firstname_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('firstname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('firstname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.audit.fields.firstname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_initial">{{ trans('cruds.audit.fields.middle_initial') }}</label>
                <input class="form-control {{ $errors->has('middle_initial') ? 'is-invalid' : '' }}" type="text" name="middle_initial" id="middle_initial" value="{{ old('middle_initial', '') }}">
                @if($errors->has('middle_initial'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_initial') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.audit.fields.middle_initial_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="suffix">{{ trans('cruds.audit.fields.suffix') }}</label>
                <input class="form-control {{ $errors->has('suffix') ? 'is-invalid' : '' }}" type="text" name="suffix" id="suffix" value="{{ old('suffix', '') }}">
                @if($errors->has('suffix'))
                    <div class="invalid-feedback">
                        {{ $errors->first('suffix') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.audit.fields.suffix_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bill_paid">{{ trans('cruds.audit.fields.bill_paid') }}</label>
                <input class="form-control {{ $errors->has('bill_paid') ? 'is-invalid' : '' }}" type="number" name="bill_paid" id="bill_paid" value="{{ old('bill_paid', '') }}" step="1">
                @if($errors->has('bill_paid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bill_paid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.audit.fields.bill_paid_helper') }}</span>
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