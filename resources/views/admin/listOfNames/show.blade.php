@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.listOfName.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-of-names.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfName.fields.id') }}
                        </th>
                        <td>
                            {{ $listOfName->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfName.fields.house_number') }}
                        </th>
                        <td>
                            {{ $listOfName->house_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfName.fields.last_name') }}
                        </th>
                        <td>
                            {{ $listOfName->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfName.fields.first_name') }}
                        </th>
                        <td>
                            {{ $listOfName->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfName.fields.middle_initial') }}
                        </th>
                        <td>
                            {{ $listOfName->middle_initial }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfName.fields.customers_number') }}
                        </th>
                        <td>
                            {{ $listOfName->customers_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfName.fields.meter_number') }}
                        </th>
                        <td>
                            {{ $listOfName->meter_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfName.fields.installation') }}
                        </th>
                        <td>
                            {{ App\Models\ListOfName::INSTALLATION_SELECT[$listOfName->installation] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-of-names.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection