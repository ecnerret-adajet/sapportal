<?php

use Illuminate\Database\Seeder;

class TargetserverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('targetservers')->insert([
          array('name'=>'PFMC'),
          array('name'=>'LFUG'),
          array('name'=>'MGC')
        ]);
    }
}
