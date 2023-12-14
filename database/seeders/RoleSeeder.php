<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create(['name' => 'super admin']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        $superAdmin->syncPermissions(['admin-access']);
        $admin->syncPermissions([
            "admin-access",
            "news-create",
            "news-read",
            "news-update",
            "news-delete",
            "staffs-create",
            "staffs-read",
            "staffs-update",
            "staffs-delete",
            "teachers-create",
            "teachers-read",
            "teachers-update",
            "teachers-delete",
            "subjects-create",
            "subjects-read",
            "subjects-update",
            "subjects-delete",
            "extracurriculars-create",
            "extracurriculars-read",
            "extracurriculars-update",
            "extracurriculars-delete",
            "testimonials-create",
            "testimonials-read",
            "testimonials-update",
            "testimonials-delete",
            "galleries-create",
            "galleries-read",
            "galleries-update",
            "galleries-delete",
            "articles-create",
            "articles-read",
            "articles-update",
            "articles-delete",
            "ppdb-create",
            "ppdb-read",
            "ppdb-update",
            "ppdb-delete",
            "ppdb-settings-create",
            "ppdb-settings-read",
            "ppdb-settings-update",
            "ppdb-settings-delete"
        ]);
    }
}
