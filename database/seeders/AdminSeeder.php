<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class AdminSeeder
 * @package App\Models\Interest
 */
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'             => 'Anke',
            'surname'          => 'Terblanche',
            'email'            => 'anke@propay.co.za',
            'password'         => Hash::make('secret'),
            'mobile_number'    => '27 (0) 86 750 0333',
            'dob'              => '1997-04-14 00:00:00',
            'south_african_id_no' => 12345678,
            'language'         => 'english',
        ]);
    }
}
