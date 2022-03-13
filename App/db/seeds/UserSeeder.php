<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{

    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        $data[] = [
            'email'         => "admin@admin.com",
            'password'      => sha1(123456),
          
        ];
        for ($i = 0; $i < 4; $i++) {
            $data[] = [
                'email'         => $faker->email(),
                'password'      => sha1($faker->password()),
              
            ];
        }

        $this->table('Users')->insert($data)->saveData();
    }
}
