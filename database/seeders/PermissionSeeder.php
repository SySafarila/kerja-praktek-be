<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];

        // system
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'admin-access',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // permissions
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'permissions-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'permissions-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'permissions-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'permissions-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        // roles
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'roles-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'roles-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'roles-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'roles-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        // users
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'users-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'users-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'users-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'users-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        // blogs
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'blogs-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'blogs-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'blogs-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'blogs-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        // staffs
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'staffs-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'staffs-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'staffs-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'staffs-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        // teachers
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'teachers-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'teachers-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'teachers-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'teachers-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        // subjects
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'subjects-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'subjects-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'subjects-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'subjects-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        // extracurriculars
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'extracurriculars-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'extracurriculars-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'extracurriculars-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'extracurriculars-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        // testimonials
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'testimonials-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'testimonials-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'testimonials-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'testimonials-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],

        );

        // galleries
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'galleries-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'galleries-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'galleries-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'galleries-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],

        );

        // articles
        array_push(
            $arr,
            [
                'guard_name' => 'web',
                'name' => 'articles-create',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'articles-read',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'articles-update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'guard_name' => 'web',
                'name' => 'articles-delete',
                'created_at' => now(),
                'updated_at' => now()
            ],

        );

        DB::table('permissions')->insert($arr);
    }
}
