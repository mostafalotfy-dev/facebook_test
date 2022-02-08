<?php namespace Tests\Repositories;

use App\Models\ShortVideo;
use App\Repositories\ShortVideoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ShortVideoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ShortVideoRepository
     */
    protected $shortVideoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->shortVideoRepo = \App::make(ShortVideoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_short_video()
    {
        $shortVideo = ShortVideo::factory()->make()->toArray();

        $createdShortVideo = $this->shortVideoRepo->create($shortVideo);

        $createdShortVideo = $createdShortVideo->toArray();
        $this->assertArrayHasKey('id', $createdShortVideo);
        $this->assertNotNull($createdShortVideo['id'], 'Created ShortVideo must have id specified');
        $this->assertNotNull(ShortVideo::find($createdShortVideo['id']), 'ShortVideo with given id must be in DB');
        $this->assertModelData($shortVideo, $createdShortVideo);
    }

    /**
     * @test read
     */
    public function test_read_short_video()
    {
        $shortVideo = ShortVideo::factory()->create();

        $dbShortVideo = $this->shortVideoRepo->find($shortVideo->id);

        $dbShortVideo = $dbShortVideo->toArray();
        $this->assertModelData($shortVideo->toArray(), $dbShortVideo);
    }

    /**
     * @test update
     */
    public function test_update_short_video()
    {
        $shortVideo = ShortVideo::factory()->create();
        $fakeShortVideo = ShortVideo::factory()->make()->toArray();

        $updatedShortVideo = $this->shortVideoRepo->update($fakeShortVideo, $shortVideo->id);

        $this->assertModelData($fakeShortVideo, $updatedShortVideo->toArray());
        $dbShortVideo = $this->shortVideoRepo->find($shortVideo->id);
        $this->assertModelData($fakeShortVideo, $dbShortVideo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_short_video()
    {
        $shortVideo = ShortVideo::factory()->create();

        $resp = $this->shortVideoRepo->delete($shortVideo->id);

        $this->assertTrue($resp);
        $this->assertNull(ShortVideo::find($shortVideo->id), 'ShortVideo should not exist in DB');
    }
}
