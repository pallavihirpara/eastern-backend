<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = [
            ['name' => "ANDAMAN & NICOBAR ISLANDS"],
            ['name' => "ANDHRA PRADESH"],
            ['name' => "ARUNACHAL PRADESH"],
            ['name' => "ASSAM"],
            ['name' => "BIHAR"],
            ['name' => "CHANDIGARH"],
            ['name' => "CHHATTISGARH"],
            ['name' => "DADRA & NAGAR HAVELI"],
            ['name' => "DAMAN AND DIU"],
            ['name' => "GOA"],
            ['name' => "GUJARAT"],
          ];
          State::insert($state);
    }
}
