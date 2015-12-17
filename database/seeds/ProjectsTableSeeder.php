<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CKD\Project::class, 30)->create()->each(function($p) {
            $p->media()->saveMany(factory(CKD\Media::class, 8)->make());
        });
    }
}
