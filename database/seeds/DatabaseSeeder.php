<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Langage::class, 5)
            ->create()
            ->each(function($lang) {
               $lang->translations()->saveMany(factory(App\Translation::class,
                   rand(2, 4))->make());
            });
    }
}
