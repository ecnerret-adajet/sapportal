<?php

use Illuminate\Database\Seeder;

class TargetsystemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('targetsystems')->insert([
          array('name'=>'QAS'),
          array('name'=>'PRD'),
          array('name'=>'DEV')
        ]);
    }
}
