@extends('layouts.admin')
@section('content')
@can('invoice_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.list-of-names.create') }}">
            Add Client
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
       Client List
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
                            Customer Number
                        </th>

                        <th>
                            Meter Number
                        </th>
                        <th>
                            Name
                        </th>

                        <th>
                            Address
                        </th>

                        <th>
                            Contact Number
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Installation
                        </th>

                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($ListOfName as $key => $list)
                    <tr data-entry-id="{{ $list->id }}">
                        <td>

                        </td>

                        <td>
                            {{ $list->customer_year }}-{{ $list->customer_number }}
                        </td>

                        <td>
                            {{ $list->meter_number }}
                        </td>
                        <td>
                            {{ $list->last_name.', '.$list->first_name.' '.$list->middle_initial }}
                        </td>

                        <td>
                            {{ 'Purok'.' '.$list->Purok.' '.$list->Brgy.' '.$list->City.', '.$list->Province }}
                        </td>

                        <td>
                            {{ $list->phone ?? '' }}
                        </td>

                        <td>
                            {{ $list->connection ?? '' }}
                        </td>
                        <td>
                            {{ $list->installation ?? '' }}
                        </td>
                        <td>
                            <a class="btn btn-xs btn-success" href="{{ route('ledger',['id'=>$list->id]) }}">
                                Ledger
                            </a>
                            @can('invoice_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.list-of-names.show', $list->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan
                            @can('invoice_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.list-of-names.edit', $list->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                            @can('invoice_delete')
                            <form action="{{ route('admin.list-of-names.destroy', $list->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan
                            <a class="btn btn-xs btn-warning" href="#" onclick="changeStatus({{$list->id.',\''.$list->connection.'\''}})">
                                Change Status
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Connection  Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormSave" onsubmit="saveForm(this)" enctype="multipart/form-data">

                    <input type="hidden" name="id" id="id" value="{{ $invoices->id ?? '' }}">

                    <div class="form-group">
                        <label for="water_usage">Connection  Status</label>
                        <select class="form-control select2 " name="Connection" id="Connection">
                            <option value="Connected">Connected</option>
                            <option value="Disconnected">Disconnected</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>




@endsection
@section('scripts')
@parent
<script>

$('#FormSave').on('submit', function(e) {
    e.preventDefault();
});



function saveForm(formData) {

var id = $('#id').val()
var Connection = $('#Connection').val()

var url = "{{ route('StatusSave')}}";
var formData = new FormData(formData)
formData.append('id', id)
formData.append('Connection', Connection)
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
            swal("Save", data.message, "success");
        } else {
            swal("Save", data.message, "error");
        }
    },
    error: function(data) {

    }
});
}

function changeStatus(id,connection){
    $('#id').val(id)
    if (connection == 'Connected') {
        $('#Connection')
        .empty()
        .append('<option value="Connected" selected>Connected</option>')
        .append('<option value="Disconnected" >Disconnected</option>');
    } else {
        $('#Connection')
        .empty()
        .append('<option value="Connected" >Connected</option>')
        .append('<option value="Disconnected" selected>Disconnected</option>');
    }
    $('#exampleModal').modal('show');
}

let table
$(function() {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('invoices_delete')
    let deleteButtonTrans = '{{ trans('
    global.datatables.delete ') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.list-of-names.massDestroy') }}",
        className: 'btn-danger',
        action: function(e, dt, node, config) {
            var ids = $.map(dt.rows({
                selected: true
            }).nodes(), function(entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
                alert('{{ trans('
                    global.datatables.zero_selected ') }}')

                return
            }

            if (confirm('{{ trans('
                    global.areYouSure ') }}')) {
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

</script>
@endsection
