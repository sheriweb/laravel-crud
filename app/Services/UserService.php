<?php

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;
use App\Repositories\InterestRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var InterestRepositoryInterface
     */
    private $interestRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param InterestRepositoryInterface $interestRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, InterestRepositoryInterface $interestRepository)
    {
        $this->userRepository = $userRepository;
        $this->interestRepository = $interestRepository;
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function getUser(int $id): ?Model
    {
        return $this->userRepository->findById($id);
    }

    /**
     * @param array $validated
     * @param $user_id
     * @return bool
     */
    public function updateUser(array $validated, $user_id): bool
    {
        return $this->userRepository->update($user_id, $validated);
    }

    /**
     * @return Collection
     */
    public function getInterests(): Collection
    {
        return $this->interestRepository->all();
    }

    /**
     * @param array $validated
     * @return Model|null
     */
    public function createUser(array $validated): ?Model
    {
        return $this->userRepository->create($validated);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->userRepository->deleteById($id);
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }
}
