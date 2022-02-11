<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Repositories\AdminRepository;
use App\Http\Controllers\AppBaseController;
use App\Traits\HasImage;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Schema;
use Response;

class AdminController extends AppBaseController
{
    use HasImage;
    /** @var AdminRepository $adminRepository*/
    private $adminRepository;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
        $this->middleware("auth:admin");
    }

    /**
     * Display a listing of the Admin.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // return Schema::getColumnListing("admins");
        $admins = $this->adminRepository->allQuery()->where("id","!=",1)->paginate();
        
        return view('admins.index')
            ->with('admins', $admins);
    }

    /**
     * Show the form for creating a new Admin.
     *
     * @return Response
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created Admin in storage.
     *
     * @param CreateAdminRequest $request
     *
     * @return Response
     */
    public function store(CreateAdminRequest $request)
    {
        $input = $request->all();
        $this->addImage($input,"avatar","storage");
        if(request("password"))
        {
            $input["password"] = bcrypt(request("password"));
        }else{
            unset($input["password"]);
        }
        $admin = $this->adminRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/admins.singular')]));

        return redirect(route('admins.index'));
    }

    /**
     * Display the specified Admin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/admins.singular')]));

            return redirect(route('admins.index'));
        }

        return view('admins.show')->with('admin', $admin);
    }

    /**
     * Show the form for editing the specified Admin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/admins.singular')]));

            return redirect(route('admins.index'));
        }

        return view('admins.edit')->with('admin', $admin);
    }

    /**
     * Update the specified Admin in storage.
     *
     * @param int $id
     * @param UpdateAdminRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdminRequest $request)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/admins.singular')]));

            return redirect(route('admins.index'));
        }
        $input = $request->all();
        
        $admin = $this->adminRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/admins.singular')]));

        return redirect(route('admins.index'));
    }

    /**
     * Remove the specified Admin from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/admins.singular')]));

            return redirect(route('admins.index'));
        }

        $this->adminRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/admins.singular')]));

        return redirect(route('admins.index'));
    }
}
