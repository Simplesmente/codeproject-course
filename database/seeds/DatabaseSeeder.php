<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");

        $this->call(ClientTableSeeder::class);
        $this->call(ProjectTableSeeder::class);

        DB::statement("SET foreign_key_checks = 1");
    }
}
