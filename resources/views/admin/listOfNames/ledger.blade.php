@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Information
    </div>

    <div class="card-body">
        <div class="form-group">

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-of-names.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>



            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>
                        Customer Ledger
                    </h1>

                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4> Account number: </h4>
                </div>
                <div class="col-md-10">
                    <h5 id="customer_number"> </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4> Name: </h4>
                </div>
                <div class="col-md-10">
                    <h5 id="name">
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4> Address: </h4>
                </div>
                <div class="col-md-7">
                    <h5 id="address">

                    </h5>
                </div>
                <div class="col-md-3 text-right">
                    <div class="form-group">
                        <button class="btn btn-success" onclick="create_bill()" href="#">
                            Add Bill
                        </button>
                        <a class="btn btn-info" onclick="next_date('previous')" href="#">
                            Previous
                        </a>
                        <a class="btn btn-primary" onclick="next_date('next')" href="#">
                            Next
                        </a>
                    </div>
                </div>
            </div>

            <table id="ledger_table" class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Bill No
                        </th>

                        <th>
                            Billing Month
                        </th>
                        <th>
                            From
                        </th>

                        <th>
                            To
                        </th>
                        <th>
                            Previous
                        </th>

                        <th>
                            Current
                        </th>
                        <th>
                            Total Amount
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-of-names.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Billing Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormSave" onsubmit="saveForm(this)" enctype="multipart/form-data">

                    <input type="hidden" name="name_id" id="name_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bill_number">Bill No</label>
                                        <input class="form-control date" type="text" disabled name="bill_number"
                                            id="bill_number">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="present_reading">Reading Date From</label>
                                        <input class="form-control " type="date" name="reading_date_from"
                                            id="reading_date_from">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reading_date_to">Reading Date To</label>
                                        <input onchange="priceUpdateBago()" class="form-control " type="date" name="reading_date_to" id="reading_date_to">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="prev_reading">{{ trans('cruds.invoice.fields.prev_reading') }}</label>
                                        <input class="form-control" type="text" name="prev_reading" disabled
                                            id="prev_reading">

                                        <span
                                            class="help-block">{{ trans('cruds.invoice.fields.prev_reading_helper') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="present_reading">{{ trans('cruds.invoice.fields.present_reading') }}</label>
                                        <input class="form-control" type="text" name="present_reading"
                                            id="present_reading" onkeyup="priceupdate()">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="water_usage">{{ trans('cruds.invoice.fields.water_usage') }}</label>
                                        <input class="form-control " type="number" name="water_usage" disabled
                                            id="water_usage" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="price_per_cb">{{ trans('cruds.invoice.fields.price_per_cb') }}</label>
                                        <input class="form-control " type="text" name="price_per_cb" disabled
                                            id="price_per_cb" onkeyup="priceupdate() ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount">{{ trans('cruds.invoice.fields.discount') }}</label>
                                        <input class="form-control " type="text" name="discount" id="discount"
                                            onkeyup="priceupdate()" placeholder="%">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="system_lost">{{ trans('cruds.invoice.fields.system_lost') }}</label>
                                        <input class="form-control " type="text" name="system_lost"
                                            onkeyup="priceupdate()" id="system_lost">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="total_amount">{{ trans('cruds.invoice.fields.total_amount') }}</label>
                                        <input class="form-control " type="text" name="total_amount" id="total_amount">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="note">{{ trans('cruds.invoice.fields.note') }}</label>
                                        <input class="form-control " type="text" name="note" id="note">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note">Client info</label>
                                        <table class="table table-bordered table-striped">
                                            <tbody>

                                                <tr>
                                                    <th>
                                                        Customer Number
                                                    </th>
                                                    <td id="table_customer_number">
                                                        Customer Number here
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Meter Number
                                                    </th>
                                                    <td id="table_meter_number">
                                                        Meter Number here
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Name
                                                    </th>
                                                    <td id="table_name">
                                                        name here
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Address
                                                    </th>
                                                    <td id="table_address">
                                                        Address here
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Contact Number
                                                    </th>
                                                    <td id="table_phone">
                                                        Contact Number here
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="submit" class="btn btn-primary">Save and send sms</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
var id = parseInt("{{$listOfName->id ?? '0'}}")
$('#FormSave').on('submit', function(e) {
    e.preventDefault();
});

function priceUpdateBago(){
    console.log(111231231241241230)
    var url = "{{ route('get_price')}}";
    var formData = new FormData(formData)
    var reading_date_to = $('#reading_date_to').val();
     formData.append('reading_date_to',reading_date_to)

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
                $('#price_per_cb').val(data.data.price)
            }  else {
                swal("Error", data.message, "error");
            }
        },
        error: function(data) {

        }
    });
}
// $("#reading_date_to").change(function() {
//     priceUpdate()
// });

