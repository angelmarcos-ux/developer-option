@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.listOfName.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.list-of-names.update", [$listOfName->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="house_number">{{ trans('cruds.listOfName.fields.house_number') }}</label>
                <input class="form-control {{ $errors->has('house_number') ? 'is-invalid' : '' }}" type="number" name="house_number" id="house_number" value="{{ old('house_number', $listOfName->house_number) }}" step="1" required>
                @if($errors->has('house_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('house_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listOfName.fields.house_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.listOfName.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $listOfName->last_name) }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listOfName.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="first_name">{{ trans('cruds.listOfName.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $listOfName->first_name) }}">
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listOfName.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_initial">{{ trans('cruds.listOfName.fields.middle_initial') }}</label>
                <input class="form-control {{ $errors->has('middle_initial') ? 'is-invalid' : '' }}" type="text" name="middle_initial" id="middle_initial" value="{{ old('middle_initial', $listOfName->middle_initial) }}">
                @if($errors->has('middle_initial'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_initial') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listOfName.fields.middle_initial_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customers_number">Contact No</label>
                <input class="form-control {{ $errors->has('customers_number') ? 'is-invalid' : '' }}" type="text" name="customers_number" id="customers_number" value="{{ old('customers_number', $listOfName->customers_number) }}">
                @if($errors->has('customers_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customers_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listOfName.fields.customers_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="meter_number">{{ trans('cruds.listOfName.fields.meter_number') }}</label>
                <input class="form-control {{ $errors->has('meter_number') ? 'is-invalid' : '' }}" type="text" name="meter_number" id="meter_number" value="{{ old('meter_number', $listOfName->meter_number) }}" required>
                @if($errors->has('meter_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meter_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listOfName.fields.meter_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="meter_number">Addres</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('meter_number', $listOfName->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listOfName.fields.meter_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.listOfName.fields.installation') }}</label>
                <select class="form-control {{ $errors->has('installation') ? 'is-invalid' : '' }}" name="installation" id="installation">
                    <option value disabled {{ old('installation', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ListOfName::INSTALLATION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('installation', $listOfName->installation) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('installation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('installation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listOfName.fields.installation_helper') }}</span>
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