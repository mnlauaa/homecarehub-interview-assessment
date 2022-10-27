<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title'         => fake()->words(3, true),
                'author_name'   => fake()->name(),
                'body'          => fake()->paragraphs(5, true),
                'image'         => "post_image/test_image_1.jpg",
                'created_at'    => fake()->dateTimeThisYear(),
                'updated_at'    => fake()->dateTimeThisYear()
            ],
            [
                'title'         => fake()->words(3, true),
                'author_name'   => fake()->name(),
                'body'          => fake()->paragraphs(5, true),
                'image'         => "post_image/test_image_2.jpg",
                'created_at'    => fake()->dateTimeThisYear(),
                'updated_at'    => fake()->dateTimeThisYear()
            ]
        ]);
    }
}
