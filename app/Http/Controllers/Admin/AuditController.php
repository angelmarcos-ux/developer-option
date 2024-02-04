<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAuditRequest;
use App\Http\Requests\StoreAuditRequest;
use App\Http\Requests\UpdateAuditRequest;
use App\Models\Audit;
use App\Models\Invoice;
use App\Models\ListOfName;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('audit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $invoices = Invoice::select(
            'invoices.*',
            'list_of_names.last_name',
            'list_of_names.first_name',
            'list_of_names.meter_number'
            
        )
        ->leftJoin('list_of_names','list_of_names.id','=','invoices.name_id')
        ->orderBy('invoices.reading_date_to','desc')
        ->get();
        return view('admin.audits.index', compact('invoices'));
    }

    public function create()
    {
        abort_if(Gate::denies('audit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lastnames = ListOfName::pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $firstnames = ListOfName::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.audits.create', compact('firstnames', 'lastnames'));
    }

    public function store(StoreAuditRequest $request)
    {
        $audit = Audit::create($request->all());

        return redirect()->route('admin.audits.index');
    }

    public function edit(Audit $audit)
    {
        abort_if(Gate::denies('audit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lastnames = ListOfName::pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $firstnames = ListOfName::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $audit->load('lastname', 'firstname');

        return view('admin.audits.edit', compact('audit', 'firstnames', 'lastnames'));
    }

    public function update(UpdateAuditRequest $request, Audit $audit)
    {
        $audit->update($request->all());

        return redirect()->route('admin.audits.index');
    }

    public function show(Audit $audit)
    {
        abort_if(Gate::denies('audit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $audit->load('lastname', 'firstname');

        return view('admin.audits.show', compact('audit'));
    }

    public function destroy(Audit $audit)
    {
        abort_if(Gate::denies('audit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $audit->delete();

        return back();
    }

    public function massDestroy(MassDestroyAuditRequest $request)
    {
        Audit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function audit(Request $request)
    {
        $id = $request->id;
        Invoice::where('id', $id)->update([
            'autditStatus' => 'audited'
        ]);
        return redirect()->route('admin.audits.index');
        // return response(null, Response::HTTP_NO_CONTENT);
    }

    public function invoiceAudit(Request $request)
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
                'list_of_names.customers_number'
                
            )
            ->leftJoin('list_of_names','list_of_names.id','=','invoices.name_id')
            ->whereDate('reading_date_to', '<=', $to)
            ->whereDate('reading_date_to', '>=', $from)
            ->orderBy('invoices.reading_date_to','desc')
            ->get();
            if($invoices){

                $invoices = $invoices->map(function($list, $key) {	
                    $status = '';
                    if($list->autditStatus == 'audited'){
                        $status = 'Audited';
                    } else {
                        $status = 'Not Audited';
                    } 
                    $action ='';
                    if($list->autditStatus != 'audited'){
                        $action ='<a class="btn btn-xs btn-primary" href="'.route('auditLogs', ['id'=>$list->id]).'">Approve</a>';
                    }
                    return [
                        'blank' => '',
                        'id' => str_pad($list->id, 5, '0', STR_PAD_LEFT),
                        'bill_year' =>  $list->bill_year,
                        'bill_number' =>  $list->bill_number,
                        'last_name' => $list->last_name,
                        'first_name' => $list->first_name,
                        'prev_reading' => number_format($list->prev_reading, 2) ?? '',
                        'present_reading' => number_format($list->present_reading, 2) ?? '',
                        'water_usage' =>  number_format($list->water_usage, 2) ?? '',
                        'price_per_cb' => number_format($list->price_per_cb, 2) ?? '',
                        'discount' => $list->discount.'  %',
                        'system_lost' => number_format($list->system_lost, 2) ?? '',
                        'total_amount' => number_format($list->total_amount, 2) ?? '',
                        'autditStatus' => $status,
                        'action' => $list->disconnectionStatus,
                    ];
                });


                $results = ['message'=>'success.','result'=>true,'invoices'=>$invoices];
            }
        } else {
            $results = ['message'=>'Please contact the administrator.','result'=>false];
        }
        return json_encode($results);
    }



}
