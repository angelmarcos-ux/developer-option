@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Payment
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.store") }}" enctype="multipart/form-data">
            @csrf
      

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
                        <a class="btn btn-info" onclick="next_date('previous')" href="#">
                            Previous
                        </a>
                        <a class="btn btn-primary" onclick="next_date('next')" href="#">
                            Next
                        </a>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="required" for="last_payment_date">recent bill</label>
                <table class="table table-bordered" id="table_data">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Reading Date From</th>
                            <th scope="col">Reading Date To</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Disconnection Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Balance</td>
                            <th scope="col">Penalty</td>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormSave" onsubmit="saveForm(this)" enctype="multipart/form-data">

                    <input type="hidden" name="id" id="id">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reading_date_from">Reading Date From</label>
                                        <input class="form-control " type="text" disabled name="reading_date_from"
                                            id="reading_date_from" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reading_date_to">Reading Date To</label>
                                        <input class="form-control " type="text" disabled name="reading_date_to"
                                            id="reading_date_to" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="get_pay_until_date">Due Date</label>
                                <input class="form-control " type="text" disabled name="get_pay_until_date"
                                    id="get_pay_until_date" value="">
                            </div>


                            <div class="form-group">
                                <label for="total_amount">Total</label>
                                <input class="form-control " type="text" disabled name="total_amount" id="total_amount"
                                    value="">
                            </div>


                            <div class="form-group">
                                <label for="balance">Balance</label>
                                <input class="form-control " type="text" disabled name="balance" id="balance" value="">
                            </div>

                            <div class="form-group">
                                <label for="penalty">Penalty </label>
                                <input onkeyup="updateBlance()" class="form-control " type="text" name="penalty"
                                    id="penalty" value="">
                            </div>


                            <div class="form-group">
                                <label for="payment">Amount paid</label>
                                <input onkeyup="updateBlance()" class="form-control " type="text" name="payment"
                                    id="payment" value="">
                            </div>
                            <div class="form-group">
                                <!-- <label for="water_usage">Payment Status</label> -->
                                <input type="hidden" class="form-control " type="text" name="paymentStatus"id="paymentStatus">
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
var id = 0

function next_date(indicator) {
    console.log(id)
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
    reset_data()
 
}

// $("#paymentStatus").change(function() {
//     var paymentStatus = $('#paymentStatus').val()
//     var balance = $('#balance').val()
//     var penalty = $('#penalty').val()
//     if (penalty) {
//         subtotal = parseFloat(balance) + parseFloat(penalty)
//     } else {
//         subtotal = parseFloat(balance)
//     }
//     var payment = subtotal
//     if (paymentStatus == 'fullypaid') {
//         $('#payment').val(payment)
//     } else if (paymentStatus == 'unpaid') {
//         $('#payment').val('')
//     }
//     console.log(paymentStatus)
// });


function saveForm(formData) {

    var balance = $('#balance').val()
    var penalty = $('#penalty').val()
    var payment = $('#payment').val()
    var subtotal
    var final_blance
    if (penalty) {
        subtotal = parseFloat(balance) + parseFloat(penalty)
        final_blance = subtotal - parseFloat(payment)
    } else {
        subtotal = parseFloat(balance)
        if (payment) {
            final_blance = subtotal - parseFloat(payment)
        } else {
            final_blance = subtotal
        }
    }

    var url = "{{ route('invoicesave')}}";
    var formData = new FormData(formData)
    var balance = $('#balance').val();
    var total_amount = $('#total_amount').val();
    formData.append('total_amount', total_amount)
    formData.append('balance', balance)
    formData.append('newbalance', final_blance)
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
                reset_data()
            } else {
                swal("Save", data.message, "error");
            }
        },
        error: function(data) {

        }
    });
}

$("#name_id").change(function() {
    reset_data()
});

