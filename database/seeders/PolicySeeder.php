<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Policy;
use App\Models\Role;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $policies = Policy::insert([
            [ "name" => "readall-user", "action" => "readall", "resource" => "user" ],
            [ "name" => "assign-user", "action" => "update", "resource" => "user" ],

            [ "name" => "create-role", "action" => "create", "resource" => "role" ],
            [ "name" => "readall-role", "action" => "readall", "resource" => "role" ],
            [ "name" => "update-role", "action" => "update", "resource" => "role" ],

            [ "name" => "create-ticket", "action" => "create", "resource" => "ticket" ],
            [ "name" => "readall-ticket", "action" => "readall", "resource" => "ticket" ],
            [ "name" => "delete-ticket", "action" => "delete", "resource" => "ticket" ],
            [ "name" => "open-ticket", "actipn" => "open", "resource" => "ticket" ],
            [ "name" => "close-ticket", "actipn" => "close", "resource" => "ticket" ],

        ]);

        $policies_ids = Policy::get('id');

        $owner_role = Role::where("name","owner")->first();
        $owner_role->policies()->attach($policies_ids);

        $owner = $owner_role->users()->first();
        $owner->policies()->attach($policies_ids);

    }
}
