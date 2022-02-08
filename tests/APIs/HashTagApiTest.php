<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\HashTag;

class HashTagApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_hash_tag()
    {
        $hashTag = HashTag::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/hash_tags', $hashTag
        );

        $this->assertApiResponse($hashTag);
    }

    /**
     * @test
     */
    public function test_read_hash_tag()
    {
        $hashTag = HashTag::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/hash_tags/'.$hashTag->id
        );

        $this->assertApiResponse($hashTag->toArray());
    }

    /**
     * @test
     */
    public function test_update_hash_tag()
    {
        $hashTag = HashTag::factory()->create();
        $editedHashTag = HashTag::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/hash_tags/'.$hashTag->id,
            $editedHashTag
        );

        $this->assertApiResponse($editedHashTag);
    }

    /**
     * @test
     */
    public function test_delete_hash_tag()
    {
        $hashTag = HashTag::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/hash_tags/'.$hashTag->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/hash_tags/'.$hashTag->id
        );

        $this->response->assertStatus(404);
    }
}
