<?php

namespace Database\Seeders;

use App\Models\CatalogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Here we seed some test catalog categories
 */
class CatalogCategorySeeder extends Seeder
{
    public static $CATEGORY_NAMES = [
        'processors' => [
            'plural' => 'Процессоры',
            'singular' => 'Процессор',
        ],
        /*
        'motherboards' => [
            'plural' => 'Материнские платы',
            'singular' => 'Материнская плата',
        ],
        'Видеокарты',
        'Оперативная память',
        'Корпуса',
        'Блоки питания',
        'Охлаждение компьютера',
        'Твердотельные накопители',
        'Жесткие диски',
        'Мониторы',
        */
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
