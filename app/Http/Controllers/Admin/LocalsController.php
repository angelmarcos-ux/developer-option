<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLocalRequest;
use App\Http\Requests\StoreLocalRequest;
use App\Http\Requests\UpdateLocalRequest;
use App\Models\Local;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LocalsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('local_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Local::query()->select(sprintf('%s.*', (new Local())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'local_show';
                $editGate = 'local_edit';
                $deleteGate = 'local_delete';
                $crudRoutePart = 'locals';

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
            $table->editColumn('barangay', function ($row) {
                return $row->barangay ? $row->barangay : '';
            });
            $table->editColumn('prk', function ($row) {
                return $row->prk ? $row->prk : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.locals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('local_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.locals.create');
    }

    public function store(StoreLocalRequest $request)
    {
        $local = Local::create($request->all());

        return redirect()->route('admin.locals.index');
    }

    public function edit(Local $local)
    {
        abort_if(Gate::denies('local_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.locals.edit', compact('local'));
    }

    public function update(UpdateLocalRequest $request, Local $local)
    {
        $local->update($request->all());

        return redirect()->route('admin.locals.index');
    }

    public function show(Local $local)
    {
        abort_if(Gate::denies('local_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.locals.show', compact('local'));
    }

    public function destroy(Local $local)
    {
        abort_if(Gate::denies('local_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local->delete();

        return back();
    }

    public function massDestroy(MassDestroyLocalRequest $request)
    {
        Local::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
