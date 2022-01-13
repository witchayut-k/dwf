<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Helpers\UploadHelper;
use App\Http\Requests\Backend\UserRequest;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new User());
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
            $query = User::select('*')
                ->with(['roles'])
                ->orderBy('name');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = User::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->make(true);
        }

        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $roles = UserRole::options();
        return view('backend.users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();

        if ($request->password)
            $user->password = bcrypt($request->password);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->syncRoles([$request->role]);
        return ResponseHelper::saveSuccess($request, $user, 'name');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = UserRole::options();
        return view('backend.users.create', compact('user', 'roles'));
    }

    /**
     * Update a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if ($request->password)
            $user->password = bcrypt($request->password);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        $user->syncRoles([$request->role]);
        return ResponseHelper::saveSuccess($request, $user, 'name');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if (User::count() > 1) {
            $user->delete();
            return ResponseHelper::deleteSuccess($request, $user, 'name');
        } else {
            return response()->json(['message' => 'ไม่สามารถลบข้อมูลผู้ใช้งานนี้ได้'], 422);
        }
    }

    /**
     * Media
     */
    public function uploadAvatar(Request $request)
    {
        $content = User::find($request->id);
        if ($request->file != null)
            UploadHelper::addMedia($request->file, $content, 'avatar_image');

        return response()->json(['result' => $content]);
    }
}
