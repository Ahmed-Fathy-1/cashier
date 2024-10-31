<?php

namespace Database\Seeders\landlord;

use Carbon\Carbon;
use App\Models\SuperAdmin\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    private $permissions = [
        'Role-list',
        'Role-create',
        'Role-edit',
        'Role-delete',

        'User-list',
        'User-create',
        'User-edit',
        'User-delete',
        'User-restore',
        'User-forceDelete',

        'aboutUs-edit',
        'features-edit',
        'homeCover-edit',
        'mainNeeds-edit',
        'settings-edit',
        'profilePage',


        'Domain-list',

        'contactUs-list',
        'contactUs-delete',
        'contactUs-forceDeleted',
        'contactUs-restore',

        'faqs-list',
        'faqs-create',
        'faqs-forceDelete',
        'faqs-delete',
        'faqs-edit',
        'faqs-restored',
        'faqs-delete',

        'feedbacks-list',
        'feedbacks-restore',
        'feedbacks-forceDelete',
        'feedbacks-delete',

        'subNeeds-list',
        'subNeeds-create',
        'subNeeds-restore',
        'subNeeds-forceDelete',
        'subNeeds-edit',
        'subNeeds-delete',

        'packages-list',
        'package-create',
        'packages-archived',
        'packages-edit',
        'packages-delete',
        'packages-forceDelete',
        'packages-restore',

        'technologies-list',
        'technologies-create',
        'technologies-forceDelete',
        'technologies-edit',
        'technologies-delete',
        'technologies-restore',

        'tenants-list',
        'tenants-edit',
        'tenants-create',

        'payments-list',
        'payments-edit',
        'payments-delete',
        'payments-forceDelete',
        'payments-restore',
        'payments-status',

        'paymentMethods-edit',
        'paymentMethods-delete',
        'paymentMethods-create',
        'paymentMethods-list',
        'paymentMethods-forceDelete',
        'paymentMethods-restore'

    ];

    private $users = [
        [
            "name" => "Ahmed Fathy",
            "email" => "SuperAdmin@admin.com",
        ],
        [
            "name" => "Ayman Fathy",
            "email" => "AymanAdmin@pos.com",
        ],
        [
            "name" => "ibrahem Fathy",
            "email" => "ibrahemAdmin@pos.com",
        ],
        [
            "name" => "mohamed Fathy",
            "email" => "mohamedAdmin@pos.com",
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions
        $this->createPermissions();

        // Create admin user and assign role
        $adminUser = $this->createUser($this->users[0]);
        $role = $this->createRole('Super Admin');
        $this->assignPermissionsToRole($role);
        $adminUser->assignRole($role);

        // Create other users
        foreach (array_slice($this->users, 1) as $userData) {
            $this->createUser($userData);
        }
    }

    private function createPermissions()
    {
        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }

    private function createRole(string $name): Role
    {
        return Role::firstOrCreate(['guard_name' => 'web', 'name' => $name]);
    }

    private function assignPermissionsToRole(Role $role)
    {
        $permissions = Permission::pluck('id')->toArray();
        $role->syncPermissions($permissions);
    }

    private function createUser(array $data): User
    {
        return User::create(array_merge($data, [
            "phone" => "01040983170",
            "password" => bcrypt('12345678'),
            "email_verified_at" => Carbon::now(),
            "phone_verified_at" => Carbon::now(),
            "image" => "feed-back-1.jpg",
        ]));
    }
}
