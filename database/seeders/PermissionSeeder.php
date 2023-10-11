<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'View Admin',
            'View Sliders',
            'Create Slider',
            'Update Slider',
            'Delete Slider',
            'View Roles',
            'Create Role',
            'Update Role',
            'Delete Role',
            'View Permissions',
            'Create Permission',
            'Update Permission',
            'Delete Permission',
            'View Users',
            'Update User',
            'Delete User',
            'View PortfolioCategories',
            'Create PortfolioCategory',
            'Update PortfolioCategory',
            'Delete PortfolioCategory',
            'View Portfolios',
            'Create Portfolio',
            'Update Portfolio',
            'Delete Portfolio',
            'View ArticleCategories',
            'Create ArticleCategory',
            'Update ArticleCategory',
            'Delete ArticleCategory',
            'View Articles',
            'Create Article',
            'Update Article',
            'Delete Article',
            // '',
            // '',
            // '',
            // '',
            // '',
        ];

        foreach($permissions as $permissionName) {
            $permission = Permission::create(['name' => $permissionName]);
            $permission->assignRole('admin');
        }
    }
}
