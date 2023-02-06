<?php

namespace Database\Seeders;

use App\Models\CatalogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogCategorySeeder extends Seeder
{
    private $__category_names = [
        'Процессоры',
        'Материнские платы',
        'Видеокарты',
        'Оперативная память',
        'Корпуса',
        'Блоки питания',
        'Охлаждение компьютера',
        'Твердотельные накопители',
        'Жесткие диски',
        'Мониторы',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert few simple categories
        foreach ($this->__category_names as $category_name) {
            CatalogCategory::create(['name' => $category_name]);
        };
    }
}
