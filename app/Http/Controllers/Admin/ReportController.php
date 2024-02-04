<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\ListOfName;
use App\Models\Report;
use Gate;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        #6mC(v'37Gd362aweqwe23232a
        $invoices = Invoice::select(
            'invoices.*',
            'list_of_names.last_name',
            'list_of_names.first_name',
            'list_of_names.meter_number',
            'list_of_names.connection'
            
        )
        ->leftJoin('list_of_names','list_of_names.id','=','invoices.name_id')
        ->whereNotNull('invoices.paymentdate')
        ->orderBy('invoices.reading_date_to','desc')
        ->get();
        // print_r(json_encode($invoices));
        // die();



        return view('admin.reports.index', compact('invoices'));
    }

    public function create()
    {
        abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = ListOfName::get();
        // $Invoice = Invoice::select()where->first();
 
        return view('admin.reports.create', compact('names'));
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lastnames = ListOfName::pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $first_names = ListOfName::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report->load('lastname', 'first_name');

        return view('admin.reports.edit', compact('first_names', 'lastnames', 'report'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->load('lastname', 'first_name');

        return view('admin.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        Report::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getinoiceWithDatereport(Request $request)
    {
        $results = ['message'=>'Please contact the administrator.','result'=>false];
        $from = $request->from;
        $to = $request->to;
        if(!empty($from) and !empty($to)){
            $invoices = Invoice::select(
                'invoices.*',
                'list_of_names.last_name',
                'list_of_names.first_name',
                'list_of_names.meter_number',
                'list_of_names.address',
                'list_of_names.customers_number',
                'list_of_names.connection'
                
            )
            ->leftJoin('list_of_names','list_of_names.id','=','invoices.name_id')
            ->whereDate('reading_date_to', '<=', $to)
            ->whereDate('reading_date_to', '>=', $from)
            ->whereNotNull('invoices.paymentdate')
            ->orderBy('invoices.reading_date_to','desc')
            ->get();
            if($invoices){

                $invoices = $invoices->map(function($list, $key) {	
                    return [
                        'blank' => '',
                        'id' => str_pad($list->id, 5, '0', STR_PAD_LEFT),
                        'last_name' => $list->last_name,
                        'first_name' => $list->first_name,
                        'prev_reading' => number_format($list->prev_reading, 2) ?? '',
                        'present_reading' => number_format($list->present_reading, 2) ?? '',
                        'water_usage' =>  number_format($list->water_usage, 2) ?? '',
                        'price_per_cb' => number_format($list->price_per_cb, 2) ?? '',
                        'discount' => $list->discount.'  %',
                        'system_lost' => number_format($list->system_lost, 2) ?? '',
                        'total_amount' => number_format($list->total_amount, 2) ?? '',
                        'penalty' => $list->penalty,
                        'payment' => $list->payment,
                        'paymentStatus' => $list->paymentStatus,
                        'connection' => $list->connection,
                    ];
                });


                $results = ['message'=>'success.','result'=>true,'invoices'=>$invoices];
            }
        } else {
            $results = ['message'=>'Please contact the administrator.','result'=>false];
        }
        return json_encode($results);
    }

    public function getDatailsClient(Request $request)
    {
        $id = $request->id;
        $ListOfName = ListOfName::where('id',$id)->first();
        if(!$ListOfName){
            $ListOfName = [];
        }
        return json_encode($ListOfName);
    }
}
