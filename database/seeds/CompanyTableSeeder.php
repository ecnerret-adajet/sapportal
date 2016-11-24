<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('companies')->insert([
          array('name'=>'PFMC'),
          array('name'=>'LFUG'),
          array('name'=>'PLILI'),
          array('name'=>'ATH'),
          array('name'=>'MGC'),
          array('name'=>'MGPCI'),
          array('name'=>'ALC'),
          array('name'=>'MTPCI')
        ]);
    }
}
