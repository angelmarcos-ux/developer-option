@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.audit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.audits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.audit.fields.id') }}
                        </th>
                        <td>
                            {{ $audit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.audit.fields.lastname') }}
                        </th>
                        <td>
                            {{ $audit->lastname->last_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.audit.fields.firstname') }}
                        </th>
                        <td>
                            {{ $audit->firstname->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.audit.fields.middle_initial') }}
                        </th>
                        <td>
                            {{ $audit->middle_initial }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.audit.fields.suffix') }}
                        </th>
                        <td>
                            {{ $audit->suffix }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.audit.fields.bill_paid') }}
                        </th>
                        <td>
                            {{ $audit->bill_paid }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.audits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection