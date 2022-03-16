<?php


use Phinx\Seed\AbstractSeed;

class OrdersSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'UserSeeder',
            'ProductsSeeder'
        ];
    }
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 5; $i++)
        {
            $data[] = [
                'download_count' => $faker->numberBetween(0, 6),
                'user_id' => $faker->numberBetween(1, 5),
                'product_id' => $faker->numberBetween(1, 5)
            ];
        }

        $this->table('Orders')->insert($data)->saveData();
    }
}
