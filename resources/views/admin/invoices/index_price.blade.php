@extends('layouts.admin')
@section('content')
@can('invoice_create')
@endcan

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('create_price') }}">
            Add Price
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Bill Price List
    </div>
    <div class="card-body">
        <div class="ml-2">
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
                            Bill Month
                        </th>
                        <th>
                            Bill Price
                        </th>
                        <th>
                            Status
                        </th>

                    </tr>
                </thead>
                <tbody>

                    @foreach($BillSettings as $key => $list)
                    <tr data-entry-id="{{ $list->id }}">
                        <td>

                        </td>

                        <td>
                            {{ $list->billing_date ?  date('F Y', strtotime($list->billing_date)) : '' }}
                        </td>
                        <td>
                            {{ $list->price ? $list->price : '' }}
                        </td>
                       
                        @can('invoice_show')
                        <td>
                            @can('invoice_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('price_edit',['id'=>$list->id]) }}">
                                Edit
                            </a>
                            @endcan
                            <a class="btn btn-xs btn-danger" href="{{ route('destroy_price',['id'=>$list->id]) }}">
                                Delete
                            </a>
                    
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
