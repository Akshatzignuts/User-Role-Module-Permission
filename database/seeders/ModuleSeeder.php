<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')->insert([
            'code' => 'Contact',
            'name' => 'Contact',
            'description' => 'details of company',
            'is_active' => '1',
            


        ]);
        DB::table('modules')->insert([

            'code' => 'Account',
            'name' => 'Account',
            'description' => 'information of work',
            'is_active' => '1',
            
        ]);
        DB::table('modules')->insert([

            'code' => 'Dashboard',
            'name' => 'Dashboard',
            'description' => 'All about dashboard',
            'is_active' => '1',
            
        ]);
        DB::table('modules')->insert([

            'code' => 'Permission',
            'name' => 'Permission',
            'description' => 'Define all the permission',
            'is_active' => '1',
            
        ]);
        DB::table('modules')->insert([

            'code' => 'Role',
            'name' => 'Role',
            'description' => 'Define roles of the user ',
            'is_active' => '1',
            
        ]);
        DB::table('modules')->insert([

            'code' => 'User',
            'name' => 'User',
            'description' => 'Define the user ',
            'is_active' => '1',
            
        ]);
        


        DB::table('modules')->insert([
            'code' => 'Company',
            'name' => 'Company',
            'description' => 'it has details of the company',
            'parent_module_code' => 'contact',
            'is_active' => '1',
            
        ]);
        DB::table('modules')->insert([
            'code' => 'People',
            'name' => 'People',
            'description' => 'it has details of peoples in company',
            'parent_module_code' => 'contact',
            'is_active' => '1',
           
        ]);
        DB::table('modules')->insert([
            'code' => 'Meeting',
            'name' => 'Meeting',
            'description' => 'it has details of meeting',
            'parent_module_code' => 'account',
            'is_active' => '1',
            

        ]);
        DB::table('modules')->insert([
            'code' => 'Notes',
            'name' => 'Notes',
            'description' => 'it has details of notes',
            'parent_module_code' => 'account',
            'is_active' => '1',
           
        ]);
        DB::table('modules')->insert([
            'code' => 'Activity_logs',
            'name' => 'Activity_logs',
            'description' => 'it has details of activity_logs',
            'parent_module_code' => 'account',
            'is_active' => '1',
            
        ]);
    }
}