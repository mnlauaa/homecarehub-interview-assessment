<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'post_id'       => 1,
                'text'          => fake()->paragraph(1, true),
                'created_at'    => fake()->dateTimeThisYear(),
                'updated_at'    => fake()->dateTimeThisYear()
            ],
            [
                'post_id'       => 1,
                'text'          => fake()->paragraph(1, true),
                'created_at'    => fake()->dateTimeThisYear(),
                'updated_at'    => fake()->dateTimeThisYear()
            ],
            [
                'post_id'       => 1,
                'text'          => fake()->paragraph(1, true),
                'created_at'    => fake()->dateTimeThisYear(),
                'updated_at'    => fake()->dateTimeThisYear()
            ],
            [
                'post_id'       => 2,
                'text'          => fake()->paragraph(1, true),
                'created_at'    => fake()->dateTimeThisYear(),
                'updated_at'    => fake()->dateTimeThisYear()
            ],
            [
                'post_id'       => 2,
                'text'          => fake()->paragraph(1, true),
                'created_at'    => fake()->dateTimeThisYear(),
                'updated_at'    => fake()->dateTimeThisYear()
            ],
        ]);
    }
}
