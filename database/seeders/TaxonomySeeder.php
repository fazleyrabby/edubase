<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaxonomySeeder extends Seeder
{
    public function run(): void
    {
        // Institute Types
        $types = ['School', 'Madrasa', 'College', 'University', 'Kindergarten', 'Vocational Institute'];
        foreach ($types as $i => $type) {
            DB::table('institute_types')->insert([
                'uuid' => Str::uuid(),
                'name' => $type,
                'slug' => Str::slug($type),
                'sort_order' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Languages (ISO 639-1)
        $languages = [
            ['code' => 'bn', 'name' => 'Bengali', 'native_name' => 'বাংলা'],
            ['code' => 'en', 'name' => 'English', 'native_name' => 'English'],
            ['code' => 'ar', 'name' => 'Arabic', 'native_name' => 'العربية'],
            ['code' => 'ur', 'name' => 'Urdu', 'native_name' => 'اردو'],
        ];
        foreach ($languages as $lang) {
            DB::table('languages')->insert([
                'uuid' => Str::uuid(),
                'code' => $lang['code'],
                'name' => $lang['name'],
                'native_name' => $lang['native_name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Categories (top-level educational categories)
        $categories = [
            ['name' => 'General Education', 'slug' => 'general-education', 'icon' => 'book-open'],
            ['name' => 'Islamic Education', 'slug' => 'islamic-education', 'icon' => 'mosque'],
            ['name' => 'Technical Education', 'slug' => 'technical-education', 'icon' => 'cog'],
            ['name' => 'Madrasa Education', 'slug' => 'madrasa-education', 'icon' => 'graduation-cap'],
            ['name' => 'English Medium', 'slug' => 'english-medium', 'icon' => 'globe'],
        ];
        foreach ($categories as $i => $cat) {
            DB::table('categories')->insert([
                'uuid' => Str::uuid(),
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'icon' => $cat['icon'],
                'sort_order' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Curriculums
        $curriculums = [
            'National Curriculum (Bangladesh)', 'Cambridge International', 'Edexcel International',
            'IB Diploma Programme', 'Dawra-e-Hadith (Qawmi)', 'Alia Madrasa Curriculum',
            'Technical & Vocational', 'BTEB',
        ];
        foreach ($curriculums as $c) {
            DB::table('curriculums')->insert([
                'uuid' => Str::uuid(),
                'name' => $c,
                'slug' => Str::slug($c),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Education Boards
        $boards = [
            ['name' => 'Board of Intermediate and Secondary Education, Chattogram', 'short_name' => 'Chattogram Board'],
            ['name' => 'Board of Intermediate and Secondary Education, Dhaka', 'short_name' => 'Dhaka Board'],
            ['name' => 'Board of Intermediate and Secondary Education, Rajshahi', 'short_name' => 'Rajshahi Board'],
            ['name' => 'Board of Intermediate and Secondary Education, Cumilla', 'short_name' => 'Cumilla Board'],
            ['name' => 'Bangladesh Madrasah Education Board', 'short_name' => 'Madrasah Board'],
            ['name' => 'Bangladesh Technical Education Board', 'short_name' => 'BTEB'],
            ['name' => 'Bangladesh Open University', 'short_name' => 'BOU'],
        ];
        foreach ($boards as $b) {
            DB::table('education_boards')->insert([
                'uuid' => Str::uuid(),
                'name' => $b['name'],
                'slug' => Str::slug($b['short_name']),
                'short_name' => $b['short_name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Programs (grade levels and programs)
        $programs = [
            ['name' => 'Playgroup', 'program_type' => 'grade_level'],
            ['name' => 'Nursery', 'program_type' => 'grade_level'],
            ['name' => 'KG-I', 'program_type' => 'grade_level'],
            ['name' => 'KG-II', 'program_type' => 'grade_level'],
            ['name' => 'Class 1', 'program_type' => 'grade_level'],
            ['name' => 'Class 2', 'program_type' => 'grade_level'],
            ['name' => 'Class 3', 'program_type' => 'grade_level'],
            ['name' => 'Class 4', 'program_type' => 'grade_level'],
            ['name' => 'Class 5', 'program_type' => 'grade_level'],
            ['name' => 'Class 6', 'program_type' => 'grade_level'],
            ['name' => 'Class 7', 'program_type' => 'grade_level'],
            ['name' => 'Class 8', 'program_type' => 'grade_level'],
            ['name' => 'Class 9', 'program_type' => 'grade_level'],
            ['name' => 'Class 10 (SSC)', 'program_type' => 'grade_level'],
            ['name' => 'Class 11', 'program_type' => 'grade_level'],
            ['name' => 'Class 12 (HSC)', 'program_type' => 'grade_level'],
            ['name' => 'Ebtedayee', 'program_type' => 'grade_level'],
            ['name' => 'Mutawassitah', 'program_type' => 'grade_level'],
            ['name' => 'Dakhil', 'program_type' => 'grade_level'],
            ['name' => 'Alim', 'program_type' => 'grade_level'],
            ['name' => 'Fazil', 'program_type' => 'grade_level'],
            ['name' => 'Kamil', 'program_type' => 'grade_level'],
            ['name' => 'Hifzul Quran', 'program_type' => 'islamic_study'],
            ['name' => 'Nazera', 'program_type' => 'islamic_study'],
        ];
        foreach ($programs as $i => $p) {
            DB::table('programs')->insert([
                'uuid' => Str::uuid(),
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'program_type' => $p['program_type'],
                'sort_order' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Facility Groups
        $facilityGroups = [
            ['name' => 'Academic Facilities', 'icon' => 'book'],
            ['name' => 'Sports Facilities', 'icon' => 'running'],
            ['name' => 'Infrastructure', 'icon' => 'building'],
            ['name' => 'Transportation', 'icon' => 'bus'],
            ['name' => 'Health & Safety', 'icon' => 'heartbeat'],
        ];
        foreach ($facilityGroups as $i => $fg) {
            DB::table('facility_groups')->insert([
                'uuid' => Str::uuid(),
                'name' => $fg['name'],
                'slug' => Str::slug($fg['name']),
                'icon' => $fg['icon'],
                'sort_order' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
