<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInvoiceRequest;
//use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\ListOfName;
use App\Models\BillSettings;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Codedge\Fpdf\Fpdf\Fpdf;
//use Carbon\carbon;
class InvoiceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $to = (date('n')+1);
        $from = date('n');
        $invoices = Invoice::select(
            'invoices.*',
            'list_of_names.last_name',
            'list_of_names.first_name',
            'list_of_names.meter_number',
            'list_of_names.address'
        )
        ->leftJoin('list_of_names','list_of_names.id','=','invoices.name_id')
        ->whereYear('invoices.reading_date_from',date('Y'))
        ->whereMonth('invoices.reading_date_from','>=',$from)
        ->whereMonth('invoices.reading_date_to','<=',$to)
        ->orderBy('invoices.reading_date_to','desc')
        ->get();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = ListOfName::get();

        return view('admin.invoices.create', compact('names'));
    }

    public function store(Request $request)
    {
        $results = ['message'=>'Please contact the administrator.','result'=>false];

            // if(empty($request->id)){
            //     $results = ['message'=>'There is no record for this account.','result'=>false];
            //     return json_encode($results);
            // }
            if(!isset($request->newbalance)){
                if(empty($request->present_reading)){
                    $results = ['message'=>'present reading is required.','result'=>false];
                    return json_encode($results);
                }
                if(!is_numeric($request->present_reading)){
                    $results = ['message'=>'present reading required number only.','result'=>false];
                    return json_encode($results);
                }
                if(!is_numeric($request->present_reading)){
                    $results = ['message'=>'present reading required number only.','result'=>false];
                    return json_encode($results);
                }
                if(empty($request->price_per_cb)){
                    $results = ['message'=>'prince per Cb is required.','result'=>false];
                    return json_encode($results);
                }
                if(!is_numeric($request->price_per_cb)){
                    $results = ['message'=>'prince per Cb required number only.','result'=>false];
                    return json_encode($results);
                }

                if(!empty($request->discount)){
                    if(!is_numeric($request->discount)){
                        $results = ['message'=>'discount required number only.','result'=>false];
                        return json_encode($results);
                    }
                }

                if(!empty($request->system_lost)){
                    if(!is_numeric($request->system_lost)){
                        $results = ['message'=>'system lost required number only.','result'=>false];
                        return json_encode($results);
                    }
                }
            }



        if(isset($request->id) and !empty($request->id)){
            $data = $request->all();
            $id = $request->id;
            unset($data['id']);
            unset($data['_token']);
            if(isset($data['newbalance'])){
                $data['balance'] = $data['newbalance'];
                unset($data['newbalance']);
            }            if($data['payment'] == 'null' or $data['payment'] == null){
                $data['payment'] = '0.00';
            }
            if($data['penalty'] == 'null' or $data['penalty'] == null){
                $data['penalty'] = '0.00';
            }
            $data['paymentdate'] = date('Y-m-d');
            $update = Invoice::where('id',$id)->update(
                $data
            );
            if( $update){
                $results = ['message'=>'Updated successfully.','result'=>true];
            }



        } else {
            if(empty($request->name_id)){
                $results = ['message'=>'There is no account selected.','result'=>false];
                return json_encode($results);
            }

            $reading_date = strtotime($request->reading_date_to);
            $reading_date_year = date('Y',$reading_date);
            $reading_date_month= date('m',$reading_date);

            $Invoice = Invoice::where('name_id',$request->name_id)->whereMonth('reading_date_to',$reading_date_month)->whereYear('reading_date_to',$reading_date_year)->first();
            if($Invoice){
                $results = ['message'=>'Invoice already exist fo this month.','result'=>false];
            } else {

                $date_to = date('Y-m-d',strtotime($request->reading_date_to));
                $date_to2 = date('Y-m-d',strtotime($request->reading_date_to));


                // get_pay_until_date
                // penalty still here!
                $count = 0;
                $count2 = 0;
                $date_to_calcualte = $date_to;
                $date_to_calcualte2 = $date_to2;
                while(1){
                    $date_to_calcualte = date('Y-m-d', strtotime($date_to_calcualte."+1 day"));
                    $weekDay = date('w', strtotime($date_to_calcualte));
                    if($weekDay != 0 and $weekDay != 5){
                        $count++;
                    }
                    if($count >=3){
                        break;
                    }
                }

                while(1){
                    $date_to_calcualte2 = date('Y-m-d', strtotime($date_to_calcualte2."+1 day"));
                    $weekDay = date('w', strtotime($date_to_calcualte2));
                    if($weekDay != 0 and $weekDay != 5){
                        $count2++;
                    }
                    if($count2 >=7){
                        break;
                    }
                }

                $newdate = date('Y-m-d',strtotime($date_to_calcualte));
                $newdate2 = date('Y-m-d',strtotime($date_to_calcualte2));
                $Invoice = new Invoice();
                $Invoice->disconnection_date = $newdate2;
                $Invoice->name_id = $request->name_id;
                $Invoice->prev_reading = $request->prev_reading;
                $Invoice->present_reading = $request->present_reading;
                $Invoice->water_usage = $request->water_usage;
                $Invoice->price_per_cb = $request->price_per_cb;
                $Invoice->system_lost = $request->system_lost;
                $Invoice->discount = $request->discount;
                $Invoice->total_amount = $request->total_amount;
                $Invoice->note = $request->note;
                $Invoice->get_pay_until_date = $newdate;
                $Invoice->reading_date_from = $request->reading_date_from;
                $Invoice->reading_date_to = $request->reading_date_to;
                $bill_number = explode("-",$request->bill_number);
                $Invoice->bill_year = $bill_number[0];
                $Invoice->bill_number = $bill_number[1];
                $Invoice->balance = $request->total_amount;
                $Invoice->payment = '0.00';
                $Invoice->paymentStatus = 'New';
                $Invoice->disconnectionStatus = 'normal';
                $Invoice->penalty = '0.00';
                $Invoice->autditStatus = 'notaudited';

                //$Invoice = $Invoice->save();

                if($Invoice -> save()){
                    $results = ['message'=>'Added successfully.','result'=>true];
                }else{
                //     $sid = "AC548b02b612673ec115171c683b390e75"; // Your Account SID from www.twilio.com/console AC2754da66acb8db2d33d965eb78164cfc
                //     $token = "4275f10c40d258b4d2dae2ed3130629c"; // Your Auth Token from www.twilio.com/console  4c9b932f6c853df2f8f3e1d01bf923ed
                //     $getNumber= ListOfName::where('id',$request->name_id)->first();
                //     $client = new \Twilio\Rest\Client($sid, $token);
                 //    $message = $client->messages->create(
                 //        $getNumber->customers_number, // Text this number
                 //        [
                 //        'from' => '+19403605432', // From a valid Twilio number +12053902709
                 //        'body' => 'Hello from COWASA MANAGEMENT!your previous reading is: '.($request->prev_reading).', and present reading is: '.($request->present_reading).', with total_amount: '.'₱'.($request->total_amount) .'please pay until: '.$request->get_pay_until_date
                 //        ]
                   //  );
                    $results = ['message'=>'Added successfully.','result'=>true];
                }
            }


        }
        return json_encode($results);
    }

    public function edit(Request $request)
    {
        abort_if(Gate::denies('invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = request()->segment(3);
        $invoices = Invoice::select(
            'invoices.*',
            'list_of_names.id as name_id',
            'list_of_names.last_name',
            'list_of_names.first_name',
            'list_of_names.meter_number',
            'list_of_names.address',
            'list_of_names.customers_number'
        )
        ->leftJoin('list_of_names','list_of_names.id','=','invoices.name_id')
        ->where('invoices.id',$id)
        ->orderBy('invoices.reading_date','desc')
        ->first();
        // print_r(json_encode($invoices));
        // die();
        $names = ListOfName::get();
 // print_r(json_encode($invoices));
        // die();
        return view('admin.invoices.create', compact('invoices', 'names'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->all());

        return redirect()->route('admin.invoices.index');
    }

    public function show(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id = request()->segment(3);
        $invoice = Invoice::select(
            'invoices.*',
            'list_of_names.last_name',
            'list_of_names.first_name',
            'list_of_names.meter_number',
            'list_of_names.address',
            'list_of_names.customers_number'
        )
        ->leftJoin('list_of_names','list_of_names.id','=','invoices.name_id')
        ->where('invoices.id',$id)
        ->orderBy('invoices.reading_date','desc')
        ->first();

        return view('admin.invoices.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceRequest $request)
    {
        Invoice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getInvoiceLAtest(Request $request)
    {
        $name_id = $request->name_id;
        $Invoice = Invoice::where('name_id',$name_id)->orderby('created_at','desc')->first();
        return json_encode($Invoice);
    }

    public function getInvoiceLAtest_plusOne(Request $request)
    {
        $data = [];
        $name_id = $request->name_id;
        $Invoice = Invoice::where('name_id',$name_id)->orderby('created_at','desc')->get();
        if($Invoice){
            $Invoice = $Invoice->map(function($list, $key) {
                return [
                    'bill_number' => $list->bill_year.' - '.$list->bill_number,
                    'bill_year' => date('F Y',strtotime($list->reading_date_from)),
                    'reading_date_from' => date('Y-m-d',strtotime($list->reading_date_from)),
                    'reading_date_to' => date('Y-m-d',strtotime($list->reading_date_to)),
                    'reading_date_to_plus' => date('Y-m-d',strtotime($list->reading_date_to. ' +1 day')),
                    'prev_reading' => number_format($list->prev_reading, 2) ?? '',
                    'present_reading' => number_format($list->present_reading, 2) ?? '',
                    'total_amount' => number_format($list->total_amount, 2) ?? '',
                    'paymentStatus' => $list->paymentStatus,
                    'water_usage' => $list->water_usage,
                    'discount' => $list->discount,
                    'system_lost' => $list->system_lost,
                    'total_amount' => $list->total_amount,
                    'get_pay_until_date' => $list->get_pay_until_date,
                    'get_pay_until_date' => $list->get_pay_until_date,
                ];
            });
            $data['Invoice'] = $Invoice;
        } else {
            $data['Invoice'] = [];
        }
        $current_Date = date('Y');
        $Bill_number = Invoice::where('bill_year',$current_Date)->orderby('created_at','desc')->first();
        $bill_data = [];
        if($Bill_number){
            $bill_data['bill_year'] = $Bill_number->bill_year;
            $bill_data['bill_number'] = str_pad(($Bill_number->bill_number + 1) , 5, '0', STR_PAD_LEFT);
        } else {
            $bill_data['bill_year'] = $current_Date;
            $bill_data['bill_number'] = str_pad('1', 5, '0', STR_PAD_LEFT);
        }
        $ListOfName = ListOfName::where('id',$name_id)->first();
        $data['bill_data'] = $bill_data;
        $data['ListOfName'] = $ListOfName;

        return json_encode($data);
    }




    public function print(Request $request)
    {
        $id = $request->id;
        $invoice = Invoice::select(
            'invoices.*',
            'list_of_names.last_name',
            'list_of_names.first_name',
            'list_of_names.meter_number',
            'list_of_names.city',
            'list_of_names.customers_number',

        )
        ->leftJoin('list_of_names','list_of_names.id','=','invoices.name_id')
        ->where('invoices.id',$id)
        ->orderBy('invoices.reading_date_from','desc')
        ->first();
          //$fpdf = new Fpdf('P','mm',array(215.9,279.4)); //short bond paper
         $fpdf = new Fpdf('P','mm',array(125,160)); //actual size
        $fpdf->AddPage();
        $width = 50;
        $height = 6;
        $fpdf->SetFont('Courier', 'B', 20);
        $fpdf->Cell($width, $height, '   COMON WATERWORKS');
        $fpdf->ln();
        $fpdf->Cell($width, $height, '         And');
        $fpdf->ln();
        $fpdf->Cell($width, $height, ' Sanitation Association');
        $fpdf->ln(4);
        $fpdf->SetFont('Courier', 'B', 9);
        $fpdf->Cell($width, $height, 'Address: Nueva Vizcaya','C');
        $fpdf->ln(3);
        $fpdf->SetFont('Courier', 'B', 9);
        $fpdf->Cell($width, $height, 'Contact: +639318783025','C');
        $fpdf->ln();
        $fpdf->SetFont('Courier', 'B', 12);
        $fpdf->Cell($width, $height, 'Invoice No',2);
        $fpdf->Cell($width, $height, $invoice->bill_year.'-'.$invoice->bill_number,2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, 'Name:', 2);
        $fpdf->Cell($width, $height, $invoice->last_name.','.$invoice->first_name );
        //$fpdf->ln();
        //$fpdf->Cell($width, $height, 'Address',2);
        //$fpdf->Cell($width, $height, $invoice->Brgy,2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, 'Billing Month:',2);
        $fpdf->Cell($width, $height, date('F Y', strtotime($invoice->reading_date_from)),2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, 'Reading Date From -',2);
        $fpdf->Cell($width, $height, 'Reading Date To',2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, date('F j, Y', strtotime($invoice->reading_date_from)),2);
        $fpdf->Cell($width, $height, date('F j, Y', strtotime($invoice->reading_date_to)),2);
        $fpdf->ln();
        $fpdf->SetFont('Courier', 'B', 12);
        $fpdf->Cell($width, $height, 'Prev Reading',2);
        $fpdf->Cell($width, $height, number_format($invoice->prev_reading, 2) ?? '',2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, 'Present Reading',2);
        $fpdf->Cell($width, $height, number_format($invoice->present_reading, 2) ?? '',2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, 'Water Usage',2);
        $fpdf->Cell($width, $height, number_format($invoice->water_usage, 2) ?? '',2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, 'Due Date',2);
        $fpdf->Cell($width, $height, date('F j, Y', strtotime($invoice->get_pay_until_date)),2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, '10% Penalty;',2); //
        $fpdf->Cell($width, $height, date('F j, Y', strtotime($invoice->get_pay_until_date. "+1 day")),2);
        //if ($penalty -> $get_pay_until_date);
       // $fpdf->Cell($width, $height, date('F j, Y', strtotime($invoice->get_pay_until_date)),1); penalty
       $fpdf->ln();
        $b ='P';
        $fpdf->Cell($width, $height, 'Price Per Cb',2);
        $fpdf->Cell($width, $height, number_format($invoice->price_per_cb, 2).' '.$b ?? '',2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, 'Discount',2);
        $fpdf->Cell($width, $height, $invoice->discount.' %' ?? '',2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, 'System Lost',2);
        $fpdf->Cell($width, $height, number_format($invoice->system_lost, 2).' '.$b ?? '',2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, 'Total Amount',2);
        $fpdf->Cell($width, $height, number_format($invoice->total_amount, 2).' '.$b ?? '',2);
        $fpdf->ln();
        $fpdf->Cell($width, $height, 'Disconnnection:',2);
        $fpdf->Cell($width, $height, date('F j, Y', strtotime($invoice->disconnection_date)),2);
        $fpdf->ln();
        $fpdf->SetFont('Courier', 'B', 9);
        $fpdf->Cell($width, $height, '',2);
        $fpdf->Cell($width, $height,'THANK YOU! COWASA Management');
        $fpdf->ln();
        $fpdf->ln();
        $fpdf->Output();
        exit;
    }


    public function getAtleastFourLAstbill(Request $request)
    {
        $name_id = $request->name_id;
        $Invoice = Invoice::where('name_id',$name_id)->orderby('created_at','desc')->orderBy('reading_date_to','desc')->limit(4)->get();
        if($Invoice){
            $Invoice = $Invoice->map(function($list, $key) {
                return [
                    'bill_number' => $list->bill_year.' - '.$list->bill_number,
                    'bill_year' => date('F Y',strtotime($list->reading_date_from)),
                    'reading_date_from' => date('F j, Y',strtotime($list->reading_date_from)),
                    'reading_date_to' => date('F j, Y',strtotime($list->reading_date_to)),
                    'disconnection_date' => date('F j, Y',strtotime($list->disconnection_date)),
                    'reading_date_to_plus' => date('Y-m-d',strtotime($list->reading_date_to. ' +1 day')),
                    'prev_reading' => number_format($list->prev_reading, 2) ?? '',
                    'present_reading' => number_format($list->present_reading, 2) ?? '',
                    'total_amount' => number_format($list->total_amount, 2) ?? '',
                    'paymentStatus' => $list->paymentStatus,
                    'water_usage' => $list->water_usage,
                    'discount' => $list->discount,
                    'payment' => $list->payment,
                    'balance' => $list->balance,
                    'penalty' => $list->penalty,
                    'system_lost' => $list->system_lost,
                    'total_amount' => $list->total_amount,
                    'get_pay_until_date' => date('F j, Y',strtotime($list->get_pay_until_date)),
                ];
            });
        } else {
            $Invoice = [];
        }
        return json_encode($Invoice);
    }

    public function latest_four(Request $request)
    {
        $name_id = $request->name_id;
        //->limit(4)
        $Invoice = Invoice::where('name_id',$name_id)->orderby('created_at','desc')->orderBy('reading_date_to','desc')->get();
        if($Invoice){
            $Invoice = $Invoice->map(function($list, $key) {
                $paymentStatus = '';
                if($list->paymentStatus == 'New'){
                    if($list->get_pay_until_date < date('Y-m-d')){
                        $paymentStatus = 'Unpaid Overdue';
                    } else {
                        $paymentStatus = 'New';
                    }
                } else if($list->paymentStatus == 'Fully Paid'){
                    if($list->get_pay_until_date < $list->paymentdate){
                        $paymentStatus = 'Fully Paid with penalties';
                    } else {
                        $paymentStatus = 'Fully Paid';
                    }
                }

                return [
                    'id' => $list->id,
                    'bill_number' => $list->bill_year.' - '.$list->bill_number,
                    'bill_year' => date('F Y',strtotime($list->reading_date_from)),
                    'reading_date_from' => date('F j, Y',strtotime($list->reading_date_from)),
                    'reading_date_to' => date('F j, Y',strtotime($list->reading_date_to)),
                    'disconnection_date' => date('F j, Y',strtotime($list->disconnection_date)),
                    'reading_date_to_plus' => date('F j, Y',strtotime($list->reading_date_to. ' +1 day')),
                    'prev_reading' => number_format($list->prev_reading, 2) ?? '',
                    'present_reading' => number_format($list->present_reading, 2) ?? '',
                    'total_amount' => number_format($list->total_amount, 2) ?? '',

                    'paymentStatus' => $paymentStatus,

                    'water_usage' => $list->water_usage,
                    'discount' => $list->discount,
                    'payment' => $list->payment,
                    'balance' => $list->balance,
                    'penalty' => $list->penalty,
                    'system_lost' => $list->system_lost,
                    'total_amount' => $list->total_amount,
                    'get_pay_until_date' => date('F j, Y',strtotime($list->get_pay_until_date)),
                ];
            });
        } else {
            $Invoice = [];
        }

        $listOfName = ListOfName::where('id',$name_id)->first();
        if(!$listOfName){
            $listOfName = [];
        }
        $date['Invoice'] = $Invoice;
        $date['listOfName'] = $listOfName;
        return json_encode($date);
    }


    public function getinoiceWithDate(Request $request)
    {
        $results = ['message'=>'Please contact the administrator.','result'=>false];
        $to = $request->to;
        $from = $request->from;
        if(!empty($to) and !empty($from)){
            $invoices = Invoice::select(
                'invoices.*',
                'list_of_names.last_name',
                'list_of_names.first_name',
                'list_of_names.meter_number',
                'list_of_names.address',
                'list_of_names.customers_number'
            )
            ->leftJoin('list_of_names','list_of_names.id','=','invoices.name_id')
            // ->whereMonth('reading_date', '=', $Month)
            // ->whereYear('reading_date', '=', $Year)
            ->whereDate('reading_date_to', '<=', $to)
            ->whereDate('reading_date_to', '>=', $from)
            ->orderBy('invoices.reading_date_to','desc')
            ->get();
            if($invoices){

                $invoices = $invoices->map(function($list, $key) {

                    $cation ='';
                    if(!Gate::denies('invoice_show')){

                        $cation .='<a class="btn btn-xs btn-primary" href="'.route('admin.invoices.show', $list->id).'">View</a>';
                    }
                    if(!Gate::denies('invoice_edit')){
                        $cation .='<a class="btn btn-xs btn-info" href="'.route('admin.invoices.edit', $list->id).'">Edit</a>';
                    }
                    if(!Gate::denies('invoice_delete')){
                        $cation .='<form action="'.route('admin.invoices.destroy', $list->id).'" method="POST"';
                        $cation .='onsubmit="return confirm('.trans('global.areYouSure').');"';
                        $cation .='style="display: inline-block;">';
                        $cation .='<input type="hidden" name="_method" value="DELETE">';
                        $cation .='<input type="hidden" name="_token" value="'.csrf_token().'">';
                        $cation .='<input type="submit" class="btn btn-xs btn-danger" value="'.trans('global.delete').'">';
                        $cation .='</form>';
                    }

                    return [
                        'blank' => '',
                        'id' => $list->id,
                        'last_name' => $list->last_name,
                        'first_name' => $list->first_name,
                        'prev_reading' => $list->prev_reading,
                        'reading_date_from' => date('F j, Y',strtotime($list->reading_date_from)),
                        'reading_date_to' => date('F j, Y',strtotime($list->reading_date_to)),
                        'water_usage' => $list->water_usage,
                        'price_per_cb' => $list->price_per_cb,
                        'bill_year' => $list->bill_year.' - '.str_pad($list->bill_number, 5, '0', STR_PAD_LEFT),
                        'discount' => $list->discount,
                        'system_lost' => $list->system_lost,
                        'total_amount' => $list->total_amount,
                        'paymentStatus' => $list->paymentStatus,
                        'address' => $list->address,
                        'get_pay_until_date' => date('F j, Y', strtotime($list->get_pay_until_date)),
                        'disconnection_date' => date('F j, Y', strtotime($list->disconnection_date)),
                        'action' => $cation,
                    ];
                });


                $results = ['message'=>'success.','result'=>true,'invoices'=>$invoices];
            }
        } else {
            $results = ['message'=>'Please contact the administrator.','result'=>false];
        }
        return json_encode($results);
    }

    public function get_price(Request $request)
    {
        $results = ['message'=>'Please set price in the price management.','result'=>false];
        $reading_date_to = $request->reading_date_to;
        $reading_date_to_year = date('Y', strtotime($reading_date_to));
        $reading_date_to_month = date('m', strtotime($reading_date_to));

        $data = [];
        $d = BillSettings::whereYear('billing_date',$reading_date_to_year)->whereMonth('billing_date',$reading_date_to_month)->first();
        if($d){
            $results = ['message'=>'Please set price in the price management.','result'=>true,'data'=>$d];
        } else {
            $results = ['message'=>'Please set price in the price management.','result'=>false];
        }
        return json_encode($results );
    }


    public function price()
    {
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $BillSettings = BillSettings::get();
        return view('admin.invoices.index_price', compact('BillSettings'));
    }

    public function price_edit(Request $request)
    {
        $id =  $request->id;
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $bill = BillSettings::where('id',$id)->first();
        return view('admin.invoices.create_price', compact('bill'));
    }
    public function price_save(Request $request)
    {
        $results = ['message'=>'Please contact administrator','result'=>false];
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(isset($request->id) and !empty($request->id)){
            $update = BillSettings::where('id',$request->id)->update([
                'billing_date' => $request->billing_date,
                'price' => $request->price
            ]);
            if($update){
                $results = ['message'=>'Updated successfully.','result'=>true];
            }
        } else {
            $BillSettings = new BillSettings();
            $BillSettings->billing_date = $request->billing_date;
            $BillSettings->price = $request->price;
            $save = $BillSettings->save();
            if($save){
                $results = ['message'=>'Added successfully.','result'=>true];
            }
        }
        return json_encode($results);
    }

    public function create_price(Request $request)
    {
        return view('admin.invoices.create_price');
    }



    public function destroy_price(Request $request)
    {
        $BillSettings =BillSettings::where('id',$request->id)->delete();
        return back();
    }

}
