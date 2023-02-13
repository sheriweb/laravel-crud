<?php

namespace App\Repositories\Eloquent;

use App\Jobs\NewUser;
use App\Models\User;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class UserRepository implements BaseRepositoryInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    /**
     * @param $request
     * @return JsonResponse|string|void
     */
    public function save($request)
    {
        if ($request->user_id) {
            try {
                $user = $this->user->find($request->user_id);
                $user = $this->commonField($user, $request);
                if ($user->update()) {
                    if (!empty($request->interest_name)) {
                        $user->interests()->detach();
                        $user->interests()->attach($request->interest_name);
                    }

                    return response()->json([
                        'status' => 200,
                        'message' => 'Data Updated Successfully'
                    ]);
                }
            }catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            try {
                $user = new $this->user;
                $user = $this->commonField($user, $request);

                if ($user->save()) {
                    if (!empty($request->interest_name)) {
                        $user->interests()->attach($request->interest_name);
                    }

                    $job = (new NewUser($user));

                    dispatch($job);

                    return response()->json([
                        'status' => 200,
                        'message' => 'Data Saved Successfully'
                    ]);
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->user->find($id);
    }

    /**
     * @param $id
     * @return JsonResponse|string
     */
    public function delete($id)
    {
        try {
            $this->user->find($id)->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Data Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $user
     * @param $request
     * @return mixed
     */
    public function commonField($user, $request)
    {
        $user->name                = $request->name;
        $user->surname             = $request->surname;
        $user->email               = $request->email;
        $user->mobile_number       = $request->mobile_number;
        if (!$request->user_id) {
            $user->password        = Hash::make($request->password);
        }

        $user->south_african_id_no = $request->south_african_id_no;
        $user->dob                 = $request->dob;
        $user->language            = $request->language;

        return $user;
    }
}
