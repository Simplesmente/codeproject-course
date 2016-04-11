<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\ProjectMembers;

class ProjectMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Project::truncate();
      factory(ProjectMembers::class,10)->create();

    }
}
