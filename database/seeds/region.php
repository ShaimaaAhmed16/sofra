<?php

use Illuminate\Database\Seeder;

class region extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Region::class,10)->create();
    }
}
