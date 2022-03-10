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
            'remeber_me_token' => $faker->regexify('[A-Z]{5}[0-4]{3}')
        ];
        for ($i = 0; $i < 4; $i++) {
            $data[] = [
                'email'         => $faker->email(),
                'password'      => sha1($faker->password()),
                'remeber_me_token' => $faker->regexify('[A-Z]{5}[0-4]{3}')
            ];
        }

        $this->table('Users')->insert($data)->saveData();
    }
}
