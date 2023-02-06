<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CatalogCategory;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\ProductPropertyType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
        $productProperties = $this->__createProductProperties($productPropertyTypes); // create product properties
        $catalogCategories = $this->__createCatalogCategories($productPropertyTypes); // create catalog categories and attach property types to them
        $products = $this->__createProducts($catalogCategories, $productProperties);
    }

    /**
     * Create Product Property Types
     *
     * @return array
     */
    private function __createProductPropertyTypes()
    {
        $result = [];

        foreach (ProductPropertyTypeSeeder::$PROPERTY_TYPES as $categoryAlias => $propertyTypes) {
            $result[$categoryAlias] = new Collection();
            foreach ($propertyTypes as $propertyTypeAlias => $propertyTypeProperties)  {
                $product_property_type = ProductPropertyType::create([
                    'name' => $propertyTypeProperties['name'],
                    'value_type' => $propertyTypeProperties['value_type'],
                    'value_name' => $propertyTypeProperties['value_name'] ?? null,
                ]);

                $result[$categoryAlias][$propertyTypeAlias] = $product_property_type;
            }
        }

        return $result;
    }

    /**
     * Seed product properties.
     *
     * @param mixed $productPropertyTypes
     * @return array
     */
    private function __createProductProperties($productPropertyTypes)
    {
        $result = [];

        foreach (ProductPropertyTypeSeeder::$PROPERTY_TYPES as $categoryAlias => $propertyTypes) {
            $result[$categoryAlias] = [];
            foreach ($propertyTypes as $propertyTypeAlias => $propertyTypeProperties) {
                $result[$categoryAlias][$propertyTypeAlias] = new Collection();
                if ($propertyTypeProperties['value_type'] === 'enum') {
                    foreach ($propertyTypeProperties['values'] as $value) {
                        $productProperty = ProductProperty::create([
                            'value' => $value,
                            'product_property_type_id' => $productPropertyTypes[$categoryAlias][$propertyTypeAlias]->id,
                        ]);
                        $result[$categoryAlias][$propertyTypeAlias][] = $productProperty;
                    }
                }
                if ($propertyTypeProperties['value_type'] === 'number') {
                    for ($i = 0; $i < 10; $i++) {
                        $_value = fake()->randomFloat(2, $propertyTypeProperties['value_range'][0], $propertyTypeProperties['value_range'][1]);
                        $productProperty = ProductProperty::create([
                            'value' => $_value,
                            'value_number' => $_value,
                            'product_property_type_id' => $productPropertyTypes[$categoryAlias][$propertyTypeAlias]->id,
                        ]);
                        $result[$categoryAlias][$propertyTypeAlias][] = $productProperty;
                    }
                }
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
        foreach (CatalogCategorySeeder::$CATEGORY_NAMES as $categoryAlias => $categoryNames) {
            $catalogCategory = CatalogCategory::create([
                'name' => $categoryNames['plural']
            ]);
            $propertyTypeIds = $productPropertyTypes[$categoryAlias]->pluck('id')->toArray();
            $catalogCategory->propertyTypes()->attach($propertyTypeIds);
            $result[$categoryAlias] = $catalogCategory;
        };

        return $result;
    }

    /**
     * Create products and attach them to Catalog Categories.
     *
     * @param array $catalogCategories
     * @return array
     */
    private function __createProducts($catalogCategories, $productProperties)
    {
        $result = [];
        foreach ($catalogCategories as $categoryAlias => $catalogCategory) {
            $_randomProperties = [];
            $productPropertyTypesOfCategory = $productProperties[$categoryAlias];
            foreach ($productPropertyTypesOfCategory as $productPropertyTypeAlias => $productProperties) {
                $_randomProperty = $productProperties->random();
                $_randomProperties[] = $_randomProperty;
            }

            $products = new Collection();

            DB::beginTransaction();
            for ($i = 0; $i < 1000; $i++) {
                $product = Product::factory()
                    ->for($catalogCategory)
                    ->create();
                foreach ($_randomProperties as $randomProperty) {
                    $product->properties()->attach(
                        $randomProperty->id,
                        ['product_property_type_id' => $randomProperty->productPropertyType()->first()->id]
                    );
                }
            }
            DB::commit();

            $result[$categoryAlias] = $products;
        }

        return $result;
    }
}
