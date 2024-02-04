@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Bill
    </div>


    <div class="card-body">
        <form id="FormSave" onsubmit="saveForm(this)" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" id="id" value="{{ $bill->id ?? '' }}">


            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="billing_date">Bill month</label>
                        <input class="form-control" type="month" name="billing_date" id="billing_date"
                            value="{{ $bill->billing_date ?? '' }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">Bill Price</label>
                        <input class="form-control" type="text" name="price" id="price"
                            value="{{ $bill->price ?? '' }}">
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


function saveForm(formData) {
    var url = "{{ route('price_save')}}";
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(formData),
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


</script>
@endsection