@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.local.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.locals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="barangay">{{ trans('cruds.local.fields.barangay') }}</label>
                <input class="form-control {{ $errors->has('barangay') ? 'is-invalid' : '' }}" type="text" name="barangay" id="barangay" value="{{ old('barangay', '') }}">
                @if($errors->has('barangay'))
                    <div class="invalid-feedback">
                        {{ $errors->first('barangay') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.local.fields.barangay_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prk">{{ trans('cruds.local.fields.prk') }}</label>
                <input class="form-control {{ $errors->has('prk') ? 'is-invalid' : '' }}" type="text" name="prk" id="prk" value="{{ old('prk', '') }}">
                @if($errors->has('prk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.local.fields.prk_helper') }}</span>
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