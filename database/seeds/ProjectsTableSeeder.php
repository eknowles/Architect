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
        factory(App\Project::class, 30)->create()->each(function($p) {
            $p->media()->saveMany(factory(App\Media::class, 8)->make());
        });
    }
}
