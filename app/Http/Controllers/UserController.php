<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSaveRequest;
use App\Jobs\NewUser;
use App\Services\UserService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
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
     * @var UserService
     */
    private $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $interests = $this->userService->getInterests();

        return view('dashboard', compact('interests'));
    }

    /**
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $user = $this->userService->getUsers();

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
        if ($request->user_id) {
            try {
                $this->userService->updateUser($request->except('password'), $request->user_id);

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Updated Successfully'
                ]);
            }catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            try {
                $user = $this->userService->createUser($request->validated());

                if (!empty($request->interest_name)) {
                    $user->interests()->attach($request->interest_name);
                }

                NewUser::dispatch($user);

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Saved Successfully'
                ]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->userService->getUser($id);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
         $this->userService->delete($id);

         return response()->json([
            'status'  => 200,
            'message' => 'Data Deleted Successfully'
         ]);
    }
}
