<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyListOfNameRequest;
use App\Http\Requests\StoreListOfNameRequest;
use App\Http\Requests\UpdateListOfNameRequest;
use App\Models\ListOfName;
use App\Models\Invoice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ListOfNamesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('list_of_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ListOfName = ListOfName::select(
            '*'
        )
        ->get();
        return view('admin.listOfNames.index', compact('ListOfName'));
    }

    public function create()
    {
        abort_if(Gate::denies('list_of_name_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.listOfNames.create');
    }

    public function store(Request $request)
    {
        $results = ['message'=>'Please contact the administrator.','result'=>false];
        if(isset($request->id) and !empty($request->id)){
            $data = $request->all();
            $id = $request->id;
            unset($data['id']);
            unset($data['_token']);
            $update = ListOfName::where('id',$id)->update(
                $data
            );
            if( $update){
                $results = ['message'=>'Updated successfully.','result'=>true];
            }
        } else {
            $check = ListOfName::where('meter_number',$request->meter_number)->first();
            if($check){
                $results = ['message'=>'Meter number already exist.','result'=>false];
            } else {
                if(empty($request->last_name)){
                    $results = ['message'=>'last name is required.','result'=>false];
                    return json_encode($results);
                }

                if(empty($request->first_name)){
                    $results = ['message'=>'first name is required.','result'=>false];
                    return json_encode($results);
                }

                if(empty($request->middle_initial)){
                    $results = ['message'=>'middle initial is required.','result'=>false];
                    return json_encode($results);
                }


                if(empty($request->Province)){
                    $results = ['message'=>'Province is required.','result'=>false];
                    return json_encode($results);
                }

                if(empty($request->City)){
                    $results = ['message'=>'City is required.','result'=>false];
                    return json_encode($results);
                }

                if(empty($request->Brgy)){
                    $results = ['message'=>'Brgy is required.','result'=>false];
                    return json_encode($results);
                }

                if(empty($request->Purok)){
                    $results = ['message'=>'Purok is required.','result'=>false];
                    return json_encode($results);
                }

                if(empty($request->Street)){
                    $results = ['message'=>'Street is required.','result'=>false];
                    return json_encode($results);
                }

                $check2 = ListOfName::where('last_name',$request->last_name)->where('first_name',$request->first_name)->first();
                if($check2){
                    $results = ['message'=>'Name already exist.','result'=>false];
                } else {
                    if(empty($request->house_number)){
                        $results = ['message'=>'house number is required.','result'=>false];
                        return json_encode($results);
                    }
                    if(!is_numeric($request->house_number)){
                        $results = ['message'=>'house number required number only.','result'=>false];
                        return json_encode($results);
                    }

                    $check = ListOfName::where('customers_number',$request->customers_number)->first();
                    if($check){
                        $results = ['message'=>'Customer Number already exist.','result'=>false];
                    } else {




                        $ListOfName = new ListOfName();
                        $ListOfName->house_number = $request->house_number;
                        $ListOfName->last_name = $request->last_name;
                        $ListOfName->first_name = $request->first_name;
                        $ListOfName->middle_initial = $request->middle_initial;

                        $customers_number  = $request->customers_number;
                        $customers_number  = explode("-",$customers_number);

                        $ListOfName->customer_year =  $customers_number[0];
                        $ListOfName->customer_number = $customers_number[1];

                        $ListOfName->meter_number = $request->meter_number;
                        $ListOfName->installation = 'Installed';
                        $ListOfName->phone = $request->phone;
                        $ListOfName->Province = $request->Province;
                        $ListOfName->City = $request->City;
                        $ListOfName->Brgy = $request->Brgy;
                        $ListOfName->Purok = $request->Purok;
                        $ListOfName->Street = $request->Street;
                        $save = $ListOfName->save();
                        if($save){
                            $results = ['message'=>'Added successfully.','result'=>true];
                        }
                    }

                }

            }
        }

        return json_encode($results);
    }

    public function get_customer(ListOfName $listOfName)
    {
        $current_Date = date('Y');
        $ListOfN = ListOfName::where('customer_year',$current_Date)->orderby('created_at','desc')->first();
        $data = [];
        if($ListOfN){
            $data['year'] = $year = $ListOfN->customer_year;
            $data['number'] = $number = str_pad(($ListOfN->customer_number + 1) , 5, '0', STR_PAD_LEFT);
        } else {
            $data['year'] = $current_Date;
            $data['number'] = str_pad('1', 5, '0', STR_PAD_LEFT);
        }
        return json_encode($data);
    }
    public function edit(ListOfName $listOfName)
    {
        abort_if(Gate::denies('list_of_name_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = request()->segment(3);
        $list = ListOfName::where('id',$id)->first();
        return view('admin.listOfNames.create', compact('list'));
    }

    public function update(UpdateListOfNameRequest $request, ListOfName $listOfName)
    {
        $listOfName->update($request->all());

        return redirect()->route('admin.list-of-names.index');
    }

    public function show(ListOfName $listOfName)
    {
        abort_if(Gate::denies('list_of_name_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.listOfNames.show', compact('listOfName'));
    }

    public function destroy(ListOfName $listOfName)
    {
        abort_if(Gate::denies('list_of_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listOfName->delete();

        return back();
    }

    public function massDestroy(MassDestroyListOfNameRequest $request)
    {
        ListOfName::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function StatusSave(Request $request)
    {
        $results = ['message'=>'Please contact the administrator.','result'=>false];
        $id = $request->id;
        $Connection = $request->Connection;
        $update = ListOfName::where('id', $id)->update([
            'connection' => $Connection
        ]);
        if($update){
            $results = ['message'=>'Successfully set status.','result'=>true];
        }
        return json_encode($results);
    }

    public function ledger(Request $request){
        $id = $request->id;
        $listOfName = ListOfName::where('id',$id)->first();
        $Invoice = Invoice::where('name_id',$id)->get();
        return view('admin.listOfNames.ledger', compact('listOfName','Invoice'));
    }

    public function ledger_ajax(Request $request){
        $data = [];
        $id = $request->id;
        $listOfName = ListOfName::where('id',$id)->first();
        $Invoice = Invoice::where('name_id',$id)->get();
        if(!$listOfName){
            $listOfName = [];
        }
        if(!$Invoice){
            $Invoice = [];
        } else {
            $Invoice = $Invoice->map(function($list, $key) {
                return [
                    'id' => $list->id,
                    'bill_number' => $list->bill_year.' - '.$list->bill_number,
                    'bill_year' => date('F Y',strtotime($list->reading_date_from)),
                    'reading_date_from' => date('F j, Y',strtotime($list->reading_date_from)),
                    'reading_date_to' => date('F j, Y',strtotime($list->reading_date_to)),
                    'get_pay_until_date' => date('F j, Y',strtotime($list->get_pay_until_date)),
                    'disconnection_date' => date('F j, Y',strtotime($list->disconnection_date)),  //
                    'prev_reading' => number_format($list->prev_reading, 2) ?? '',
                    'present_reading' => number_format($list->present_reading, 2) ?? '',
                    'total_amount' => number_format($list->total_amount, 2) ?? '',
                    'paymentStatus' => $list->paymentStatus,
                ];
            });
        }
        $data['listOfName'] = $listOfName;

        $data['Invoice'] = $Invoice;
        return ($data);
    }


}
