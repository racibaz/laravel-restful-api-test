<?php

namespace Tests\Feature\Http\Controller\API;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class BookControllerAPITest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     * @return void
     */
    public function can_return_a_collection_of_paginated_record2()
    {
        $faker = Factory::create();
        $user = User::factory()->create();
        Book::factory(20)->create();


        $response = $this->actingAs($user, 'api')
            ->json('GET', 'api/v1/books');


        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'ISBN',
                    'description',
                ]
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next'
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'links' => [
                    '*' => [
                        'url',
                        'label',
                        'active'
                    ]
                ],
                'path',
                'per_page',
                'to',
                'total',
            ],

        ]);
    }

    /**
     * @test
     * @return void
     */
    public function can_update_record_return_correct_data()
    {
        $faker = Factory::create();
        $user = User::factory()->create();
        Book::factory()->create();

        $payload = [
            'name' => 'Test name',
            'description' => 'Test Desc',
            'ISBN' => 'Test ISBN',
            'status' => true
        ];

        $response = $this->withHeaders([
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json'
        ])->put("api/v1/books/1", [
            'body' => [
                json_encode($payload)
            ]
        ]);

        dump($response->getContent());

        $response->assertStatus(Response::HTTP_OK);

    }

    /**
     * @test
     * @return void
     */
    public function can_return_a_record()
    {
        $user = User::factory()->create();
        Book::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('GET', 'api/v1/books/1');

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     * @return void
     */
    public function can_create_a_record()
    {
        $faker = Factory::create();
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', 'api/v1/books', [
                    'name' => $name = $faker->text(20),
                    'description' => $description = $faker->text(200),
                    'ISBN' => $ISBN = $faker->isbn13(),
                    'status' => $status = $faker->boolean
                ]
            );

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('books', [
                'name' => $name,
                'description' => $description,
                'ISBN' => $ISBN,
                'status' => $status,
            ]
        );
    }

    /**
     * @test
     * @return void
     */
    public function can_delete_a_record()
    {
        $faker = Factory::create();
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', 'api/v1/books/1', [
                    'name' => $name = $faker->text(20),
                    'description' => $description = $faker->text(200),
                    'ISBN' => $ISBN = $faker->isbn13(),
                    'status' => $status = $faker->boolean
                ]
            );

        $this->assertDatabaseMissing('books', [
                'name' => $name,
                'description' => $description,
                'ISBN' => $ISBN,
                'status' => $status,
            ]
        );

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     * @return void
     */
    public function can_get_related_category_records(): void
    {
        $category = Book::factory()
            ->hasAttached(
                Category::factory()->count(3),
            )
            ->create();


        $recordCount = $category->categories()->get()->count();

        $this->assertEquals(3, $recordCount);
    }

}
