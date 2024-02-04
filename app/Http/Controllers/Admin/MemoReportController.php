<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMemoReportRequest;
use App\Http\Requests\StoreMemoReportRequest;
use App\Http\Requests\UpdateMemoReportRequest;
use App\Models\MemoReport;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MemoReportController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('memo_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MemoReport::query()->select(sprintf('%s.*', (new MemoReport())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'memo_report_show';
                $editGate = 'memo_report_edit';
                $deleteGate = 'memo_report_delete';
                $crudRoutePart = 'memo-reports';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.memoReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('memo_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.memoReports.create');
    }

    public function store(StoreMemoReportRequest $request)
    {
        $memoReport = MemoReport::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $memoReport->id]);
        }

        return redirect()->route('admin.memo-reports.index');
    }

    public function edit(MemoReport $memoReport)
    {
        abort_if(Gate::denies('memo_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.memoReports.edit', compact('memoReport'));
    }

    public function update(UpdateMemoReportRequest $request, MemoReport $memoReport)
    {
        $memoReport->update($request->all());

        return redirect()->route('admin.memo-reports.index');
    }

    public function show(MemoReport $memoReport)
    {
        abort_if(Gate::denies('memo_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.memoReports.show', compact('memoReport'));
    }

    public function destroy(MemoReport $memoReport)
    {
        abort_if(Gate::denies('memo_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memoReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyMemoReportRequest $request)
    {
        MemoReport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('memo_report_create') && Gate::denies('memo_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MemoReport();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