function saveForm(formData) {


    var url = "{{ route('invoicesave')}}";
    var formData = new FormData(formData)
    var bill_number = $('#bill_number').val();
    var reading_date_from = $('#reading_date_from').val();
    var prev_reading = $('#prev_reading').val();
    var water_usage = $('#water_usage').val();
    var price_per_cb = $('#price_per_cb').val();

    formData.append('bill_number', bill_number)
    formData.append('reading_date_from', reading_date_from)
    formData.append('prev_reading', prev_reading)
    formData.append('water_usage', water_usage)
    formData.append('price_per_cb', price_per_cb)
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
                var url = window.location.href;
                url = url.replaceAll('#', '');
                const slug = url.split('=');
                setTimeout(function() {
                    window.location.href = slug[0] + '=' + id
                }, 1000);
            } else {
                swal("Save", data.message, "error");
            }
        },
        error: function(data) {

        }
    });
}

function create_bill() {

    $('#exampleModal').modal('show');
    var formData = new FormData()
    formData.append('name_id', id)
    $.ajax({
        type: "POST",
        url: "{{ route('getInvoiceLAtest_plusOne')}}",
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            var Invoice = data.Invoice
            var listOfName = data.ListOfName
            if (listOfName) {
                $('#table_customer_number').text(listOfName.customer_year+'-'+listOfName.customer_number)
                $('#table_meter_number').text(listOfName.meter_number)
                $('#table_name').html('<b>' + listOfName.first_name + ' ' + listOfName.middle_initial +
                    ' ' + listOfName.last_name + '</b>')
                $('#table_address').text('Purok'+ ' ' +listOfName.Purok + ' ' + listOfName.Brgy + ', ' + listOfName.City +
                ', ' + listOfName.Province)

                $('#table_phone').text(listOfName.phone)

                $('#name_id').val(listOfName.id)
            }
            $('#bill_number').val(data.bill_data.bill_year + '-' + data.bill_data.bill_number)
            if (Invoice.length > 0) {
                $('#reading_date_from').val(Invoice[0].reading_date_to_plus)
                $('#reading_date_from').attr('disabled', 'disabled');


                $('#prev_reading').val(Invoice[0].present_reading)

            } else {
                $('#reading_date_from').val('')
                $('#reading_date_from').removeAttr('disabled');
                $('#prev_reading').val('0')
            }
        },
        error: function(data) {

        }
    });

}



$(document).ready(function() {
    updateData()

});

function next_date(indicator) {
    if (indicator == 'previous') {
        var check_id = id - 1
        if (check_id < 0) {
            id = 0
        } else {
            id = id - 1
        }
    } else {
        id = id + 1
    }

    updateData()
}

