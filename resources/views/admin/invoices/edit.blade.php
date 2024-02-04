@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.invoice.title_singular') }}
    </div>

    <div class="card-body">
        <form  id="FormSave" onsubmit="saveForm(this)" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="id" id="id" value="{{ $invoices->id }}">
            
            <div class="form-group">
                <label for="present_reading">Reading Date</label>
                <input class="form-control date" type="text" name="reading_date" id="reading_date"
                    value="{{ $invoices->reading_date }}">
            </div>

            <div class="form-group">
                <label for="get_pay_until_date">Due Date</label>
                <input class="form-control date " type="text" name="get_pay_until_date" id="get_pay_until_date"
                    value="{{  $invoices->reading_date }}">
            </div>

            <div class="form-group">
                <label for="last_name_id">Names</label>
                <select class="form-control select2 " name="name_id" id="name_id">
                    @foreach($names as $id => $list)
                    <option value="{{ $id }}" {{  $invoices->name_id == $id ? 'selected' : '' }} >{{ $list['last_name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="prev_reading">{{ trans('cruds.invoice.fields.prev_reading') }}</label>
                <input class="form-control" type="text" name="prev_reading" disabled id="prev_reading"
                value="{{  $invoices->prev_reading }}">

                <span class="help-block">{{ trans('cruds.invoice.fields.prev_reading_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="present_reading">{{ trans('cruds.invoice.fields.present_reading') }}</label>
                <input class="form-control" type="text" name="present_reading" id="present_reading"
                    onkeyup="priceupdate()" value="{{  $invoices->present_reading }}">
            </div>

            <div class="form-group">
                <label for="water_usage">{{ trans('cruds.invoice.fields.water_usage') }}</label>
                <input class="form-control " type="number" name="water_usage" disabled id="water_usage"
                    value="{{  $invoices->water_usage}}" step="1">
            </div>

            <div class="form-group">
                <label for="price_per_cb">{{ trans('cruds.invoice.fields.price_per_cb') }}</label>
                <input class="form-control " type="text" name="price_per_cb" id="price_per_cb" onkeyup="priceupdate()"
                    value="{{  $invoices->price_per_cb }}">
            </div>

            <div class="form-group">
                <label for="discount">{{ trans('cruds.invoice.fields.discount') }}</label>
                <input class="form-control " type="text" name="discount" id="discount" onkeyup="priceupdate()"
                    value="{{  $invoices->discount }}" placeholder="%">
            </div>

            <div class="form-group">
                <label for="system_lost">{{ trans('cruds.invoice.fields.system_lost') }}</label>
                <input class="form-control " type="text" value="30" name="system_lost" disabled id="system_lost"
                    value="{{  $invoices->system_lost }}">
            </div>

            <div class="form-group">
                <label for="total_amount">{{ trans('cruds.invoice.fields.total_amount') }}</label>
                <input class="form-control " type="text" name="total_amount" id="total_amount"
                    value="{{  $invoices->total_amount }}">
            </div>

            <div class="form-group">
                <label for="note">{{ trans('cruds.invoice.fields.note') }}</label>
                <textarea class="form-control " name="note" id="note">{{  $invoices->note }}</textarea>
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
            } else {
                swal("Save", data.message, "error");
            }
        },
        error: function(data) {

        }
    });
}
</script>