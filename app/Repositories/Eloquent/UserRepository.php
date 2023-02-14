<?php

namespace App\Repositories\Eloquent;

use App\Jobs\NewUser;
use App\Models\User;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * @return Builder[]|Collection
     */
    public function getUsers()
    {
        return $this->model::query()->where('id', '!=', 1)->get();
    }
}
