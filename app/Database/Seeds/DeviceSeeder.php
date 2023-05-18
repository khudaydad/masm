<?php

namespace App\Database\Seeds;

use App\Models\Device;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class DeviceSeeder extends Seeder
{
    public function run()
    {
        $device = new Device;
        $faker = Factory::create();

        for ($i = 0; $i < 5000; $i++) {
            $device->save(
                [
                    'uid'           => $faker->uuid(),
                    'app_id'        => $faker->unique(true)->regexify('[0-9]{20}'),
                    'language'      => $faker->languageCode(),
                    'os'            => $faker->randomElement(['andorid', 'ios', 'symbian', 'windows']),
                    'created_at'    => Time::createFromTimestamp($faker->unixTime()),
                    'updated_at'    => Time::now()
                ]
            );
        }
    }
}
