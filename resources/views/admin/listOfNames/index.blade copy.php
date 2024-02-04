@extends('layouts.admin')
@section('content')
@can('list_of_name_create')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ListOfName">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.listOfName.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.listOfName.fields.house_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.listOfName.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.listOfName.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.listOfName.fields.middle_initial') }}
                    </th>
                    <th>
                        Contact No
                    </th>
                    <th>
                        {{ trans('cruds.listOfName.fields.meter_number') }}
                    </th>
                    <th>
                        Address
                    </th>
                    <th>
                        {{ trans('cruds.listOfName.fields.installation') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('list_of_name_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.list-of-names.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.list-of-names.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'house_number', name: 'house_number' },
{ data: 'last_name', name: 'last_name' },
{ data: 'first_name', name: 'first_name' },
{ data: 'middle_initial', name: 'middle_initial' },
{ data: 'customers_number', name: 'customers_number' },
{ data: 'meter_number', name: 'meter_number' },
{ data: 'address', name: 'address' },
{ data: 'installation', name: 'installation' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 3, 'asc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-ListOfName').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection