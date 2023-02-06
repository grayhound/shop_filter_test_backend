<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductPropertySeeder extends Seeder
{
    private static $__property_types = [
        'processors' => [
            'brand' => [
                'type' => 'enum',
                'values' => ['AMD', 'Intel'],
            ],
            'socket' => [
                'type' => 'enum',
                'values' => ['AM5', 'AM4', 'LGA1700', 'LGA1200', 'LGA1151', 'AM3+'],
            ],
            'family' => [
                'type' => 'enum',
                'values' => [
                    'Intel Core i9', 'Intel Core i7', 'Intel Core i5', 'Intel Core i3', 'Intel Pentium', 'Intel Celeron',
                    'AMD Ryzen 9', 'AMD Ryzen 7', 'AMD Ryzen 5', 'AMD Ryzen 3', 'AMD Athlon', 'AMD FX',
                ],
            ],
            'cores' => [
                'type' => 'enum',
                'values' => [
                    '2', '4', '6', '8', '10', '12', '16', '32',
                ],
            ],
            'graphic_core' => [
                'type' => 'enum',
                'values' => [
                    'Да', 'Нет',
                ],
            ],
            'release_year' => [
                'type' => 'enum',
                'values' => [
                    '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023',
                ],
            ],
            'memory_type' => [
                'type' => 'enum',
                'values' => [
                    'DDR3', 'DDR4', 'DDR5'
                ]
            ],
            'processor_clock' => [
                'type' => 'value',
                'name' => 'Ггц',
            ]
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    }
}
