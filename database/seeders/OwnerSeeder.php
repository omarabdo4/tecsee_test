<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $owner_role = new Role();
        $owner_role->name = "owner";
        $owner_role->save();
        
        $owner = new User();
        $owner->name = "Owner";
        $owner->email = "owner@tectest.com";
        $owner->password = Hash::make("123456");
        $owner->role_id = $owner_role->id;
        $owner->save();

    }
}
