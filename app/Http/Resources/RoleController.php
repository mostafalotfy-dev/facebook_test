<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Repositories\RoleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class RoleController extends AppBaseController
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
        $this->middleware("can:view-roles")->only("index","show");
        $this->middleware("can:add-roles")->only("create","store");
        $this->middleware("can:delete-roles")->only("destroy");
        $this->middleware("can:update-roles")->only("edit","update");

    }

    /**
     * Display a listing of the Role.
     *
     * @param RoleDataTable $roleDataTable
     * @return Response
     */
    public function index(RoleDataTable $roleDataTable)
    {
        return $roleDataTable->render('roles.index');
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $groups = $permissions->map(function ($permission) {
            return explode("-", $permission->name)[1];
        })->unique();
        return view('roles.create', compact('permissions', "groups"));    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();
       // \DB::beginTransaction();

        $input["guard_name"] = "admin";

        $role = $this->roleRepository->create($input);
        if ($request['roles']) {
            $permission = Permission::whereIn('id', $request['roles'])->get();
            $role->givePermissionTo($permission);
        }
/*         $role->givePermissionTo(Permission::find(request("permissions")));
 */

     session()->flash('success','Role Added Successfully');


        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(__('messages.not_found', ['model' => __('models/roles.singular')]));

            return redirect(route('roles.index'));
        }

        return view('roles.show')->with('role', $role);
    }
    private function createPermissionGroupsAll($permissions)
    {

        return $permissions->map(function ($perm) {

            return explode("-", $perm->name)[1];
        })->unique();
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(__('messages.not_found', ['model' => __('models/roles.singular')]));

            return redirect(route('roles.index'));
        }
        $permissions = Permission::all();
        $groups = $this->createPermissionGroupsAll($permissions);
        return view('roles.edit', compact('role', 'permissions', "groups"));
    }

    /**
     * Update the specified Role in storage.
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

/*         $role->givePermissionTo(Permission::find(request("permissions")));
 */        if (empty($role)) {
            Flash::error(__('messages.not_found', ['model' => __('models/roles.singular')]));

            return $this->sendError("Not Found");
        }
        $input = $request->all();


        $role = $this->roleRepository->update($input, $id);
        if ($request['roles'] && $role->name != "super-admin") {
            $permission = Permission::whereIn('id', $request['roles'])->get();

            $role->syncPermissions($permission);
        }
        Flash::success(__('messages.updated', ['model' => __('models/roles.singular')]));

        return $this->sendSuccess("roles.index");
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(__('messages.not_found', ['model' => __('models/roles.singular')]));

            return redirect(route('roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/roles.singular')]));

        return redirect(route('roles.index'));
    }
}
