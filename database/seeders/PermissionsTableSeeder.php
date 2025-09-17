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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'quick_service_request_create',
            ],
            [
                'id'    => 20,
                'title' => 'quick_service_request_edit',
            ],
            [
                'id'    => 21,
                'title' => 'quick_service_request_show',
            ],
            [
                'id'    => 22,
                'title' => 'quick_service_request_delete',
            ],
            [
                'id'    => 23,
                'title' => 'quick_service_request_access',
            ],
            [
                'id'    => 24,
                'title' => 'highlight_create',
            ],
            [
                'id'    => 25,
                'title' => 'highlight_edit',
            ],
            [
                'id'    => 26,
                'title' => 'highlight_show',
            ],
            [
                'id'    => 27,
                'title' => 'highlight_delete',
            ],
            [
                'id'    => 28,
                'title' => 'highlight_access',
            ],
            [
                'id'    => 29,
                'title' => 'core_service_create',
            ],
            [
                'id'    => 30,
                'title' => 'core_service_edit',
            ],
            [
                'id'    => 31,
                'title' => 'core_service_show',
            ],
            [
                'id'    => 32,
                'title' => 'core_service_delete',
            ],
            [
                'id'    => 33,
                'title' => 'core_service_access',
            ],
            [
                'id'    => 34,
                'title' => 'catalogue_access',
            ],
            [
                'id'    => 35,
                'title' => 'catalogue_category_create',
            ],
            [
                'id'    => 36,
                'title' => 'catalogue_category_edit',
            ],
            [
                'id'    => 37,
                'title' => 'catalogue_category_show',
            ],
            [
                'id'    => 38,
                'title' => 'catalogue_category_delete',
            ],
            [
                'id'    => 39,
                'title' => 'catalogue_category_access',
            ],
            [
                'id'    => 40,
                'title' => 'catalogu_data_create',
            ],
            [
                'id'    => 41,
                'title' => 'catalogu_data_edit',
            ],
            [
                'id'    => 42,
                'title' => 'catalogu_data_show',
            ],
            [
                'id'    => 43,
                'title' => 'catalogu_data_delete',
            ],
            [
                'id'    => 44,
                'title' => 'catalogu_data_access',
            ],
            [
                'id'    => 45,
                'title' => 'legal_access',
            ],
            [
                'id'    => 46,
                'title' => 'privacy_policy_create',
            ],
            [
                'id'    => 47,
                'title' => 'privacy_policy_edit',
            ],
            [
                'id'    => 48,
                'title' => 'privacy_policy_show',
            ],
            [
                'id'    => 49,
                'title' => 'privacy_policy_delete',
            ],
            [
                'id'    => 50,
                'title' => 'privacy_policy_access',
            ],
            [
                'id'    => 51,
                'title' => 'terms_condition_create',
            ],
            [
                'id'    => 52,
                'title' => 'terms_condition_edit',
            ],
            [
                'id'    => 53,
                'title' => 'terms_condition_show',
            ],
            [
                'id'    => 54,
                'title' => 'terms_condition_delete',
            ],
            [
                'id'    => 55,
                'title' => 'terms_condition_access',
            ],
            [
                'id'    => 56,
                'title' => 'setting_access',
            ],
            [
                'id'    => 57,
                'title' => 'location_create',
            ],
            [
                'id'    => 58,
                'title' => 'location_edit',
            ],
            [
                'id'    => 59,
                'title' => 'location_show',
            ],
            [
                'id'    => 60,
                'title' => 'location_delete',
            ],
            [
                'id'    => 61,
                'title' => 'location_access',
            ],
            [
                'id'    => 62,
                'title' => 'company_detail_create',
            ],
            [
                'id'    => 63,
                'title' => 'company_detail_edit',
            ],
            [
                'id'    => 64,
                'title' => 'company_detail_show',
            ],
            [
                'id'    => 65,
                'title' => 'company_detail_delete',
            ],
            [
                'id'    => 66,
                'title' => 'company_detail_access',
            ],
            [
                'id'    => 67,
                'title' => 'contact_us_message_create',
            ],
            [
                'id'    => 68,
                'title' => 'contact_us_message_edit',
            ],
            [
                'id'    => 69,
                'title' => 'contact_us_message_show',
            ],
            [
                'id'    => 70,
                'title' => 'contact_us_message_delete',
            ],
            [
                'id'    => 71,
                'title' => 'contact_us_message_access',
            ],
            [
                'id'    => 72,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
