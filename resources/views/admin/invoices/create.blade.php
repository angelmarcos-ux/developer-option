@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Bill
    </div>

    <div class="card-body">
        <form id="FormSave" onsubmit="saveForm(this)" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" id="id" value="{{ $invoices->id ?? '' }}">
            <div class="form-group">
                <label for="last_name_id">Names</label>
                <select class="form-control select2 " name="name_id" id="name_id">
                    @if(isset($invoices['name_id']))
                    @foreach($names as $list)
                    <option value="{{ $list['id'] }}" {{ $invoices->name_id == $list['id'] ? 'selected' : '' }}>
                        {{ $list['first_name'].', '.$list['last_name'] }}</option>
                    @endforeach
                    @else
                    <option value="0">please select client</option>
                    @foreach($names as $list)
                    <option value="{{ $list['id'] }}">
                        {{ $list['first_name'].', '.$list['last_name'] }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="present_reading">Reading Date From</label>
                        <input class="form-control date" type="text" name="reading_date_from" id="reading_date_from"
                            value="{{ $invoices->reading_date_from ?? '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="present_reading">Reading Date To</label>
                        <input class="form-control date" type="text" name="reading_date_to" id="reading_date_to"
                            value="{{ $invoices->reading_date_to ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prev_reading">{{ trans('cruds.invoice.fields.prev_reading') }}</label>
                        <input class="form-control" type="text" name="prev_reading" disabled id="prev_reading"
                            value="{{ $invoices->present_reading ?? '' }}">

                        <span class="help-block">{{ trans('cruds.invoice.fields.prev_reading_helper') }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="present_reading">{{ trans('cruds.invoice.fields.present_reading') }}</label>
                        <input class="form-control" type="text" name="present_reading" id="present_reading"
                            onkeyup="priceupdate()" value="{{ $invoices->present_reading ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="water_usage">{{ trans('cruds.invoice.fields.water_usage') }}</label>
                        <input class="form-control " type="number" name="water_usage" disabled id="water_usage"
                            value="{{ $invoices->water_usage ?? '' }}" step="1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price_per_cb">{{ trans('cruds.invoice.fields.price_per_cb') }}</label>
                        <input class="form-control " type="text" name="price_per_cb" id="price_per_cb"
                            onkeyup="priceupdate()" value="{{ $invoices->price_per_cb ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discount">{{ trans('cruds.invoice.fields.discount') }}</label>
                        <input class="form-control " type="text" name="discount" id="discount" onkeyup="priceupdate()"
                            value="{{ $invoices->discount ?? '' }}" placeholder="%">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="system_lost">{{ trans('cruds.invoice.fields.system_lost') }}</label>
                        <input class="form-control " type="text" value="" name="system_lost" onkeyup="priceupdate()"
                            id="system_lost" value="{{ $invoices->system_lost ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="total_amount">{{ trans('cruds.invoice.fields.total_amount') }}</label>
                        <input class="form-control " type="text" name="total_amount" id="total_amount"
                            value="{{ $invoices->total_amount ?? '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="note">{{ trans('cruds.invoice.fields.note') }}</label>
                        <input class="form-control " type="text" name="note" id="note"
                            value="{{ $invoices->note ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$('#FormSave').on('submit', function(e) {
    e.preventDefault();
});

function selectNext() {
    var selected = $("#name_id").find('option:selected');
    selected.prop("selected", false);
    var next_option = selected.next().prop("selected", true);
    $('#name_id').trigger('change');
    getname()
}

function saveForm(formData) {
    var url = "{{ route('invoicesave')}}";
    var formData = new FormData(formData)
    var prev_reading = $('#prev_reading').val();
    var water_usage = $('#water_usage').val();
    var system_lost = $('#system_lost').val();
    var id = $('#id').val();
    formData.append('prev_reading', prev_reading)
    formData.append('water_usage', water_usage)
    formData.append('system_lost', system_lost)
    formData.append('id', id)
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
                selectNext()
            } else {
                swal("Save", data.message, "error");
            }
        },
        error: function(data) {

        }
    });
}

$("#name_id").change(function() {
    var url = "{{ route('getInvoiceLAtest')}}";
    var formData = new FormData()
    var name_id = $("#name_id").val();
    formData.append('name_id', name_id)
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
            $('#prev_reading').val('0')
            var present_reading = data.present_reading;
            if (present_reading.length) {
                $('#prev_reading').val(data.present_reading)
            } else {
                $('#prev_reading').val('0')
            }

        },
        error: function(data) {

        }
    });
});

function priceupdate() {
    console.log(111111111111111111)
    var prev = $('#prev_reading').val()
    var pre = $('#present_reading').val()
    var toral = pre - prev
    var water_usage = toral
    $('#water_usage').val(toral)

    var price_per_cb = $('#price_per_cb').val()
    var total_amount = price_per_cb * toral

    var system_lost = $('#system_lost').val()
    if (system_lost) {
        var tots = parseFloat(total_amount) + parseFloat(system_lost)
        total_amount = tots
        $('#total_amount').val(tots)
    } else {
        $('#total_amount').val(total_amount)
    }


    var discount = $('#discount').val()

    if (discount) {
        var discount_total = total_amount * (discount / 100)
        discount_total = total_amount - discount_total
        discount_total = discount_total + system_lost
        $('#total_amount').val(discount_total)
    }
}
</script>
@endsection