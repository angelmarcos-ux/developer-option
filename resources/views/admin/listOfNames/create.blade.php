@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Client
    </div>

    <div class="card-body">
        <form id="FormSave" onsubmit="saveForm(this)" enctype="multipart/form-data">
            @csrf
            <input class="form-control" type="hidden" name="id" id="id" value="{{ $list->id ?? '' }}">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="customers_number">Customer Number</label>
                        <input class="form-control" type="text" disabled name="customers_number" id="customers_number"
                            value="{{ $list->customers_number ?? '' }}" step="1" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required"
                            for="meter_number">{{ trans('cruds.listOfName.fields.meter_number') }}</label>
                        <input class="form-control" type="text" name="meter_number" id="meter_number"
                            value="{{ $list->meter_number ?? '' }}" required>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="last_name">{{ trans('cruds.listOfName.fields.last_name') }}</label>
                        <input class="form-control" type="text" name="last_name" id="last_name"
                            value="{{ $list->last_name ?? '' }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">{{ trans('cruds.listOfName.fields.first_name') }}</label>
                        <input class="form-control" type="text" name="first_name" id="first_name"
                            value="{{ $list->first_name ?? '' }}">
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="middle_initial">{{ trans('cruds.listOfName.fields.middle_initial') }}</label>
                        <input class="form-control" type="text" name="middle_initial" id="middle_initial"
                            value="{{ $list->middle_initial ?? '' }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Contact No.</label>
                        <input class="form-control" type="text" name="phone" id="phone"
                            value="{{ $list->phone ?? '' }}">
                    </div>
                </div>

            </div>

            <div class="row">



                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="Province">Province </label>
                        <input class="form-control" type="text" name="Province" id="Province"
                            value="{{ $list->Province ?? '' }}" required>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="address">City/Municipality </label>
                        <input class="form-control" type="text" name="City" id="City" value="{{ $list->City ?? '' }}"
                            required>
                    </div>
                </div>

            </div>

            <div class="row">


                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="Brgy">Brgy </label>
                        <input class="form-control" type="text" name="Brgy" id="Brgy" value="{{ $list->Brgy ?? '' }}"
                            required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="Purok">Purok </label>
                        <input class="form-control" type="text" name="Purok" id="Purok" value="{{ $list->Purok ?? '' }}"
                            required>
                    </div>
                </div>

            </div>

            <div class="row">


                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required"
                            for="house_number">{{ trans('cruds.listOfName.fields.house_number') }}</label>
                        <input class="form-control" type="number" name="house_number" id="house_number"
                            value="{{ $list->house_number ?? '' }}" step="1" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="Street">Street </label>
                        <input class="form-control" type="text" name="Street" id="Street"
                            value="{{ $list->Street ?? '' }}" required>
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

$(document).ready(function() {
    updateData()
});
function updateData(formData) {
    var url = "{{ route('get_customer')}}";
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(),
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            $('#customers_number').val(data.year+'-'+data.number)
        },
        error: function(data) {

        }
    });
}

function saveForm(formData) {
    var url = "{{ route('clientsave')}}";
    var formData = new FormData(formData)
    var id = $('#id').val();
    var customers_number = $('#customers_number').val();
    formData.append('id', id)
    formData.append('customers_number', customers_number)
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
@endsection