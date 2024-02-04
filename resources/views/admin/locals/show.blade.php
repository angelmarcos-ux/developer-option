@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.local.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.locals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.id') }}
                        </th>
                        <td>
                            {{ $local->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.barangay') }}
                        </th>
                        <td>
                            {{ $local->barangay }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.prk') }}
                        </th>
                        <td>
                            {{ $local->prk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.locals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection