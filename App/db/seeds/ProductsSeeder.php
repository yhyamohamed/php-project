<?php


use Phinx\Seed\AbstractSeed;

class ProductsSeeder extends AbstractSeed
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'download_file_link' => $faker->regexify('[A-Z]{5}[0-4]{3}'),
                'product_name'         => $faker->name()
            ];
        }

        $this->table('Products')->insert($data)->saveData();
    }
}
