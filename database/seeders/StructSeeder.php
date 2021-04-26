<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StructSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('struct')->insert([
            ['name' => 'Home', 'parent_id' => null],
            ['name' => 'Users', 'parent_id' => 1],
            ['name' => 'Global', 'parent_id' => 1],
            ['name' => 'Adam', 'parent_id' => 2],
            ['name' => 'Annie', 'parent_id' => 2]
        ]);
    }
}
