<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductPropertyTypeSeeder extends Seeder
{
    public static $PROPERTY_TYPES = [
        'processors' => [
            'brand' => [
                'name' => 'Бренд',
                'value_type' => 'enum',
                'values' => ['AMD', 'Intel'],
            ],
            'socket' => [
                'name' => 'Сокет',
                'value_type' => 'enum',
                'values' => ['AM5', 'AM4', 'LGA1700', 'LGA1200', 'LGA1151', 'AM3+'],
            ],
            'family' => [
                'name' => 'Семейство процессоров',
                'value_type' => 'enum',
                'values' => [
                    'Intel Core i9', 'Intel Core i7', 'Intel Core i5', 'Intel Core i3', 'Intel Pentium', 'Intel Celeron',
                    'AMD Ryzen 9', 'AMD Ryzen 7', 'AMD Ryzen 5', 'AMD Ryzen 3', 'AMD Athlon', 'AMD FX',
                ],
            ],
            'cores' => [
                'name' => 'Количество ядер',
                'value_type' => 'enum',
                'values' => [
                    '2', '4', '6', '8', '10', '12', '16', '32',
                ],
            ],
            'graphic_core' => [
                'name' => 'Графическое ядро',
                'value_type' => 'enum',
                'values' => [
                    'Да', 'Нет',
                ],
            ],
            'release_year' => [
                'name' => 'Год выпуска',
                'value_type' => 'enum',
                'values' => [
                    '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023',
                ],
            ],
            'memory_type' => [
                'name' => 'Тип памяти',
                'value_type' => 'enum',
                'values' => [
                    'DDR3', 'DDR4', 'DDR5'
                ]
            ],
            'processor_clock' => [
                'name' => 'Частота процессора',
                'value_type' => 'number',
                'value_name' => 'Ггц',
                'value_range' => [1.0, 5.0]
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
