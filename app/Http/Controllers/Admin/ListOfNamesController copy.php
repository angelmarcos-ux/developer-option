<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyListOfNameRequest;
use App\Http\Requests\StoreListOfNameRequest;
use App\Http\Requests\UpdateListOfNameRequest;
use App\Models\ListOfName;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ListOfNamesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('list_of_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ListOfName::query()->select(sprintf('%s.*', (new ListOfName())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'list_of_name_show';
                $editGate = 'list_of_name_edit';
                $deleteGate = 'list_of_name_delete';
                $crudRoutePart = 'list-of-names';

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
            $table->editColumn('house_number', function ($row) {
                return $row->house_number ? $row->house_number : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('middle_initial', function ($row) {
                return $row->middle_initial ? $row->middle_initial : '';
            });
            $table->editColumn('customers_number', function ($row) {
                return $row->customers_number ? $row->customers_number : '';
            });
            $table->editColumn('meter_number', function ($row) {
                return $row->meter_number ? $row->meter_number : '';
            });
            $table->editColumn('Province', function ($row) {
                return $row->address ? ($row->Province.' '.$row->City) : '';
            });
            $table->editColumn('installation', function ($row) {
                return $row->installation ? ListOfName::INSTALLATION_SELECT[$row->installation] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.listOfNames.index');
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
        
                    $ListOfName = new ListOfName();
                    $ListOfName->house_number = $request->house_number;
                    $ListOfName->last_name = $request->last_name;
                    $ListOfName->first_name = $request->first_name;
                    $ListOfName->middle_initial = $request->middle_initial;
                    $ListOfName->customers_number = $request->customers_number;
                    $ListOfName->meter_number = $request->meter_number;  
                    $ListOfName->installation = 'Installed';

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
        
        return json_encode($results);
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
}
