<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Institute
            'institute.view', 'institute.create', 'institute.edit', 'institute.delete', 'institute.publish', 'institute.archive',
            // Fee
            'fee.view', 'fee.create', 'fee.edit', 'fee.delete', 'fee.approve', 'fee.reject',
            // Location
            'location.view', 'location.create', 'location.edit', 'location.delete',
            // Taxonomy
            'taxonomy.view', 'taxonomy.create', 'taxonomy.edit', 'taxonomy.delete',
            // Media
            'media.view', 'media.create', 'media.edit', 'media.delete',
            // User
            'user.view', 'user.create', 'user.edit', 'user.delete',
            // Audit
            'audit.view',
            // SEO
            'seo.view', 'seo.create', 'seo.edit', 'seo.delete',
            // Scraper
            'scraper.view', 'scraper.create', 'scraper.edit', 'scraper.delete', 'scraper.run',
            // Admission
            'admission.view', 'admission.create', 'admission.edit', 'admission.delete',
            // Moderation
            'moderation.view', 'moderation.approve', 'moderation.reject',
            // System
            'system.configure', 'system.backup',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Super Admin — all permissions
        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin — all CRUD, cannot manage super_admins or delete system data
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'institute.view', 'institute.create', 'institute.edit', 'institute.delete', 'institute.publish', 'institute.archive',
            'fee.view', 'fee.create', 'fee.edit', 'fee.delete', 'fee.approve', 'fee.reject',
            'location.view', 'location.create', 'location.edit', 'location.delete',
            'taxonomy.view', 'taxonomy.create', 'taxonomy.edit', 'taxonomy.delete',
            'media.view', 'media.create', 'media.edit', 'media.delete',
            'user.view', 'user.create', 'user.edit',
            'audit.view',
            'seo.view', 'seo.create', 'seo.edit', 'seo.delete',
            'scraper.view', 'scraper.create', 'scraper.edit', 'scraper.delete', 'scraper.run',
            'admission.view', 'admission.create', 'admission.edit', 'admission.delete',
            'moderation.view', 'moderation.approve', 'moderation.reject',
            'system.backup',
        ]);

        // Editor — create/edit/publish content, manage taxonomies and media
        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo([
            'institute.view', 'institute.create', 'institute.edit', 'institute.publish',
            'fee.view', 'fee.create', 'fee.edit',
            'location.view', 'location.create', 'location.edit',
            'taxonomy.view', 'taxonomy.create', 'taxonomy.edit',
            'media.view', 'media.create', 'media.edit',
            'seo.view', 'seo.create', 'seo.edit',
            'admission.view', 'admission.create', 'admission.edit',
        ]);

        // Moderator — review and approve/reject content, view moderation queue
        $moderator = Role::create(['name' => 'moderator']);
        $moderator->givePermissionTo([
            'institute.view', 'institute.edit', 'institute.publish',
            'fee.view', 'fee.approve', 'fee.reject',
            'moderation.view', 'moderation.approve', 'moderation.reject',
            'admission.view',
        ]);

        // Data Operator — create/edit draft content, submit for review
        $dataOperator = Role::create(['name' => 'data_operator']);
        $dataOperator->givePermissionTo([
            'institute.view', 'institute.create', 'institute.edit',
            'fee.view', 'fee.create', 'fee.edit',
            'location.view',
            'taxonomy.view',
            'media.view', 'media.create',
            'admission.view', 'admission.create', 'admission.edit',
        ]);

        // Analyst — read-only access + export
        $analyst = Role::create(['name' => 'analyst']);
        $analyst->givePermissionTo([
            'institute.view',
            'fee.view',
            'location.view',
            'taxonomy.view',
            'media.view',
            'audit.view',
            'admission.view',
        ]);
    }
}
