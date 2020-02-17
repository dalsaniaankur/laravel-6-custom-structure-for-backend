<?php

use Illuminate\Database\Seeder;
use \App\Classes\Models\Roles\Roles;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $items = [['role_id'   => 1,
                   'role_name' => 'Admin'],
                  ['role_id'   => 2,
                   'role_name' => 'School'],
                  ['role_id'   => 3,
                   'role_name' => 'Teacher'],
                  ['role_id'   => 4,
                   'role_name' => 'Student'],
                  ['role_id'   => 5,
                   'role_name' => 'Parent'],
                  ['role_id'   => 5,
                   'role_name' => 'PTA'],


        ];
        foreach ( $items as $item ) {
            Roles::create( $item );
        }
    }
}
