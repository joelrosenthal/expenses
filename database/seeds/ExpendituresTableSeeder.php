<?php

use Illuminate\Database\Seeder;

class ExpendituresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Expenditure::class, 3)->create();
    }
}