function reset_data() {
    var url = "{{ route('latest_four')}}";
    var formData = new FormData()
    formData.append('name_id', id)
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
            var listOfName = data.listOfName
            if (listOfName.length != 0) {
                $('#customer_number').text(listOfName.customer_year+'-'+listOfName.customer_number)
                $('#name').text(listOfName.first_name + ' ' + listOfName.middle_initial + ' ' + listOfName
                    .last_name)
                $('#address').text(listOfName.Purok + ' ' + listOfName.Street + ', ' + listOfName.City +
                    ', ' + listOfName.Province)
            } else {
                $('#customer_number').text('')
                $('#name').text('')
                $('#address').text('')
            }

            $("#table_data").empty();
            var h = '';

            h += '<thead class="thead-dark">'
            h += '<tr>'
            h += '<th scope="col">Reading Date From</th>'
            h += '<th scope="col">Reading Date To</th>'
            h += '<th scope="col">Due Date</th>'
            h += '<th scope="col">Disconnection Date</th>'
            h += '<th scope="col">Total</th>'
            h += '<th scope="col">Payment</th>'
            h += '<th scope="col">Balance</td>'
            h += '<th scope="col">Penalty</td>'
            h += '<th scope="col">Payment Status</th>'
            h += '<th scope="col">Action</th>'
            h += '</tr>'
            h += '</thead>'
            h += '<tbody>'

            for (var i = 0; i < data.Invoice.length; i++) {
                h += '<tr id="' + data.Invoice[i].id + '">'
                h += '<td>' + data.Invoice[i].reading_date_from + '</td>'
                h += '<td>' + data.Invoice[i].reading_date_to + '</td>'
                h += '<td>' + data.Invoice[i].get_pay_until_date + '</td>'
                h += '<td>' + data.Invoice[i].disconnection_date + '</td>'
                h += '<td>' + data.Invoice[i].total_amount + '</td>'
                h += '<td>' + data.Invoice[i].payment + '</td>'
                h += '<td>' + data.Invoice[i].balance + '</td>'
                h += '<td>' + data.Invoice[i].penalty + '</td>'

                if(data.Invoice[i].paymentStatus == 'Fully Paid'){
                    h += '<td><button type="button" class="btn  btn-success">'+data.Invoice[i].paymentStatus+'</button></td>'
                } else if(data.Invoice[i].paymentStatus == 'Unpaid Overdue'){
                    h += '<td><button type="button" class="btn  btn-danger">'+data.Invoice[i].paymentStatus+'</button></td>'
                }else if(data.Invoice[i].paymentStatus == 'New'){
                    h += '<td><button type="button" class="btn  btn-info">'+data.Invoice[i].paymentStatus+'</button></td>'
                }else {
                    h += '<td><button type="button" class="btn  btn-warning">'+data.Invoice[i].paymentStatus+'</button></td>'
                }
                h += '<td><button type="button"   class="btn btn-primary" onclick="data_modal(\'' +
                    data.Invoice[i].id + '\',\'' + data.Invoice[i].reading_date_from + '\',\'' + data.Invoice[i]
                    .get_pay_until_date + '\',\'' + data.Invoice[i].total_amount + '\',\'' + data.Invoice[i]
                    .payment + '\',\'' + data.Invoice[i].balance + '\',\'' + data.Invoice[i].penalty + '\',\'' +
                    data.Invoice[i].paymentStatus + '\',\'' + data.Invoice[i].connection + '\',\'' + data.Invoice[i].reading_date_to+ '\',this)">  Action </button></td>'
                h += '</tr>'
            }
            h += '</tbody>'
            $('#table_data').html(h)
        },
        error: function(data) {

        }
    });
}

function data_modal(id, reading_date_from, get_pay_until_date, total_amount, payment, balance, penalty, paymentStatus,
connection, reading_date_to, e) {
    $('#id').val(id);
    $('#total_amount').val(total_amount);
    $('#get_pay_until_date').val(get_pay_until_date);
    $('#reading_date_from').val(reading_date_from);
    $('#reading_date_to').val(reading_date_to);
    $('#balance').val(balance);
    $('#exampleModal').modal('show');


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
                $('#table_address').text(listOfName.Purok + ' ' + listOfName.Street + ', ' + listOfName
                    .City + ', ' + listOfName.Province)
                $('#table_phone').text(listOfName.phone)
            }

        },
        error: function(data) {

        }
    });

}//changedata

function updateBlance() {
    var balance = $('#balance').val()
    var penalty = $('#penalty').val()
    var payment = $('#payment').val()
    var subtotal
    if (penalty) {
        subtotal = parseFloat(balance) + parseFloat(penalty)
    } else {
        subtotal = parseFloat(balance)
    }
    if (subtotal <= payment) {
        $('#payment').val(subtotal)
        $('#paymentStatus').val('Fully Paid')
    } else if (subtotal > payment) {
        if(payment){
            $('#paymentStatus').val('Partially Paid')
        } else {
            $('#paymentStatus').val('Unpaid')
        } 
    } else {
        $('#paymentStatus').val('Unpaid')
    }

}
</script>
@endsection