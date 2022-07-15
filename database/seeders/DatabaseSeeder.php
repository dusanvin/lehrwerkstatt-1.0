<?php

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::raw('insert into roles (id, name, guard_name) values (1, "Admin", "web"), (2, "Moderierende", "web"), (3, "Lehr", "web"), (4, "Stud", "web");');
    }
       
}