<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('CategoriesTableSeeder');

        $this->command->info('User table seeded!');
    }
}
class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        Category::create(['name' => 'Electronics']);
        Category::create(['name' => 'Sports']);
        Category::create(['name' => 'Furnitures']);
    }

}
