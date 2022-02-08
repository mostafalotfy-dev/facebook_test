<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ShortVideo;

class ShortVideoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_short_video()
    {
        $shortVideo = ShortVideo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/short_videos', $shortVideo
        );

        $this->assertApiResponse($shortVideo);
    }

    /**
     * @test
     */
    public function test_read_short_video()
    {
        $shortVideo = ShortVideo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/short_videos/'.$shortVideo->id
        );

        $this->assertApiResponse($shortVideo->toArray());
    }

    /**
     * @test
     */
    public function test_update_short_video()
    {
        $shortVideo = ShortVideo::factory()->create();
        $editedShortVideo = ShortVideo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/short_videos/'.$shortVideo->id,
            $editedShortVideo
        );

        $this->assertApiResponse($editedShortVideo);
    }

    /**
     * @test
     */
    public function test_delete_short_video()
    {
        $shortVideo = ShortVideo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/short_videos/'.$shortVideo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/short_videos/'.$shortVideo->id
        );

        $this->response->assertStatus(404);
    }
}
