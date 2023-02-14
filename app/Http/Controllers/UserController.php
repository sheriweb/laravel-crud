<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSaveRequest;
use App\Models\Interest;
use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $interests = Interest::all();

        return view('dashboard',compact('interests'));
    }

    /**
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $user = User::where('id','!=', 1)->get();

            return Datatables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    return '
                             <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findUser(\'/user/find/' . $user->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" onclick="deleteUser(\'/user/delete/' . $user->id . '\')">
                                        <i class="dw dw-delete-3" style="cursor: pointer;"> Delete</i>
                                    </a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * @param UserSaveRequest $request
     * @return JsonResponse|string|null
     */
    public function save(UserSaveRequest $request)
    {
        return $this->userRepository->save($request);
    }

    public function find(int $id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param int $id
     * @return JsonResponse|string
     */
    public function delete(int $id)
    {
        return $this->userRepository->delete($id);
    }
}
