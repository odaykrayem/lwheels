<?php

namespace Database\Seeders;

use App\Models\CustomValue;
use Illuminate\Database\Seeder;

class CustomValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomValue::factory()->count(4)->create();
    }
}
