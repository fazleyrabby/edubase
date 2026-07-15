<?php

namespace Database\Seeders;

use App\Modules\Fee\Models\FeeStructure;
use App\Modules\Fee\Models\FeeType;
use App\Modules\Institute\Actions\CreateInstituteAction;
use App\Modules\Institute\Actions\PublishInstituteAction;
use App\Modules\Institute\DTOs\InstituteData;
use App\Modules\Institute\Models\InstituteContact;
use App\Modules\Institute\Models\InstituteSocialLink;
use App\Modules\Location\Models\Country;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\Upazila;
use App\Modules\Taxonomy\Models\Category;
use App\Modules\Taxonomy\Models\Curriculum;
use App\Modules\Taxonomy\Models\EducationBoard;
use App\Modules\Taxonomy\Models\InstituteType;
use App\Modules\Taxonomy\Models\Language;
use App\Modules\Taxonomy\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InstituteSeeder extends Seeder
{
    public function run(): void
    {
        $action = app(CreateInstituteAction::class);
        $publishAction = app(PublishInstituteAction::class);

        $typeIds = InstituteType::pluck('id', 'slug');
        $categoryIds = Category::pluck('id');
        $curriculumIds = Curriculum::pluck('id');
        $boardIds = EducationBoard::pluck('id');
        $programIds = Program::pluck('id');
        $languageIds = Language::pluck('id');
        $countryId = Country::first()?->id ?? 1;

        $feeTypeIds = [];
        foreach ([
            ['name' => 'Monthly Tuition', 'slug' => 'monthly-tuition', 'fee_category' => 'recurring'],
            ['name' => 'Admission Fee', 'slug' => 'admission-fee', 'fee_category' => 'one_time'],
            ['name' => 'Session Fee', 'slug' => 'session-fee', 'fee_category' => 'one_time'],
            ['name' => 'Exam Fee', 'slug' => 'exam-fee', 'fee_category' => 'recurring'],
            ['name' => 'Transport Fee', 'slug' => 'transport-fee', 'fee_category' => 'recurring'],
        ] as $ft) {
            $feeTypeIds[$ft['slug']] = FeeType::create([
                'uuid' => (string) Str::uuid(),
                'name' => $ft['name'],
                'slug' => $ft['slug'],
                'fee_category' => $ft['fee_category'],
            ])->id;
        }

        $institutesData = [
            ['name' => 'Dhaka College', 'slug' => 'college', 'gender' => 'co_educational', 'religion' => 'not_applicable', 'est' => 1841, 'code' => '100001', 'district' => 'Dhaka'],
            ['name' => 'Notre Dame College, Dhaka', 'slug' => 'college', 'gender' => 'boys', 'religion' => 'christianity', 'est' => 1949, 'code' => '100002', 'district' => 'Dhaka'],
            ['name' => 'Viqarunnisa Noon School & College', 'slug' => 'school', 'gender' => 'girls', 'religion' => 'not_applicable', 'est' => 1952, 'code' => '100003', 'district' => 'Dhaka'],
            ['name' => 'St. Joseph Higher Secondary School', 'slug' => 'school', 'gender' => 'boys', 'religion' => 'christianity', 'est' => 1954, 'code' => '100004', 'district' => 'Dhaka'],
            ['name' => 'Al Jamia Al Islamia Patiya', 'slug' => 'madrasa', 'gender' => 'boys', 'religion' => 'islam', 'est' => 1940, 'code' => '200001', 'district' => 'Chattogram'],
            ['name' => 'Government Laboratory High School, Dhaka', 'slug' => 'school', 'gender' => 'co_educational', 'religion' => 'not_applicable', 'est' => 1961, 'code' => '100005', 'district' => 'Dhaka'],
            ['name' => 'Chittagong College', 'slug' => 'college', 'gender' => 'co_educational', 'religion' => 'not_applicable', 'est' => 1869, 'code' => '100006', 'district' => 'Chattogram'],
            ['name' => 'Government Azizul Haque College, Bogura', 'slug' => 'college', 'gender' => 'co_educational', 'religion' => 'not_applicable', 'est' => 1939, 'code' => '100007', 'district' => 'Bogura'],
            ['name' => 'Comilla Zilla School', 'slug' => 'school', 'gender' => 'boys', 'religion' => 'not_applicable', 'est' => 1837, 'code' => '100008', 'district' => 'Cumilla'],
            ['name' => 'Rajshahi College', 'slug' => 'college', 'gender' => 'co_educational', 'religion' => 'not_applicable', 'est' => 1873, 'code' => '100009', 'district' => 'Rajshahi'],
            ['name' => 'Jashore Zilla School', 'slug' => 'school', 'gender' => 'boys', 'religion' => 'not_applicable', 'est' => 1856, 'code' => '100010', 'district' => 'Jashore'],
            ['name' => 'Kishoreganj Govt. Boys High School', 'slug' => 'school', 'gender' => 'boys', 'religion' => 'not_applicable', 'est' => 1882, 'code' => '100011', 'district' => 'Kishoreganj'],
        ];

        $districts = District::with('division')->get()->keyBy('name');

        foreach ($institutesData as $data) {
            $district = $districts->get($data['district']);
            if (! $district) {
                continue;
            }

            $division = $district->division;
            $upazila = Upazila::where('district_id', $district->id)->inRandomOrder()->first() ?? Upazila::inRandomOrder()->first();
            $typeId = $typeIds[$data['slug']] ?? null;
            if (! $typeId) {
                continue;
            }

            $institute = $action->execute(new InstituteData(
                name: $data['name'],
                shortName: null,
                slug: Str::slug($data['name']),
                instituteTypeId: $typeId,
                countryId: $countryId,
                divisionId: $division->id,
                districtId: $district->id,
                upazilaId: $upazila?->id,
                areaId: null,
                establishedYear: $data['est'],
                description: "{$data['name']} is a renowned educational institution in Bangladesh, established in {$data['est']}.",
                instituteCode: $data['code'],
                primaryCategoryId: $categoryIds->random(),
                religiousOrientation: $data['religion'],
                methodology: null,
                gender: $data['gender'],
                fullAddress: null,
                postalCode: null,
                latitude: null,
                longitude: null,
                googleMapsUrl: null,
                nearbyLandmark: null,
                status: 'draft',
                categoryIds: $categoryIds->random(rand(1, 2))->toArray(),
                curriculumIds: $curriculumIds->random(rand(1, 3))->toArray(),
                boardIds: $boardIds->random(rand(1, 2))->toArray(),
                programIds: $programIds->random(rand(3, 6))->toArray(),
                facilityIds: [],
                languageIds: $languageIds->random(rand(1, 2))->toArray(),
            ));

            InstituteContact::create([
                'uuid' => (string) Str::uuid(),
                'institute_id' => $institute->id,
                'contact_type' => 'phone',
                'contact_value' => '01'.(string) rand(700000000, 999999999),
                'is_public' => true,
                'sort_order' => 1,
            ]);

            InstituteContact::create([
                'uuid' => (string) Str::uuid(),
                'institute_id' => $institute->id,
                'contact_type' => 'email',
                'contact_value' => 'info@'.Str::slug($data['name']).'.edu.bd',
                'is_public' => true,
                'sort_order' => 2,
            ]);

            InstituteSocialLink::create([
                'uuid' => (string) Str::uuid(),
                'institute_id' => $institute->id,
                'platform' => 'website',
                'url' => 'https://www.'.Str::slug($data['name']).'.edu.bd',
                'is_public' => true,
                'sort_order' => 1,
            ]);

            FeeStructure::create([
                'uuid' => (string) Str::uuid(),
                'institute_id' => $institute->id,
                'fee_type_id' => $feeTypeIds['monthly-tuition'] ?? 1,
                'academic_session' => '2026',
                'amount' => rand(500, 5000),
                'currency' => 'BDT',
                'frequency' => 'monthly',
                'moderation_status' => 'approved',
                'is_published' => true,
                'published_at' => now(),
            ]);

            FeeStructure::create([
                'uuid' => (string) Str::uuid(),
                'institute_id' => $institute->id,
                'fee_type_id' => $feeTypeIds['admission-fee'] ?? 2,
                'academic_session' => '2026',
                'amount' => rand(5000, 30000),
                'currency' => 'BDT',
                'frequency' => 'one_time',
                'moderation_status' => 'approved',
                'is_published' => true,
                'published_at' => now(),
            ]);

            $publishAction->execute($institute);
        }
    }
}
