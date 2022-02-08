<?php namespace Tests\Repositories;

use App\Models\HashTag;
use App\Repositories\HashTagRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class HashTagRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var HashTagRepository
     */
    protected $hashTagRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->hashTagRepo = \App::make(HashTagRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_hash_tag()
    {
        $hashTag = HashTag::factory()->make()->toArray();

        $createdHashTag = $this->hashTagRepo->create($hashTag);

        $createdHashTag = $createdHashTag->toArray();
        $this->assertArrayHasKey('id', $createdHashTag);
        $this->assertNotNull($createdHashTag['id'], 'Created HashTag must have id specified');
        $this->assertNotNull(HashTag::find($createdHashTag['id']), 'HashTag with given id must be in DB');
        $this->assertModelData($hashTag, $createdHashTag);
    }

    /**
     * @test read
     */
    public function test_read_hash_tag()
    {
        $hashTag = HashTag::factory()->create();

        $dbHashTag = $this->hashTagRepo->find($hashTag->id);

        $dbHashTag = $dbHashTag->toArray();
        $this->assertModelData($hashTag->toArray(), $dbHashTag);
    }

    /**
     * @test update
     */
    public function test_update_hash_tag()
    {
        $hashTag = HashTag::factory()->create();
        $fakeHashTag = HashTag::factory()->make()->toArray();

        $updatedHashTag = $this->hashTagRepo->update($fakeHashTag, $hashTag->id);

        $this->assertModelData($fakeHashTag, $updatedHashTag->toArray());
        $dbHashTag = $this->hashTagRepo->find($hashTag->id);
        $this->assertModelData($fakeHashTag, $dbHashTag->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_hash_tag()
    {
        $hashTag = HashTag::factory()->create();

        $resp = $this->hashTagRepo->delete($hashTag->id);

        $this->assertTrue($resp);
        $this->assertNull(HashTag::find($hashTag->id), 'HashTag should not exist in DB');
    }
}
