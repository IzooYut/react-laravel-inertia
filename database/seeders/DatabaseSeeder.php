<?php

namespace Database\Seeders;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userRole = Role::create(['name' => RolesEnum::User->value]);

        $commentorRole = Role::create(['name' => RolesEnum::Commenter->value]);

        $adminRole = Role::create(['name' => RolesEnum::Admin->value]);

        $manageFeaturesPermission = Permission::create([
            'name'=> PermissionsEnum::ManageFeatures->value
        ]);

        $manageCommentsPermission = Permission::create([
            'name'=> PermissionsEnum::ManageComments->value
        ]);

        $manageUsersPermission = Permission::create([
            'name'=> PermissionsEnum::ManageUsers->value
        ]);

        $upvoteDownvotePermission = Permission::create([
            'name'=> PermissionsEnum::UpvoteDownvote->value
        ]);

        $userRole->syncPermissions([$upvoteDownvotePermission]);
        $commentorRole->syncPermissions([$upvoteDownvotePermission,$manageCommentsPermission]);
        $adminRole->syncPermissions([
            $upvoteDownvotePermission,
            $manageCommentsPermission,
            $manageUsersPermission,
            $manageFeaturesPermission
        ]);

        User::factory()->create([
            'name' => 'User User',
            'email' => 'user@example.com',
        ])->assignRole(RolesEnum::User);

        User::factory()->create([
            'name' => 'Commentor User',
            'email' => 'commentor@example.com',
        ])->assignRole(RolesEnum::Commenter);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ])->assignRole(RolesEnum::Admin);


    }
}
