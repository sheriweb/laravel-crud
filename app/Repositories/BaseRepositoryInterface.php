<?php

namespace App\Repositories;

/**
 * Class BaseRepositoryInterface
 * @package App\Repositories
 */
interface BaseRepositoryInterface
{
    public function all();

    public function save($request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
