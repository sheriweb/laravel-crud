<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;

/**
 * Class InterestSeeder
 * @package App\Models\Interest
 */
class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = [
            ['name' => 'Writing'],
            ['name' => 'Blogging'],
            ['name' => 'Photography'],
            ['name' => 'Travel'],
            ['name' => 'Reading'],
            ['name' => 'Yoga'],
            ['name' => 'Art'],
            ['name' => 'Sports'],
        ];

        Interest::insert($record);
    }
}