function updateData() {
    var url = "{{ route('ledger_ajax')}}";
    var formData = new FormData()
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
            var Invoice = data.Invoice
            var listOfName = data.listOfName
            if (Invoice.length != 0) {

                $("#ledger_table").empty();
                var h = '';
                h += '<thead class="thead-dark">'
                h += '<tr>'
                h += '<th scope="col">Bill No</th>'
                h += '<th scope="col">Billing Month</th>'
                h += '<th scope="col">From</th>'
                h += '<th scope="col">To</th>'
                h += '<th scope="col">Due Date</th>'
                h += '<th scope="col">Disconnection Date</th>'
               // h += '<th scope="col">Penalty Date 10%</th>' //just add
                h += '<th scope="col">Previous</td>'
                h += '<th scope="col">Current</td>'
                h += '<th scope="col">Total Ammount</th>'
                h += '<th scope="col">Status</th>'
                h += '<th scope="col">Action</th>'
                h += '</tr>'
                h += '</thead>'
                h += '<tbody>'

                for (var i = 0; i < Invoice.length; i++) {

                    h += '<tr>'
                    h += '<td>' + Invoice[i].bill_number + '</td>'
                    h += '<td>' + Invoice[i].bill_year + '</td>'
                    h += '<td>' + Invoice[i].reading_date_from + '</td>'
                    h += '<td>' + Invoice[i].reading_date_to + '</td>'
                    h += '<td>' + Invoice[i].get_pay_until_date + '</td>'
                  //  h += '<td>' + Invoice[i].penalty_date + '</td>'  //just add
                    h += '<td>' + Invoice[i].disconnection_date + '</td>'
                    h += '<td>' + Invoice[i].prev_reading + '</td>'
                    h += '<td>' + Invoice[i].present_reading + '</td>'
                    h += '<td>' + Invoice[i].total_amount + '</td>'
                    if(Invoice[i].paymentStatus == 'Fully Paid'){
                        h += '<td><button type="button" class="btn  btn-success">'+Invoice[i].paymentStatus+'</button></td>'
                    } else if(Invoice[i].paymentStatus == 'Unpaid Overdue'){
                        h += '<td><button type="button" class="btn  btn-danger">'+Invoice[i].paymentStatus+'</button></td>'
                    }else if(Invoice[i].paymentStatus == 'New'){
                        h += '<td><button type="button" class="btn  btn-info">'+Invoice[i].paymentStatus+'</button></td>'
                    }else {
                        h += '<td><button type="button" class="btn  btn-warning">sssssssss'+Invoice[i].paymentStatus+'</button></td>'
                    }
                    h += '<td><a class="btn btn-xs btn-info" target="_blank" href="{{ route('printInvoice') }}?id='+Invoice[i].id+'"> Print </a></td>'
                    h += '</tr>'
                }
                h += '</tbody>'
                $('#ledger_table').html(h)
            } else {
                $("#ledger_table").empty();
                var h = '';
                h += '<thead class="thead-dark">'
                h += '<tr>'
                h += '<th scope="col">Bill No</th>'
                h += '<th scope="col">Billing Month</th>'
                h += '<th scope="col">From</th>'
                h += '<th scope="col">To</th>'
                h += '<th scope="col">Previous</td>'
                h += '<th scope="col">Current</td>'
                h += '<th scope="col">Total Ammount</th>'
                h += '<th scope="col">Status</th>'
                h += '</tr>'
                h += '</thead>'
                h += '<tbody>'
                h += '</tbody>'
                $('#ledger_table').html(h)
            }
            if (listOfName.length != 0) {

                $('#customer_number').text(listOfName.customer_year+'-'+listOfName.customer_number)
                $('#name').text(listOfName.first_name + ' ' + listOfName.middle_initial + ' ' + listOfName
                    .last_name)
                $('#address').text('Purok'+ ' ' +listOfName.Purok + ' ' + listOfName.Brgy + ', ' + listOfName.City +
                    ', ' + listOfName.Province)
            } else {
                $('#customer_number').text('')
                $('#name').text('')
                $('#address').text('')
            }
        },
        error: function(data) {

        }
    });
}


function priceupdate() {
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
        $('#total_amount').val(discount_total)
    }
}
</script>
@endsection
