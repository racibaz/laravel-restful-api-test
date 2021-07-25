<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::factory()->count(20)->create();

        $books = Book::all()->random(10);

        Category::all()->random(10)->each(function ($category) use ($books){
            $category->books()->attach($books);
        });
    }
}
