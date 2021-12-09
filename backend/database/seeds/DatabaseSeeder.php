<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PostMainCategoriesTableSeeder::class);
        $this->call(PostSubCategoriesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PostCommentsTableSeeder::class);
    }
}
