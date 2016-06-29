<?php

use CodePress\CodeCategory\Models\Category;
use CodePress\CodePost\Models\Post;
use CodePress\CodeTag\Models\Tag;
use CodePress\CodeUser\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);

        factory(Category::class, 5)->create();

        factory(Tag::class, 5)->create();

        factory(Post::class, 5)->create();

        factory(User::class)->create([
            'name' => 'Editor',
            'email' => 'editor@codepress.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);

        factory(User::class)->create([
            'name' => 'Redactor',
            'email' => 'redactor@codepress.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);
    }
}
