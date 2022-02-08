<?php namespace Tests\Repositories;

use App\Models\Comic;
use App\Repositories\ComicRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ComicRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ComicRepository
     */
    protected $comicRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->comicRepo = \App::make(ComicRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_comic()
    {
        $comic = Comic::factory()->make()->toArray();

        $createdComic = $this->comicRepo->create($comic);

        $createdComic = $createdComic->toArray();
        $this->assertArrayHasKey('id', $createdComic);
        $this->assertNotNull($createdComic['id'], 'Created Comic must have id specified');
        $this->assertNotNull(Comic::find($createdComic['id']), 'Comic with given id must be in DB');
        $this->assertModelData($comic, $createdComic);
    }

    /**
     * @test read
     */
    public function test_read_comic()
    {
        $comic = Comic::factory()->create();

        $dbComic = $this->comicRepo->find($comic->id);

        $dbComic = $dbComic->toArray();
        $this->assertModelData($comic->toArray(), $dbComic);
    }

    /**
     * @test update
     */
    public function test_update_comic()
    {
        $comic = Comic::factory()->create();
        $fakeComic = Comic::factory()->make()->toArray();

        $updatedComic = $this->comicRepo->update($fakeComic, $comic->id);

        $this->assertModelData($fakeComic, $updatedComic->toArray());
        $dbComic = $this->comicRepo->find($comic->id);
        $this->assertModelData($fakeComic, $dbComic->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_comic()
    {
        $comic = Comic::factory()->create();

        $resp = $this->comicRepo->delete($comic->id);

        $this->assertTrue($resp);
        $this->assertNull(Comic::find($comic->id), 'Comic should not exist in DB');
    }
}
