<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
          array('name'=>'Human Resource'),
          array('name'=>'Finance'),
          array('name'=>'Sales'),
          array('name'=>'QMD'),
          array('name'=>'Administration'),
          array('name'=>'Information Technology'),
          array('name'=>'Accounting'),
          array('name'=>'Legal'),
          array('name'=>'Audit')
        ]);
    }
}
