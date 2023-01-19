<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
        ->count(5)
        ->hasParticipants(2)
        // ->hasRewardRecords(2)
        ->hasWithdrawals(2)
        ->hasRewardRegistries(2)
        ->hasRefRecords(2)
        ->create();


        User::factory()
        ->count(3)
        ->create();

        User::factory()
        ->count(2)
        ->hasRewardRecords(2)
        ->create();
    }
}
