<?php

namespace App\Database\Seeds;

use App\Models\Subscription;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        $subscription = new Subscription;
        $faker = Factory::create();

        $statuses = ['active', 'canceled', 'expired'];

        for ($i = 0; $i < 20000; $i++) {
            $element = $statuses[array_rand($statuses)];
            $subscription->save(
                [
                    'device_id'     => $faker->numberBetween(1, 5000),
                    'client_token'  => $faker->unique(true)->regexify('[A-Za-z0-9]{20}'),
                    'receipt'       => $faker->unique(true)->regexify('[0-9]{15}'),
                    'start_date'    => date('Y-m-d', rand(strtotime('2022-01-01'), strtotime('2023-05-13'))),
                    'end_date'      => date('Y-m-d', rand(strtotime('2022-01-01'), strtotime('2023-12-29'))),
                    'status'        => $faker->randomElement(['active', 'canceled', 'expired']),
                    'created_at'    => Time::createFromTimestamp($faker->unixTime()),
                    'updated_at'    => Time::now()
                ]
            );
        }
    }
}
