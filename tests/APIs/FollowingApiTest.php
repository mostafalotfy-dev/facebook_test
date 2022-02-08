<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Following;

class FollowingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_following()
    {
        $following = Following::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/followings', $following
        );

        $this->assertApiResponse($following);
    }

    /**
     * @test
     */
    public function test_read_following()
    {
        $following = Following::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/followings/'.$following->id
        );

        $this->assertApiResponse($following->toArray());
    }

    /**
     * @test
     */
    public function test_update_following()
    {
        $following = Following::factory()->create();
        $editedFollowing = Following::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/followings/'.$following->id,
            $editedFollowing
        );

        $this->assertApiResponse($editedFollowing);
    }

    /**
     * @test
     */
    public function test_delete_following()
    {
        $following = Following::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/followings/'.$following->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/followings/'.$following->id
        );

        $this->response->assertStatus(404);
    }
}
