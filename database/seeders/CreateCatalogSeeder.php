<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCatalogSeeder extends Seeder
{
    /**
     * Create catalog.
     *
     * @return void
     */
    public function run()
    {
        $this->__truncateTables();
        $catalogCategories = $this->__createCatalogCategories();
        $products = $this->__createProducts($catalogCategories);
    }

    /**
     * Truncate data from previous seed.
     *
     * @return void
     */
    private function __truncateTables()
    {
        Schema::disableForeignKeyConstraints();

        CatalogCategory::truncate();
        Product::truncate();

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Seed catalog categories.
     *
     * @return array
     */
    private function __createCatalogCategories()
    {
        $result = [];
        foreach (CatalogCategorySeeder::$CATEGORY_NAMES as $category_alias => $category_names) {
            $catalog_category = CatalogCategory::create([
                'name' => $category_names['plural']
            ]);
            $result[$category_alias] = $catalog_category;
        };

        return $result;
    }

    /**
     * Create products and attach them to Catalog Categories.
     *
     * @param array $catalogCategories
     * @return array
     */
    private function __createProducts($catalogCategories)
    {
        $result = [];
        foreach ($catalogCategories as $category_alias => $catalogCategory) {
            $products = Product::factory()
                ->count(1000)
                ->for($catalogCategory)
                ->create();
            $result[$category_alias] = $products;
        }

        return $result;
    }
}
