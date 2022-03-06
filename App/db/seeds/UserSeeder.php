<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{

    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'email'         => $faker->email(),
                'password'      => sha1($faker->password()),
                'remeber_me_token' => $faker->regexify('[A-Z]{5}[0-4]{3}')
            ];
        }

        $this->table('Users')->insert($data)->saveData();
    }
}
