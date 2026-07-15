<?php

namespace Database\Seeders;

use App\Modules\Location\Models\Country;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $country = Country::create([
            'uuid' => Str::uuid(),
            'name' => 'Bangladesh',
            'slug' => 'bangladesh',
            'code' => 'BD',
            'currency_code' => 'BDT',
            'phone_code' => '+880',
        ]);

        $divisions = [
            ['name' => 'Barisal', 'bn_name' => 'বরিশাল', 'latitude' => 22.7010, 'longitude' => 90.3535],
            ['name' => 'Chattogram', 'bn_name' => 'চট্টগ্রাম', 'latitude' => 22.3569, 'longitude' => 91.7832],
            ['name' => 'Dhaka', 'bn_name' => 'ঢাকা', 'latitude' => 23.8103, 'longitude' => 90.4125],
            ['name' => 'Khulna', 'bn_name' => 'খুলনা', 'latitude' => 22.8456, 'longitude' => 89.5403],
            ['name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ', 'latitude' => 24.7471, 'longitude' => 90.4203],
            ['name' => 'Rajshahi', 'bn_name' => 'রাজশাহী', 'latitude' => 24.3745, 'longitude' => 88.6042],
            ['name' => 'Rangpur', 'bn_name' => 'রংপুর', 'latitude' => 25.7439, 'longitude' => 89.2752],
            ['name' => 'Sylhet', 'bn_name' => 'সিলেট', 'latitude' => 24.8949, 'longitude' => 91.8687],
        ];

        foreach ($divisions as $data) {
            Country::first()->divisions()->create([
                'uuid' => Str::uuid(),
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'bn_name' => $data['bn_name'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
            ]);
        }

        $districtData = [
            'Barisal' => ['Barguna', 'Barisal', 'Bhola', 'Jhalokati', 'Patuakhali', 'Pirojpur'],
            'Chattogram' => ['Bandarban', 'Brahmanbaria', 'Chandpur', 'Chattogram', 'Cumilla', 'Cox\'s Bazar', 'Feni', 'Khagrachari', 'Lakshmipur', 'Noakhali', 'Rangamati'],
            'Dhaka' => ['Dhaka', 'Faridpur', 'Gazipur', 'Gopalganj', 'Kishoreganj', 'Madaripur', 'Manikganj', 'Munshiganj', 'Narayanganj', 'Narsingdi', 'Rajbari', 'Shariatpur', 'Tangail'],
            'Khulna' => ['Bagerhat', 'Chuadanga', 'Jashore', 'Jhenaidah', 'Khulna', 'Kushtia', 'Magura', 'Meherpur', 'Narail', 'Satkhira'],
            'Mymensingh' => ['Jamalpur', 'Mymensingh', 'Netrokona', 'Sherpur'],
            'Rajshahi' => ['Bogura', 'Chapainawabganj', 'Joypurhat', 'Naogaon', 'Natore', 'Pabna', 'Rajshahi', 'Sirajganj'],
            'Rangpur' => ['Dinajpur', 'Gaibandha', 'Kurigram', 'Lalmonirhat', 'Nilphamari', 'Panchagarh', 'Rangpur', 'Thakurgaon'],
            'Sylhet' => ['Habiganj', 'Moulvibazar', 'Sunamganj', 'Sylhet'],
        ];

        foreach ($districtData as $divisionName => $districts) {
            $division = Division::where('name', $divisionName)->first();
            foreach ($districts as $districtName) {
                $division->districts()->create([
                    'uuid' => Str::uuid(),
                    'name' => $districtName,
                    'slug' => Str::slug($districtName),
                    'bn_name' => null,
                ]);
            }
        }

        $upazilaData = [
            'Chattogram' => [
                'Akbarshah', 'Anwara', 'Bakalia', 'Bandar', 'Bayezid', 'Bhatiary', 'Chandgaon',
                'Chattogram Sadar', 'Double Mooring', 'EPZ', 'Halishahar', 'Karnaphuli',
                'Khulshi', 'Kotwali', 'Pahartali', 'Panchlaish', 'Patenga', 'Sandwip',
                'Satkania', 'Sitakunda',
            ],
            'Cumilla' => [
                'Adarsha Sadar', 'Barura', 'Brahmanpara', 'Burichang', 'Chandina',
                'Chauddagram', 'Daudkandi', 'Debidwar', 'Homna', 'Laksam', 'Manoharganj',
                'Meghna', 'Muradnagar', 'Nangalkot', 'Sadar Dakshin', 'Titas',
            ],
            'Cox\'s Bazar' => [
                'Chakaria', 'Cox\'s Bazar Sadar', 'Kutubdia', 'Maheshkhali', 'Pekua',
                'Ramu', 'Teknaf', 'Ukhia',
            ],
            'Feni' => [
                'Chhagalnaiya', 'Daganbhuiyan', 'Feni Sadar', 'Parshuram', 'Sonagazi',
            ],
            'Noakhali' => [
                'Begumganj', 'Chatkhil', 'Companiganj', 'Hatiya', 'Kabirhat',
                'Noakhali Sadar', 'Senbagh', 'Sonaimuri', 'Subarnachar',
            ],
        ];

        foreach ($upazilaData as $districtName => $upazilas) {
            $district = District::where('name', $districtName)->first();
            if (! $district) {
                continue;
            }
            foreach ($upazilas as $upazilaName) {
                $district->upazilas()->create([
                    'uuid' => Str::uuid(),
                    'name' => $upazilaName,
                    'slug' => Str::slug($upazilaName),
                    'bn_name' => null,
                ]);
            }
        }
    }
}
