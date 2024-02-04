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

                    <tr>
                        <th>
                           Due Date
                        </th>
                        <td>
                            {{ date('F j, Y', strtotime($invoice->get_pay_until_date) )}}
                        </td>
                    </tr>


                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.last_name') }}
                        </th>
                        <td>
                            {{ $invoice->last_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.first_name') }}
                        </th>
                        <td>
                            {{ $invoice->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.address') }}
                        </th>
                        <td>
                            {{ $invoice->address }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.prev_reading') }}
                        </th>
                        <td>
                            {{ number_format($invoice->prev_reading, 2) ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.present_reading') }}
                        </th>
                        <td>
                            {{ number_format($invoice->present_reading, 2) ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.water_usage') }}
                        </th>
                        <td>
                            {{ number_format($invoice->water_usage, 2) ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.price_per_cb') }}
                        </th>
                        <td>
                            {{ number_format($invoice->price_per_cb, 2) ?? '' }} ₱
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.discount') }}
                        </th>
                        <td>
                            {{ $invoice->discount ?? '' }} %
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.system_lost') }}
                        </th>
                        <td>
                            {{ number_format($invoice->system_lost, 2) ?? '' }} ₱
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.total_amount') }}
                        </th>
                        <td>
                            {{ number_format($invoice->total_amount, 2) ?? '' }} ₱
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.note') }}
                        </th>
                        <td>
                            {{ $invoice->note }}
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
