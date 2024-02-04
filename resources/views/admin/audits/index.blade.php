@extends('layouts.admin')
@section('content')
@can('invoice_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <!-- <a class="btn btn-success" href="{{ route('admin.invoices.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.invoice.title_singular') }}
        </a> -->
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        Audit List
    </div>

    <div class="card-body">
        <div class="ml-2">

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="payment">From</label>
                        <input onchange="updateData()" class="form-control " type="date" name="From" id="from">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="payment">To</label>
                        <input onchange="updateData()" class="form-control " type="date" name="To" id="to">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Invoice">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            Bill No
                        </th>
                        <th>
                            {{ trans('cruds.invoice.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.invoice.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.invoice.fields.prev_reading') }}
                        </th>
                        <th>
                            {{ trans('cruds.invoice.fields.present_reading') }}
                        </th>
                        <th>
                            {{ trans('cruds.invoice.fields.water_usage') }}
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Discount
                        </th>
                        <th>
                            System Lost
                        </th>

                        <th>
                            Total
                        </th>

                        <th>
                            Autdit Status
                        </th>

                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($invoices as $key => $invoice)
                    <tr data-entry-id="{{ $invoice->id }}">
                        <td>

                        </td>
                        <td>
                        {{ $invoice->bill_year ?? '' }}-{{ $invoice->bill_number ?? '' }}
                        </td>
                        <td>
                            {{ $invoice->last_name ?? '' }}
                        </td>
                        <td>
                            {{ $invoice->first_name ?? '' }}
                        </td>
                        <td>
                            {{ number_format($invoice->prev_reading, 2) ?? '' }}
                        </td>
                        <td>
                            {{ number_format($invoice->present_reading, 2) ?? '' }}
                        </td>
                        <td>
                            {{ number_format($invoice->water_usage, 2) ?? '' }}
                        </td>
                        <td>
                            {{ number_format($invoice->price_per_cb, 2) ?? '' }} ₱
                        </td>
                        <td>
                            {{ $invoice->discount ?? '' }} %
                        </td>
                        <td>
                            {{ number_format($invoice->system_lost, 2) ?? '' }} ₱
                        </td>
                        <td>
                            {{ number_format($invoice->total_amount, 2) ?? '' }} ₱
                        </td>
                        <td>
                            @php
                            if($invoice->autditStatus == 'audited'){
                            echo 'Audited';
                            } else {
                            echo 'Not Audited';
                            }
                            @endphp
                        </td>
                        <td>
                            @if($invoice->autditStatus != 'audited')
                            <a class="btn btn-xs btn-primary" href="{{ route('auditLogs', ['id'=>$invoice->id]) }}">
                                Approve
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
     let table
$(function() {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('invoice_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: '{{ route('admin.invoices.massDestroy') }}',
        className: 'btn-danger',
        action: function(e, dt, node, config) {
            var ids = $.map(dt.rows({
                selected: true
            }).nodes(), function(entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected ') }}')

                return
            }

            if (confirm('{{ trans('global.areYouSure ') }}')) {
                $.ajax({
                        headers: {
                            'x-csrf-token': _token
                        },
                        method: 'POST',
                        url: config.url,
                        data: {
                            ids: ids,
                            _method: 'DELETE'
                        }
                    })
                    .done(function() {
                        location.reload()
                    })
            }
        }
    }
    dtButtons.push(deleteButton)
    @endcan

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [
            [1, 'desc']
        ],
        pageLength: 50,
    });
     table = $('.datatable-Invoice:not(.ajaxTable)').DataTable({
        buttons: dtButtons
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

})



function updateData() {
    table.clear().draw();
    var url = "{{ route('invoiceAudit')}}";
    var formData = new FormData()

    var from = $("#from").val();
    var to = $("#to").val();
    formData.append('from', from)
    formData.append('to', to)
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            if (data.result) {
                var invoices = data.invoices
                for (var i in invoices) {
                    table.row.add([
                            '',
                            invoices[i].bill_year+'-'+invoices[i].bill_number,
                            invoices[i].last_name,
                            invoices[i].first_name,
                            invoices[i].prev_reading,
                            invoices[i].present_reading,
                            invoices[i].water_usage,
                            invoices[i].price_per_cb,
                            invoices[i].discount,
                            invoices[i].system_lost,
                            invoices[i].total_amount,
                            invoices[i].autditStatus,
                            invoices[i].action,
                        ])
                        .draw();
                }
            }

        },
        error: function(data) {

        }
    });
}
</script>
@endsection