<?php

namespace Database\Seeders;

use App\Modules\Fee\Models\FeeStructure;
use App\Modules\Fee\Models\FeeType;
use App\Modules\Institute\Actions\CreateInstituteAction;
use App\Modules\Institute\Actions\PublishInstituteAction;
use App\Modules\Institute\DTOs\InstituteData;
use App\Modules\Institute\Models\Institute;
use App\Modules\Institute\Models\InstituteContact;
use App\Modules\Institute\Models\InstituteSocialLink;
use App\Modules\Location\Models\Country;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\Upazila;
use App\Modules\Taxonomy\Models\Category;
use App\Modules\Taxonomy\Models\Curriculum;
use App\Modules\Taxonomy\Models\EducationBoard;
use App\Modules\Taxonomy\Models\Facility;
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
        $categoryIds = Category::pluck('id', 'slug');
        $curriculumIds = Curriculum::pluck('id', 'slug');
        $boardIds = EducationBoard::pluck('id', 'slug');
        $programIds = Program::pluck('id', 'slug');
        $languageIds = Language::pluck('id', 'code');
        $facilityIds = Facility::pluck('id', 'slug');
        $countryId = Country::first()?->id ?? 1;

        // Ensure Fee Types exist and map them
        $feeTypeIds = [];
        $feeTypes = [
            ['name' => 'Monthly Tuition', 'slug' => 'monthly-tuition', 'fee_category' => 'recurring'],
            ['name' => 'Admission Fee', 'slug' => 'admission-fee', 'fee_category' => 'one_time'],
            ['name' => 'Session Fee', 'slug' => 'session-fee', 'fee_category' => 'one_time'],
            ['name' => 'Exam Fee', 'slug' => 'exam-fee', 'fee_category' => 'recurring'],
            ['name' => 'Transport Fee', 'slug' => 'transport-fee', 'fee_category' => 'recurring'],
        ];
        foreach ($feeTypes as $ft) {
            $feeTypeIds[$ft['slug']] = FeeType::updateOrCreate(
                ['slug' => $ft['slug']],
                [
                    'uuid' => (string) Str::uuid(),
                    'name' => $ft['name'],
                    'fee_category' => $ft['fee_category'],
                ]
            )->id;
        }

        // Landmark institutes with correct upazila assignments
        $landmarkInstitutes = [
            [
                'name' => 'Dhaka College',
                'slug' => 'dhaka-college',
                'type' => 'college',
                'gender' => 'boys',
                'religion' => 'not_applicable',
                'est' => 1841,
                'code' => '100001',
                'district' => 'Dhaka',
                'upazila' => 'Nawabganj',
                'category' => 'government',
                'curriculum' => 'national-curriculum-bangladesh',
                'board' => 'dhaka-board',
            ],
            [
                'name' => 'Notre Dame College, Dhaka',
                'slug' => 'notre-dame-college-dhaka',
                'type' => 'college',
                'gender' => 'boys',
                'religion' => 'christianity',
                'est' => 1949,
                'code' => '100002',
                'district' => 'Dhaka',
                'upazila' => 'Keraniganj',
                'category' => 'bangla-medium',
                'curriculum' => 'national-curriculum-bangladesh',
                'board' => 'dhaka-board',
            ],
            [
                'name' => 'Viqarunnisa Noon School & College',
                'slug' => 'viqarunnisa-noon-school-college',
                'type' => 'school',
                'gender' => 'girls',
                'religion' => 'not_applicable',
                'est' => 1952,
                'code' => '100003',
                'district' => 'Dhaka',
                'upazila' => 'Dhamrai',
                'category' => 'bangla-medium',
                'curriculum' => 'national-curriculum-bangladesh',
                'board' => 'dhaka-board',
            ],
            [
                'name' => 'St. Joseph Higher Secondary School',
                'slug' => 'st-joseph-higher-secondary-school',
                'type' => 'school',
                'gender' => 'boys',
                'religion' => 'christianity',
                'est' => 1954,
                'code' => '100004',
                'district' => 'Dhaka',
                'upazila' => 'Savar',
                'category' => 'bangla-medium',
                'curriculum' => 'national-curriculum-bangladesh',
                'board' => 'dhaka-board',
            ],
            [
                'name' => 'Government Laboratory High School, Dhaka',
                'slug' => 'government-laboratory-high-school-dhaka',
                'type' => 'school',
                'gender' => 'boys',
                'religion' => 'not_applicable',
                'est' => 1961,
                'code' => '100005',
                'district' => 'Dhaka',
                'upazila' => 'Dhamrai',
                'category' => 'government',
                'curriculum' => 'national-curriculum-bangladesh',
                'board' => 'dhaka-board',
            ],
            [
                'name' => 'Government Azizul Haque College, Bogura',
                'slug' => 'government-azizul-haque-college-bogura',
                'type' => 'college',
                'gender' => 'co_educational',
                'religion' => 'not_applicable',
                'est' => 1939,
                'code' => '100007',
                'district' => 'Bogura',
                'upazila' => 'Bogra Sadar',
                'category' => 'government',
                'curriculum' => 'national-curriculum-bangladesh',
                'board' => 'rajshahi-board',
            ],
            [
                'name' => 'Comilla Zilla School',
                'slug' => 'comilla-zilla-school',
                'type' => 'school',
                'gender' => 'boys',
                'religion' => 'not_applicable',
                'est' => 1837,
                'code' => '100008',
                'district' => 'Cumilla',
                'upazila' => null,
                'category' => 'government',
                'curriculum' => 'national-curriculum-bangladesh',
                'board' => 'cumilla-board',
            ],
            [
                'name' => 'Rajshahi College',
                'slug' => 'rajshahi-college',
                'type' => 'college',
                'gender' => 'co_educational',
                'religion' => 'not_applicable',
                'est' => 1873,
                'code' => '100009',
                'district' => 'Rajshahi',
                'upazila' => 'Paba',
                'category' => 'government',
                'curriculum' => 'national-curriculum-bangladesh',
                'board' => 'rajshahi-board',
            ],
            [
                'name' => 'Jashore Zilla School',
                'slug' => 'jashore-zilla-school',
                'type' => 'school',
                'gender' => 'boys',
                'religion' => 'not_applicable',
                'est' => 1856,
                'code' => '100010',
                'district' => 'Jashore',
                'upazila' => 'Jessore Sadar',
                'category' => 'government',
                'curriculum' => 'national-curriculum-bangladesh',
                'board' => 'jashore-board',
            ],
            [
                'name' => 'Kishoreganj Govt. Boys High School',
                'slug' => 'kishoreganj-govt-boys-high-school',
                'type' => 'school',
                'gender' => 'boys',
                'religion' => 'not_applicable',
                'est' => 1882,
                'code' => '100011',
                'district' => 'Kishoreganj',
                'upazila' => null,
                'category' => 'government',
                'curriculum' => 'national-curriculum-bangladesh',
                'board' => 'dhaka-board',
            ],
        ];

        $districts = District::with('division')->get()->keyBy('name');

        // Seed Landmark Institutes
        foreach ($landmarkInstitutes as $data) {
            $districtName = $data['district'] === 'Jashore' ? 'Jashore' : ($data['district'] === 'Cumilla' ? 'Cumilla' : $data['district']);
            $district = $districts->get($districtName);
            if (!$district) {
                continue;
            }

            $division = $district->division;

            // Look up upazila by name if specified, otherwise null
            $upazila = null;
            if (isset($data['upazila']) && $data['upazila'] !== null) {
                $upazila = Upazila::where('district_id', $district->id)
                    ->where('name', $data['upazila'])
                    ->first();
            }

            $typeId = $typeIds[$data['type']] ?? $typeIds['school'];
            $primaryCategorySlug = $data['category'];
            $primaryCategoryId = $categoryIds[$primaryCategorySlug] ?? $categoryIds['bangla-medium'];

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
                primaryCategoryId: $primaryCategoryId,
                religiousOrientation: $data['religion'],
                methodology: null,
                gender: $data['gender'],
                fullAddress: "{$districtName}, Bangladesh",
                postalCode: null,
                latitude: null,
                longitude: null,
                googleMapsUrl: null,
                nearbyLandmark: null,
                status: 'draft',
                categoryIds: [$primaryCategoryId],
                curriculumIds: isset($curriculumIds[$data['curriculum']]) ? [$curriculumIds[$data['curriculum']]] : [],
                boardIds: isset($boardIds[$data['board']]) ? [$boardIds[$data['board']]] : [],
                programIds: $programIds->random(min(4, $programIds->count()))->toArray(),
                facilityIds: $facilityIds->random(min(4, $facilityIds->count()))->toArray(),
                languageIds: [$languageIds['en'] ?? 1, $languageIds['bn'] ?? 2],
            ));

            $this->seedContactsAndFees($institute, $feeTypeIds);
            $publishAction->execute($institute);
        }

        // Seed Curated Chattogram JSON Institutes
        $this->seedFromJsonFile(
            database_path('data/institutes_chattogram.json'),
            $districts,
            $action,
            $publishAction,
            $typeIds,
            $categoryIds,
            $curriculumIds,
            $boardIds,
            $programIds,
            $facilityIds,
            $languageIds,
            $feeTypeIds,
            $countryId
        );

        // Seed Curated Nationwide JSON Institutes
        $this->seedFromJsonFile(
            database_path('data/institutes_nationwide.json'),
            $districts,
            $action,
            $publishAction,
            $typeIds,
            $categoryIds,
            $curriculumIds,
            $boardIds,
            $programIds,
            $facilityIds,
            $languageIds,
            $feeTypeIds,
            $countryId
        );

        // Bulk import from open-source school name lists
        $this->seedFromSchoolNameLists(
            $districts,
            $action,
            $publishAction,
            $typeIds,
            $categoryIds,
            $curriculumIds,
            $boardIds,
            $programIds,
            $facilityIds,
            $languageIds,
            $feeTypeIds,
            $countryId
        );
    }

    /**
     * Seed institutes from a JSON data file.
     * Each record must have a 'district' field. The 'upazila' field is optional (can be null).
     */
    private function seedFromJsonFile(
        string $filePath,
        $districts,
        CreateInstituteAction $action,
        PublishInstituteAction $publishAction,
        $typeIds,
        $categoryIds,
        $curriculumIds,
        $boardIds,
        $programIds,
        $facilityIds,
        $languageIds,
        array $feeTypeIds,
        int $countryId
    ): void {
        if (!file_exists($filePath)) {
            return;
        }

        $institutes = json_decode(file_get_contents($filePath), true);
        if (!is_array($institutes)) {
            return;
        }

        foreach ($institutes as $data) {
            $districtName = $data['district'] ?? null;
            if (!$districtName) {
                continue;
            }

            $district = $districts->get($districtName);
            if (!$district) {
                continue;
            }

            $division = $district->division;

            // Look up upazila by exact name — no fallback to avoid wrong assignments
            $upazila = null;
            $upazilaName = $data['upazila'] ?? null;
            if ($upazilaName) {
                $upazila = Upazila::where('district_id', $district->id)
                    ->where('name', $upazilaName)
                    ->first();
            }

            $typeId = $typeIds[$data['type']] ?? $typeIds['school'];
            $primaryCategoryId = $categoryIds[$data['category']] ?? $categoryIds['bangla-medium'];

            $cIds = [];
            if (isset($data['curriculum']) && isset($curriculumIds[$data['curriculum']])) {
                $cIds[] = $curriculumIds[$data['curriculum']];
            }

            $bIds = [];
            if (isset($data['board']) && isset($boardIds[$data['board']])) {
                $bIds[] = $boardIds[$data['board']];
            }

            $pIds = [];
            foreach ($data['programs'] ?? [] as $pSlug) {
                if (isset($programIds[$pSlug])) {
                    $pIds[] = $programIds[$pSlug];
                }
            }

            $fIds = [];
            foreach ($data['facilities'] ?? [] as $fSlug) {
                if (isset($facilityIds[$fSlug])) {
                    $fIds[] = $facilityIds[$fSlug];
                }
            }

            $slug = Str::slug($data['name']);
            if (Institute::where('slug', $slug)->exists()) {
                continue;
            }

            $institute = $action->execute(new InstituteData(
                name: $data['name'],
                shortName: $data['short_name'] ?? null,
                slug: $slug,
                instituteTypeId: $typeId,
                countryId: $countryId,
                divisionId: $division->id,
                districtId: $district->id,
                upazilaId: $upazila?->id,
                areaId: null,
                establishedYear: $data['established_year'] ?? null,
                description: "{$data['name']} is a prominent institution located in {$data['full_address']}.",
                instituteCode: $data['institute_code'],
                primaryCategoryId: $primaryCategoryId,
                religiousOrientation: $data['religious_orientation'] ?? 'not_applicable',
                methodology: null,
                gender: $data['gender'],
                fullAddress: $data['full_address'],
                postalCode: null,
                latitude: $data['latitude'] ?? null,
                longitude: $data['longitude'] ?? null,
                googleMapsUrl: null,
                nearbyLandmark: null,
                status: 'draft',
                categoryIds: [$primaryCategoryId],
                curriculumIds: $cIds,
                boardIds: $bIds,
                programIds: $pIds,
                facilityIds: $fIds,
                languageIds: [$languageIds['en'] ?? 1, $languageIds['bn'] ?? 2],
            ));

            // Contacts
            foreach ($data['contacts'] ?? [] as $i => $contact) {
                InstituteContact::create([
                    'uuid' => (string) Str::uuid(),
                    'institute_id' => $institute->id,
                    'contact_type' => $contact['type'],
                    'contact_value' => $contact['value'],
                    'is_public' => true,
                    'sort_order' => $i + 1,
                ]);
            }

            // Social website
            $sourceUrl = $data['source_url'] ?? null;
            if ($sourceUrl) {
                InstituteSocialLink::create([
                    'uuid' => (string) Str::uuid(),
                    'institute_id' => $institute->id,
                    'platform' => 'website',
                    'url' => $sourceUrl,
                    'is_public' => true,
                    'sort_order' => 1,
                ]);

                \App\Modules\Scraper\Models\ScraperSource::create([
                    'uuid' => (string) Str::uuid(),
                    'institute_id' => $institute->id,
                    'name' => $institute->name . ' Website Scraper',
                    'source_type' => 'website',
                    'adapter_class' => \App\Modules\Scraper\Services\InstitutionWebsiteAdapter::class,
                    'base_url' => $sourceUrl,
                    'config' => [],
                    'trust_level' => 'trusted',
                    'schedule_frequency' => 'monthly',
                    'is_active' => true,
                ]);
            }

            // Custom Fees mapping
            foreach ($data['fees'] ?? [] as $feeTypeSlug => $feeDetail) {
                $feeTypeId = $feeTypeIds[$feeTypeSlug] ?? null;
                if ($feeTypeId) {
                    FeeStructure::create([
                        'uuid' => (string) Str::uuid(),
                        'institute_id' => $institute->id,
                        'fee_type_id' => $feeTypeId,
                        'academic_session' => '2026',
                        'amount' => $feeDetail['amount'],
                        'currency' => 'BDT',
                        'frequency' => $feeDetail['frequency'] ?? 'monthly',
                        'moderation_status' => 'approved',
                        'is_published' => true,
                        'published_at' => now(),
                    ]);
                }
            }

            $publishAction->execute($institute);
        }
    }

    private function seedContactsAndFees(Institute $institute, array $feeTypeIds): void
    {
        InstituteContact::create([
            'uuid' => (string) Str::uuid(),
            'institute_id' => $institute->id,
            'contact_type' => 'phone',
            'contact_value' => '01' . (string) rand(700000000, 999999999),
            'is_public' => true,
            'sort_order' => 1,
        ]);

        InstituteContact::create([
            'uuid' => (string) Str::uuid(),
            'institute_id' => $institute->id,
            'contact_type' => 'email',
            'contact_value' => 'info@' . Str::slug($institute->name) . '.edu.bd',
            'is_public' => true,
            'sort_order' => 2,
        ]);

        InstituteSocialLink::create([
            'uuid' => (string) Str::uuid(),
            'institute_id' => $institute->id,
            'platform' => 'website',
            'url' => 'https://www.' . Str::slug($institute->name) . '.edu.bd',
            'is_public' => true,
            'sort_order' => 1,
        ]);

        FeeStructure::create([
            'uuid' => (string) Str::uuid(),
            'institute_id' => $institute->id,
            'fee_type_id' => $feeTypeIds['monthly-tuition'] ?? 1,
            'academic_session' => '2026',
            'amount' => rand(500, 3000),
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
            'amount' => rand(2000, 15000),
            'currency' => 'BDT',
            'frequency' => 'one_time',
            'moderation_status' => 'approved',
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    /**
     * Bulk import schools from name-list JSON files.
     * Matches each school name against district and upazila names to determine location.
     */
    private function seedFromSchoolNameLists(
        $districts,
        CreateInstituteAction $action,
        PublishInstituteAction $publishAction,
        $typeIds,
        $categoryIds,
        $curriculumIds,
        $boardIds,
        $programIds,
        $facilityIds,
        $languageIds,
        array $feeTypeIds,
        int $countryId
    ): void {
        // Build keyword-to-district mapping for matching school names
        // Map district names + common alternative spellings to district models
        $districtKeywords = [];
        foreach ($districts as $name => $district) {
            $districtKeywords[strtoupper($name)] = $district;
        }
        // Add common alternative spellings
        $altNames = [
            'CHITTAGONG' => 'Chattogram', 'CTG' => 'Chattogram', 'CHOTTOGRAM' => 'Chattogram',
            'COMILLA' => 'Cumilla', 'JESSORE' => 'Jashore', 'BARISAL' => 'Barishal',
            'BOGRA' => 'Bogura', 'B.BARIA' => 'Brahmanbaria', 'BRAHMANBARIA' => 'Brahmanbaria',
            'MOULVIBAZAR' => 'Maulvibazar', 'COXS BAZAR' => "Cox's Bazar", "COX'S BAZAR" => "Cox's Bazar",
            'SIRAJGANJ' => 'Sirajgonj', 'SUNAMGONJ' => 'Sunamganj',
        ];
        foreach ($altNames as $alt => $real) {
            if ($districts->has($real)) {
                $districtKeywords[$alt] = $districts->get($real);
            }
        }

        // Build upazila lookup indexed by district_id
        $allUpazilas = Upazila::all()->groupBy('district_id');

        // Board mapping by division
        $divisionBoardMap = [
            'Dhaka' => 'dhaka-board',
            'Chattogram' => 'chattogram-board',
            'Rajshahi' => 'rajshahi-board',
            'Khulna' => 'jashore-board',
            'Barishal' => 'barishal-board',
            'Sylhet' => 'sylhet-board',
            'Rangpur' => 'dinajpur-board',
            'Mymensingh' => 'mymensingh-board',
        ];

        $filesToIngest = [
            'bangla-medium' => database_path('data/banglaMediumSchools.json'),
            'english-medium' => database_path('data/englishMediumSchools.json'),
        ];

        $codeCounter = 200000;

        foreach ($filesToIngest as $catSlug => $filePath) {
            if (!file_exists($filePath)) {
                continue;
            }

            $schoolNames = json_decode(file_get_contents($filePath), true);
            if (!is_array($schoolNames)) {
                continue;
            }

            foreach ($schoolNames as $schoolName) {
                $upperName = strtoupper($schoolName);
                $name = Str::title(trim($schoolName));
                $slug = Str::slug($name);

                // Skip duplicates
                if (Institute::where('slug', $slug)->exists()) {
                    continue;
                }

                // Try to match district from school name
                $matchedDistrict = null;
                $matchedKeyword = null;
                foreach ($districtKeywords as $keyword => $district) {
                    if (str_contains($upperName, $keyword) && strlen($keyword) >= 4) {
                        $matchedDistrict = $district;
                        $matchedKeyword = $keyword;
                        break;
                    }
                }

                // If no district match, try upazila-level keywords
                if (!$matchedDistrict) {
                    foreach ($allUpazilas as $districtId => $upazilaGroup) {
                        foreach ($upazilaGroup as $upz) {
                            $upzUpper = strtoupper($upz->name);
                            if (strlen($upzUpper) >= 5 && str_contains($upperName, $upzUpper)) {
                                $matchedDistrict = $districts->first(fn($d) => $d->id === $districtId);
                                break 2;
                            }
                        }
                    }
                }

                // If still no match, skip this school — we don't assign random locations
                if (!$matchedDistrict) {
                    continue;
                }

                $division = $matchedDistrict->division;

                // Try to match upazila from name
                $matchedUpazila = null;
                $districtUpazilas = $allUpazilas->get($matchedDistrict->id, collect());
                foreach ($districtUpazilas as $upz) {
                    if (str_contains(strtolower($name), strtolower($upz->name))) {
                        $matchedUpazila = $upz;
                        break;
                    }
                }

                $typeId = $typeIds['school'];
                $primaryCategoryId = $categoryIds[$catSlug] ?? $categoryIds['bangla-medium'];
                $boardSlug = $divisionBoardMap[$division->name] ?? 'dhaka-board';

                $institute = $action->execute(new InstituteData(
                    name: $name,
                    shortName: null,
                    slug: $slug,
                    instituteTypeId: $typeId,
                    countryId: $countryId,
                    divisionId: $division->id,
                    districtId: $matchedDistrict->id,
                    upazilaId: $matchedUpazila?->id,
                    areaId: null,
                    establishedYear: rand(1960, 2015),
                    description: "{$name} is a reputed school in {$matchedDistrict->name}, offering quality education.",
                    instituteCode: (string) $codeCounter++,
                    primaryCategoryId: $primaryCategoryId,
                    religiousOrientation: 'not_applicable',
                    methodology: null,
                    gender: 'co_educational',
                    fullAddress: ($matchedUpazila ? $matchedUpazila->name . ', ' : '') . "{$matchedDistrict->name}, Bangladesh",
                    postalCode: null,
                    latitude: null,
                    longitude: null,
                    googleMapsUrl: null,
                    nearbyLandmark: null,
                    status: 'draft',
                    categoryIds: [$primaryCategoryId],
                    curriculumIds: $catSlug === 'english-medium'
                        ? [($curriculumIds['cambridge-international'] ?? $curriculumIds['national-curriculum-bangladesh'] ?? 1)]
                        : [($curriculumIds['national-curriculum-bangladesh'] ?? 1)],
                    boardIds: isset($boardIds[$boardSlug]) ? [$boardIds[$boardSlug]] : [],
                    programIds: $catSlug === 'english-medium'
                        ? array_filter([
                            $programIds['playgroup'] ?? null,
                            $programIds['nursery'] ?? null,
                            $programIds['class-1'] ?? null,
                            $programIds['class-5'] ?? null,
                            $programIds['class-9'] ?? null,
                            $programIds['class-10-ssc'] ?? null,
                        ])
                        : array_filter([
                            $programIds['class-6'] ?? null,
                            $programIds['class-7'] ?? null,
                            $programIds['class-8'] ?? null,
                            $programIds['class-9'] ?? null,
                            $programIds['class-10-ssc'] ?? null,
                        ]),
                    facilityIds: array_filter([
                        $facilityIds['library'] ?? null,
                        $facilityIds['computer-lab'] ?? null,
                        $facilityIds['science-lab'] ?? null,
                        $facilityIds['playground'] ?? null,
                    ]),
                    languageIds: [$languageIds['en'] ?? 1, $languageIds['bn'] ?? 2],
                ));

                $this->seedContactsAndFees($institute, $feeTypeIds);
                $publishAction->execute($institute);
            }
        }
    }
}

