<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'item_create',
            ],
            [
                'id'    => '18',
                'title' => 'item_edit',
            ],
            [
                'id'    => '19',
                'title' => 'item_show',
            ],
            [
                'id'    => '20',
                'title' => 'item_delete',
            ],
            [
                'id'    => '21',
                'title' => 'item_access',
            ],
            [
                'id'    => '22',
                'title' => 'team_create',
            ],
            [
                'id'    => '23',
                'title' => 'team_edit',
            ],
            [
                'id'    => '24',
                'title' => 'team_show',
            ],
            [
                'id'    => '25',
                'title' => 'team_delete',
            ],
            [
                'id'    => '26',
                'title' => 'team_access',
            ],
            [
                'id'    => '27',
                'title' => 'stock_create',
            ],
            [
                'id'    => '28',
                'title' => 'stock_edit',
            ],
            [
                'id'    => '29',
                'title' => 'stock_show',
            ],
            [
                'id'    => '30',
                'title' => 'stock_delete',
            ],
            [
                'id'    => '31',
                'title' => 'stock_access',
            ],
            [
                'id'    => '32',
                'title' => 'transaction_create',
            ],
            [
                'id'    => '33',
                'title' => 'transaction_edit',
            ],
            [
                'id'    => '34',
                'title' => 'transaction_show',
            ],
            [
                'id'    => '35',
                'title' => 'transaction_delete',
            ],
            [
                'id'    => '36',
                'title' => 'transaction_access',
            ],
            [
                'id'    => '37',
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => '38',
                'title' => 'vendor_access',
            ],
            [
                'id'    => '39',
                'title' => 'vendor_create',
            ],
            [
                'id'    => '40',
                'title' => 'vendor_edit',
            ],
            [
                'id'    => '41',
                'title' => 'vendor_show',
            ],
            [
                'id'    => '42',
                'title' => 'vendor_delete',
            ],
            [
                'id'    => '43',
                'title' => 'worker_access',
            ],
            [
                'id'    => '44',
                'title' => 'worker_create',
            ],
            [
                'id'    => '45',
                'title' => 'worker_edit',
            ],
            [
                'id'    => '46',
                'title' => 'worker_show',
            ],
            [
                'id'    => '47',
                'title' => 'worker_delete',
            ],
        ];

        Permission::insert($permissions);

    }
}
