<?php namespace Tests\Repositories;

use App\Models\Following;
use App\Repositories\FollowingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FollowingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FollowingRepository
     */
    protected $followingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->followingRepo = \App::make(FollowingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_following()
    {
        $following = Following::factory()->make()->toArray();

        $createdFollowing = $this->followingRepo->create($following);

        $createdFollowing = $createdFollowing->toArray();
        $this->assertArrayHasKey('id', $createdFollowing);
        $this->assertNotNull($createdFollowing['id'], 'Created Following must have id specified');
        $this->assertNotNull(Following::find($createdFollowing['id']), 'Following with given id must be in DB');
        $this->assertModelData($following, $createdFollowing);
    }

    /**
     * @test read
     */
    public function test_read_following()
    {
        $following = Following::factory()->create();

        $dbFollowing = $this->followingRepo->find($following->id);

        $dbFollowing = $dbFollowing->toArray();
        $this->assertModelData($following->toArray(), $dbFollowing);
    }

    /**
     * @test update
     */
    public function test_update_following()
    {
        $following = Following::factory()->create();
        $fakeFollowing = Following::factory()->make()->toArray();

        $updatedFollowing = $this->followingRepo->update($fakeFollowing, $following->id);

        $this->assertModelData($fakeFollowing, $updatedFollowing->toArray());
        $dbFollowing = $this->followingRepo->find($following->id);
        $this->assertModelData($fakeFollowing, $dbFollowing->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_following()
    {
        $following = Following::factory()->create();

        $resp = $this->followingRepo->delete($following->id);

        $this->assertTrue($resp);
        $this->assertNull(Following::find($following->id), 'Following should not exist in DB');
    }
}
