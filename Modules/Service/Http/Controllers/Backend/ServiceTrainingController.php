<?php

namespace Modules\Service\Http\Controllers\Backend;

use App\Authorizable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\CustomField\Models\CustomField;
use Modules\CustomField\Models\CustomFieldGroup;
use Modules\Service\Http\Requests\ServiceRequest;
use Modules\Service\Models\Service;
use Modules\Service\Models\ServiceBranches;
use Modules\Service\Models\ServiceEmployee;
use Modules\Service\Models\ServiceGallery;
use Modules\Service\Models\ServiceTraining;
use Yajra\DataTables\DataTables;

class ServiceTrainingController extends Controller
{
    // use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'service.training_service';
        // module name
        $this->module_name = 'service-training';

        // module icon
        // $this->module_icon = 'fa-solid fa-clipboard-list';

        view()->share([
            'module_title' => $this->module_title,
            // 'module_icon' => $this->module_icon,
            'module_name' => $this->module_name,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $module_action = 'List';
        return view('service::backend.servicetraining.index_datatable', compact('module_action'));
    }

    /**
     * Select Options for Select 2 Request/ Response.
     *
     * @return Response
     */
    public function index_list(Request $request)
    {
        $data = ServiceTraining::all();
         
        return response()->json($data);
    }

 

    public function bulk_action(Request $request)
    {
        $ids = explode(',', $request->rowIds);

        $actionType = $request->action_type;

        $message = __('messages.bulk_update');

        switch ($actionType) {
            case 'change-status':
                $services = ServiceTraining::whereIn('id', $ids)->update(['status' => $request->status]);
                $message = __('messages.bulk_servicetraining_update');
                break;

            case 'delete':

                if (env('IS_DEMO')) {
                    return response()->json(['message' => __('messages.permission_denied'), 'status' => false], 200);
                }

                ServiceTraining::whereIn('id', $ids)->delete();
                $message = __('messages.bulk_servicetraining_delete');
                break;

            default:
                return response()->json(['status' => false, 'message' => __('branch.invalid_action')]);
                break;
        }

        return response()->json(['status' => true, 'message' => __('messages.bulk_update')]);
    }

    public function update_status(Request $request, ServiceTraining $id)
    {
        $id->update(['status' => $request->status]);

        return response()->json(['status' => true, 'message' => __('branch.status_update')]);
    }

    public function index_data()
    {
        $query = ServiceTraining::query();

        return Datatables::of($query)
                        ->addColumn('check', function ($row) {
                            return '<input type="checkbox" class="form-check-input select-table-row"  id="datatable-row-'.$row->id.'"  name="datatable_ids[]" value="'.$row->id.'" onclick="dataTableRowCheck('.$row->id.')">';
                        })
                        ->addColumn('action', function ($data) {
                            return view('service::backend.servicetraining.action_column', compact('data'));
                        })
                        ->editColumn('status', function ($row) {
                            $checked = '';
                            if ($row->status) {
                                $checked = 'checked="checked"';
                            }
            
                            return '
                            <div class="form-check form-switch ">
                                <input type="checkbox" data-url="'.route('backend.service-training.update_status', $row->id).'" data-token="'.csrf_token().'" class="switch-status-change form-check-input"  id="datatable-row-'.$row->id.'"  name="status" value="'.$row->id.'" '.$checked.'>
                            </div>
                           ';
                        })
                        // ->editColumn('updated_at', function ($data) {
                        //     $module_name = $this->module_name;

                        //     $diff = Carbon::now()->diffInHours($data->updated_at);

                        //     if ($diff < 25) {
                        //         return $data->updated_at->diffForHumans();
                        //     } else {
                        //         return $data->updated_at->isoFormat('llll');
                        //     }
                        // })
                        ->rawColumns(['action', 'status', 'check'])
                        ->orderColumns(['id'], '-:column $1')
                        ->make(true);
    }

    public function index_list_data(Request $request)
    {

        $term = trim($request->q);

        $query_data = User::role('employee')->where(function ($q) {
            if (! empty($term)) {
                $q->orWhere('name', 'LIKE', "%$term%");
            }
        })->get();

        $data = [];

        foreach ($query_data as $row) {
            $data[] = [
                'id' => $row->id,
                'name' => $row->first_name.$row->last_name,
                'avatar' => $row->profile_image,
            ];
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $module_action = 'Create';

        return view('service::backend.services.create', compact('module_action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = ServiceTraining::create($request->all());

        $message = __('messages.create_form', ['form' => __($this->module_title)]);

        return response()->json(['message' => $message, 'status' => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $module_action = 'Show';

        $data = Service::findOrFail($id);

        return view('service::backend.services.show', compact('module_action', "$data"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = ServiceTraining::findOrFail($id);

        return response()->json(['data' => $data, 'status' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = ServiceTraining::findOrFail($id);

        $data->update($request->all());

        $message = __('messages.update_form', ['form' => __($this->module_title)]);

        return response()->json(['message' => $message, 'status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = ServiceTraining::findOrFail($id);

        $data->delete();

        $message = __('messages.delete_form', ['form' => __($this->module_title)]);

        return response()->json(['message' => $message, 'status' => true], 200);
    }

    /**
     * List of trashed ertries
     * works if the softdelete is enabled.
     *
     * @return Response
     */
    public function trashed()
    {
        $module_name_singular = Str::singular($this->module_name);

        $module_action = 'Trash List';

        $data = ServiceTraining::with('user')->onlyTrashed()->orderBy('deleted_at', 'desc')->paginate();

        return view('service::backend.servicetraining.trash', compact('data', 'module_name_singular', 'module_action'));
    }
    public function restore($id)
    {
        $data = ServiceTraining::withTrashed()->find($id);
        $data->restore();

        $message = Str::singular($this->module_title).' Data Restoreded Successfully';

        return redirect('app/servicetraining');
    }
    // public function update_status(Request $request, ServiceTraining $id)
    // {
    //     $id->update(['status' => $request->status]);

    //     return response()->json(['status' => true, 'message' => __('branch.status_update')]);
    // }

}
