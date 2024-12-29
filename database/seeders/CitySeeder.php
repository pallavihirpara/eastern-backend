<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['state_id' => 1,'name' => "Nicobars"],
            ['state_id' => 1,'name' => "North and Middle Andaman"],
            ['state_id' => 1,'name' => "South Andaman"],
            ['state_id' => 2, 'name' => "Anantapur"],
            ['state_id' => 2, 'name' => "Chittoor"],
            ['state_id' => 2, 'name' => "East Godavari"],
            ['state_id' => 2, 'name' => "Guntur"],
            ['state_id' => 2, 'name' => "Krishna"],
            ['state_id' => 2, 'name' => "Kurnool"],
            ['state_id' => 2, 'name' => "Prakasam"],
            ['state_id' => 2, 'name' => "Sri Potti Sriramulu Nellore"],
            ['state_id' => 2, 'name' => "Srikakulam"],
            ['state_id' => 2, 'name' => "Visakhapatnam"],
            ['state_id' => 2, 'name' => "Vizianagaram"],
            ['state_id' => 2, 'name' => "West Godavari"],
            ['state_id' => 2, 'name' => "Y.S.R."],
            ['state_id' => 3, 'name' => "Anjaw"],
            ['state_id' => 3, 'name' => "Changlang"],
            ['state_id' => 3, 'name' => "Dibang Valley"],
            ['state_id' => 3, 'name' => "East Kameng"],
            ['state_id' => 3, 'name' => "East Siang"],
            ['state_id' => 3, 'name' => "Kra Daadi"],
            ['state_id' => 3, 'name' => "Kurung Kumey"],
            ['state_id' => 3, 'name' => "Lohit"],
            ['state_id' => 3, 'name' => "Lower Dibang Valley"],
            ['state_id' => 3, 'name' => "Lower Siang"],
            ['state_id' => 3, 'name' => "Lower Subansiri"],
            ['state_id' => 3, 'name' => "Namsai"],
            ['state_id' => 3, 'name' => "Papum Pare"],
            ['state_id' => 3, 'name' => "Siang"],
            ['state_id' => 3, 'name' => "Tawang"],
            ['state_id' => 3, 'name' => "Tirap"],
            ['state_id' => 3, 'name' => "Upper Siang"],
            ['state_id' => 3, 'name' => "Upper Subansiri"],
            ['state_id' => 3, 'name' => "West Kameng"],
            ['state_id' => 3, 'name' => "West Siang"],
            ['state_id' => 9, 'name' => "North Goa"],
            ['state_id' => 9, 'name' => "South Goa"],
            ['state_id' => 10, 'name' => "Ahmadabad"],
            ['state_id' => 10, 'name' => "Amreli"],
            ['state_id' => 10, 'name' => "Anand"],
            ['state_id' => 10, 'name' => "Arvalli"],
            ['state_id' => 10, 'name' => "Banas Kantha"],
            ['state_id' => 10, 'name' => "Bharuch"],
            ['state_id' => 10, 'name' => "Bhavnagar"],
            ['state_id' => 10, 'name' => "Botad"],
            ['state_id' => 10, 'name' => "Chhota Udepur"],
            ['state_id' => 10, 'name' => "Devbhoomi Dwarka"],
            ['state_id' => 10, 'name' => "Dohad"],
            ['state_id' => 10, 'name' => "Gandhinagar"],
            ['state_id' => 10, 'name' => "Gir Somnath"],
            ['state_id' => 10, 'name' => "Jamnagar"],
            ['state_id' => 10, 'name' => "Junagadh"],
            ['state_id' => 10, 'name' => "Kachchh"],
            ['state_id' => 10, 'name' => "Kheda"],
            ['state_id' => 10, 'name' => "Mahesana"],
            ['state_id' => 10, 'name' => "Mahisagar"],
            ['state_id' => 10, 'name' => "Morbi"],
            ['state_id' => 10, 'name' => "Narmada"],
            ['state_id' => 10, 'name' => "Navsari"],
            ['state_id' => 10, 'name' => "Panch Mahals"],
            ['state_id' => 10, 'name' => "Patan"],
            ['state_id' => 10, 'name' => "Porbandar"],
            ['state_id' => 10, 'name' => "Rajkot"],
            ['state_id' => 10, 'name' => "Sabar Kantha"],
            ['state_id' => 10, 'name' => "Surat"],
            ['state_id' => 10, 'name' => "Surendranagar"],
            ['state_id' => 10, 'name' => "Tapi"],
            ['state_id' => 10, 'name' => "The Dangs"],
            ['state_id' => 10, 'name' => "Vadodara"],
            ['state_id' => 10, 'name' => "Valsad"]
        ];
        City::insert($data);
    }
}
