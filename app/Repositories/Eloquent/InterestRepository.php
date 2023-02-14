<?php

namespace App\Repositories\Eloquent;

use App\Models\Interest;
use App\Repositories\InterestRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class InterestRepository extends BaseRepository implements InterestRepositoryInterface
{

    public function __construct(Interest $interest)
    {
        parent::__construct($interest);
    }
}
