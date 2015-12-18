<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ProjectsTableSeeder::class);

        foreach ((range(1, 20)) as $index) {

            $type = rand(0, 1) == 1 ? 'App\Project' : 'App\Page';


            DB::table('linkables')->insert(
                [
                    'link_id' => rand(1, 20),
                    'taggable_id' => rand(1, 20),
                    'taggable_type' => rand(0, 1) == 1 ? 'App\Post' : 'App\Video'
                ]
            );

        }

        Model::reguard();
    }
}
