@extends('layouts.admin')
@section('content')
@can('invoice_create')
@endcan
<div class="card">
    <div class="card-header">
        Bill List
    </div>
    <div class="card-body">
        <div class="ml-2">

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="payment">From</label>
                        <input onchange="updateData()" class="form-control " type="date" name="From" id="from">//(onchange)
                        <!-- <select class="form-control select2 " name="Year" id="Year">
                            <option value="2020" {{date('Y') == 2020 ? 'selected' : ''}}>2020</option>
                            <option value="2021" {{date('Y') == 2021 ? 'selected' : ''}}>2021</option>
                            <option value="2022" {{date('Y') == 2022? 'selected' : ''}}>2022</option>
                            <option value="2023" {{date('Y') == 2023? 'selected' : ''}}>2023</option>
                        </select> -->
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="payment">To</label>
                        <input onchange="updateData()" class="form-control " type="date" name="To" id="to">
                        <!-- <select class="form-control select2 " name="Month" id="Month">
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="DataTableID" class=" table table-bordered table-striped table-hover datatable datatable-Invoice">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            Bill No
                        </th>

                        <th>
                            Customer Info
                        </th>

                        <th>
                            Reading Date From
                        </th>
                        <th>
                            Reading Date To
                        </th>

                        <th>
                            Due Date
                        </th>
                        <th>
                            Disconnection Date
                        </th>
                        <th>
                            Total
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>
                </thead>
                <tbody>

                    @foreach($invoices as $key => $invoice)
                    <tr data-entry-id="{{ $invoice->id }}">
                        <td>

                        </td>

                        <td>
                            @if(isset($invoice->bill_year) and !empty($invoice->bill_year))
                                {{ $invoice->bill_year.' - '.str_pad($invoice->bill_number, 5, '0', STR_PAD_LEFT) }}
                            @endif
                        </td>

                        <td>
                            <b>Name: :</b>{{ ($invoice->first_name ?? '').' '.($invoice->middle_initial ?? '').' '.($invoice->last_name ?? '')}}<br>
                            <b>MeterNo:</b> {{ ($invoice->meter_number ?? '') }}
                        </td>

                        <td>
                        {{ $invoice->reading_date_from ?  date('F j, Y', strtotime($invoice->reading_date_from)) : '' }}
                        </td>
                        <td>
                        {{ $invoice->reading_date_to ?  date('F j, Y', strtotime($invoice->reading_date_to)) : '' }}
                        </td>
                        <td>
                            {{ $invoice->get_pay_until_date ?  date('F j, Y', strtotime($invoice->get_pay_until_date)) : '' }}
                        </td>
                        <td>
                            {{ $invoice->disconnection_date ?  date('F j, Y', strtotime($invoice->disconnection_date)) : '' }}
                        </td>
                        <td>
                            {{ number_format($invoice->total_amount, 2) ?? '' }} ₱
                        </td>

                        <td>
                            @php
                                if($invoice->paymentStatus == 'New'){
                                    if($invoice->get_pay_until_date < date('Y-m-d')){
                                       echo '<button type="button" class="btn  btn-danger">Unpaid Overdue</button>';
                                    } else {
                                      echo '<button type="button" class="btn  btn-info"> New</button>';
                                    }
                                } else if($invoice->paymentStatus == 'Fully Paid'){
                                    if($invoice->get_pay_until_date < $invoice->paymentdate){
                                        echo '<button type="button" class="btn  btn-warning"> Fully Paid with penalties</button>';
                                    } else {
                                        echo '<button type="button" class="btn  btn-success">Fully Paid</button>';
                                    }
                                }
                            @endphp
                        </td>
                        @can('invoice_show_Simapu')
                        <td>
                            @can('invoice_show_Simapu')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.invoices.show', $invoice->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan
                            @can('invoice_edit_Simapu')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.invoices.edit', $invoice->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                            @can('invoice_delete')
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                        @endcan


                        </td> @endcan
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
    @can('invoices_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.invoices.massDestroy') }}",
        className: 'btn-danger',
        action: function(e, dt, node, config) {
            var ids = $.map(dt.rows({
                selected: true
            }).nodes(), function(entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
            }

            if (confirm('{{ trans('global.areYouSure') }}')) {
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


// $("#Year, #Month").change(function() {
//     updateData()
// });
function updateData() {
    table.clear().draw();
    var url = "{{ route('getinoiceWithDate')}}";
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


                    var name ='';
                    name+='<b>Name: :</b>'+( invoices[i].first_name)+' '+(invoices[i].middle_initial)+' '+invoices[i].last_name+'<br> '
                    var h= ''
                    if(invoices[i].paymentStatus == 'Fully Paid'){
                        h += '<button type="button" class="btn  btn-success">'+invoices[i].paymentStatus+'</button>'
                    } else if(invoices[i].paymentStatus == 'Unpaid Overdue'){
                        h += '<button type="button" class="btn  btn-danger">'+invoices[i].paymentStatus+'</button>'
                    }else if(invoices[i].paymentStatus == 'New'){
                        h += '<button type="button" class="btn  btn-info">'+invoices[i].paymentStatus+'</button>'
                    }else {
                        h += '<button type="button" class="btn  btn-warning">'+invoices[i].paymentStatus+'</button>'
                    }

                    table.row.add([
                            '',
                            invoices[i].bill_year,
                            name,
                            invoices[i].reading_date_from,
                            invoices[i].reading_date_to,
                            invoices[i].get_pay_until_date,
                            invoices[i].disconnection_date,
                            invoices[i].total_amount,
                            h,
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
