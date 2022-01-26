<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRoleRequest;
use App\Models\UserRole;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserRoleController extends Controller
{
    public function __construct()
    {
        // parent::__construct(new Role());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_BACKEND_USER)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Role::select('*');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Role::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->order(function ($query) {
                    $query->orderBy('created_at', 'desc');
                })
                ->make(true);
        }

        return view('backend.user_roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        return view('backend.user_roles.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->syncPermissions(json_decode($request->permissions));
        return ResponseHelper::saveSuccess($request, $role, 'name');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findById($id);
        $userRole = UserRole::find($id);
        return view('backend.user_roles.create', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UserRoleRequest $request, $id)
    {
        $role = Role::findById($id);
        $userRole = UserRole::find($id);
        $userRole->name = $request->name;
        $userRole->update();

        $role->syncPermissions(json_decode($request->permissions));

        return ResponseHelper::saveSuccess($request, $role, 'name');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        $role->delete();
        return ResponseHelper::deleteSuccess($request, $role, 'name');
    }
}
