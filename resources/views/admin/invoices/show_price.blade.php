@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.invoice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

            <a class="btn btn-xs btn-info" target="_blank" href="{{ route('printInvoice', ['id'=>$invoice->id]) }}"> Print </a><br><br>

            <table class="table table-bordered table-striped" id="printTable">
                <tbody>
                    <tr>
                        <th>
                        Invoice No
                        </th>
                        <td>
                            {{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Reading Date
                        </th>
                        <td>
                            {{ date('F j, Y', strtotime($invoice->reading_date) )}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" id="eeeeeeeeeee" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />

<script>

    function printData(){


    }



</script>

@endsection
