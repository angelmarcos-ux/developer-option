<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'secretary_access',
            ],
            [
                'id'    => 18,
                'title' => 'treasurer_access',
            ],
            [
                'id'    => 19,
                'title' => 'auditor_access',
            ],
            [
                'id'    => 20,
                'title' => 'bookkeeper_access',
            ],
            [
                'id'    => 21,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 22,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 23,
                'title' => 'list_of_name_create',
            ],
            [
                'id'    => 24,
                'title' => 'list_of_name_edit',
            ],
            [
                'id'    => 25,
                'title' => 'list_of_name_show',
            ],
            [
                'id'    => 26,
                'title' => 'list_of_name_delete',
            ],
            [
                'id'    => 27,
                'title' => 'list_of_name_access',
            ],
            [
                'id'    => 28,
                'title' => 'local_create',
            ],
            [
                'id'    => 29,
                'title' => 'local_edit',
            ],
            [
                'id'    => 30,
                'title' => 'local_show',
            ],
            [
                'id'    => 31,
                'title' => 'local_delete',
            ],
            [
                'id'    => 32,
                'title' => 'local_access',
            ],
            [
                'id'    => 33,
                'title' => 'report_create',
            ],
            [
                'id'    => 34,
                'title' => 'report_edit',
            ],
            [
                'id'    => 35,
                'title' => 'report_show',
            ],
            [
                'id'    => 36,
                'title' => 'report_delete',
            ],
            [
                'id'    => 37,
                'title' => 'report_access',
            ],
            [
                'id'    => 38,
                'title' => 'message_create',
            ],
            [
                'id'    => 39,
                'title' => 'message_edit',
            ],
            [
                'id'    => 40,
                'title' => 'message_show',
            ],
            [
                'id'    => 41,
                'title' => 'message_delete',
            ],
            [
                'id'    => 42,
                'title' => 'message_access',
            ],
            [
                'id'    => 43,
                'title' => 'audit_create',
            ],
            [
                'id'    => 44,
                'title' => 'audit_edit',
            ],
            [
                'id'    => 45,
                'title' => 'audit_show',
            ],
            [
                'id'    => 46,
                'title' => 'audit_delete',
            ],
            [
                'id'    => 47,
                'title' => 'audit_access',
            ],
            [
                'id'    => 48,
                'title' => 'information_report_create',
            ],
            [
                'id'    => 49,
                'title' => 'information_report_edit',
            ],
            [
                'id'    => 50,
                'title' => 'information_report_show',
            ],
            [
                'id'    => 51,
                'title' => 'information_report_delete',
            ],
            [
                'id'    => 52,
                'title' => 'information_report_access',
            ],
            [
                'id'    => 53,
                'title' => 'memo_report_create',
            ],
            [
                'id'    => 54,
                'title' => 'memo_report_edit',
            ],
            [
                'id'    => 55,
                'title' => 'memo_report_show',
            ],
            [
                'id'    => 56,
                'title' => 'memo_report_delete',
            ],
            [
                'id'    => 57,
                'title' => 'memo_report_access',
            ],
            [
                'id'    => 58,
                'title' => 'invoice_create',
            ],
            [
                'id'    => 59,
                'title' => 'invoice_edit',
            ],
            [
                'id'    => 60,
                'title' => 'invoice_show',
            ],
            [
                'id'    => 61,
                'title' => 'invoice_delete',
            ],
            [
                'id'    => 62,
                'title' => 'invoice_access',
            ],
            [
                'id'    => 63,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
