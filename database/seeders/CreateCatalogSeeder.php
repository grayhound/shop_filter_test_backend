<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CatalogCategory;
use App\Models\Product;
use App\Models\ProductPropertyType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class CreateCatalogSeeder extends Seeder
{
    /**
     * Create catalog.
     *
     * @return void
     */
    public function run()
    {
        $productPropertyTypes = $this->__createProductPropertyTypes(); //create property types first
        $catalogCategories = $this->__createCatalogCategories($productPropertyTypes); // create catalog categories and attach property types to them
        $products = $this->__createProducts($catalogCategories);
    }

    /**
     * Create Product Property Types
     *
     * @return array
     */
    private function __createProductPropertyTypes()
    {
        $result = [];

        foreach (ProductPropertyTypeSeeder::$PROPERTY_TYPES as $category_alias => $property_types) {
            $result[$category_alias] = [];
            foreach ($property_types as $property_type_alias => $property_type_properties)  {
                $product_property_type = ProductPropertyType::create([
                    'name' => $property_type_properties['name'],
                    'value_type' => $property_type_properties['value_type'],
                    'value_name' => $property_type_properties['value_name'] ?? null,
                ]);

                $result[$category_alias][$property_type_alias] = $product_property_type;
            }
        }

        return $result;
    }

    /**
     * Create catalog categories
     *
     * @param array $productPropertyTypes
     * @return array
     */
    private function __createCatalogCategories(array $productPropertyTypes)
    {
        $result = [];
        foreach (CatalogCategorySeeder::$CATEGORY_NAMES as $category_alias => $category_names) {
            $catalog_category = CatalogCategory::create([
                'name' => $category_names['plural']
            ]);
            $property_type_ids = collect($productPropertyTypes[$category_alias])->pluck('id')->toArray();
            $catalog_category->propertyTypes()->attach($property_type_ids);
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
