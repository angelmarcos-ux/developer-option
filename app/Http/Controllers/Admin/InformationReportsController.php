<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInformationReportRequest;
use App\Http\Requests\StoreInformationReportRequest;
use App\Http\Requests\UpdateInformationReportRequest;
use App\Models\InformationReport;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InformationReportsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('information_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InformationReport::query()->select(sprintf('%s.*', (new InformationReport())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'information_report_show';
                $editGate = 'information_report_edit';
                $deleteGate = 'information_report_delete';
                $crudRoutePart = 'information-reports';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('info_reports', function ($row) {
                return $row->info_reports ? $row->info_reports : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.informationReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('information_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.informationReports.create');
    }

    public function store(StoreInformationReportRequest $request)
    {
        $informationReport = InformationReport::create($request->all());

        return redirect()->route('admin.information-reports.index');
    }

    public function edit(InformationReport $informationReport)
    {
        abort_if(Gate::denies('information_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.informationReports.edit', compact('informationReport'));
    }

    public function update(UpdateInformationReportRequest $request, InformationReport $informationReport)
    {
        $informationReport->update($request->all());

        return redirect()->route('admin.information-reports.index');
    }

    public function show(InformationReport $informationReport)
    {
        abort_if(Gate::denies('information_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.informationReports.show', compact('informationReport'));
    }

    public function destroy(InformationReport $informationReport)
    {
        abort_if(Gate::denies('information_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $informationReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyInformationReportRequest $request)
    {
        InformationReport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
