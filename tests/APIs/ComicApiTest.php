<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Comic;

class ComicApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_comic()
    {
        $comic = Comic::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/comics', $comic
        );

        $this->assertApiResponse($comic);
    }

    /**
     * @test
     */
    public function test_read_comic()
    {
        $comic = Comic::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/comics/'.$comic->id
        );

        $this->assertApiResponse($comic->toArray());
    }

    /**
     * @test
     */
    public function test_update_comic()
    {
        $comic = Comic::factory()->create();
        $editedComic = Comic::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/comics/'.$comic->id,
            $editedComic
        );

        $this->assertApiResponse($editedComic);
    }

    /**
     * @test
     */
    public function test_delete_comic()
    {
        $comic = Comic::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/comics/'.$comic->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/comics/'.$comic->id
        );

        $this->response->assertStatus(404);
    }
}
