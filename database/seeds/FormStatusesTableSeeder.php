<?php

use Illuminate\Database\Seeder;

class FormStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form_statuses')->insert([
          array('name'=>'Open'),
          array('name'=>'Pending'),
          array('name' => 'Resolved'),
          array('name' => 'Closed')
        ]);
    }
}
