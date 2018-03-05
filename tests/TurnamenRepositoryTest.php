<?php

use App\Models\Turnamen;
use App\Repositories\TurnamenRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TurnamenRepositoryTest extends TestCase
{
    use MakeTurnamenTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TurnamenRepository
     */
    protected $turnamenRepo;

    public function setUp()
    {
        parent::setUp();
        $this->turnamenRepo = App::make(TurnamenRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTurnamen()
    {
        $turnamen = $this->fakeTurnamenData();
        $createdTurnamen = $this->turnamenRepo->create($turnamen);
        $createdTurnamen = $createdTurnamen->toArray();
        $this->assertArrayHasKey('id', $createdTurnamen);
        $this->assertNotNull($createdTurnamen['id'], 'Created Turnamen must have id specified');
        $this->assertNotNull(Turnamen::find($createdTurnamen['id']), 'Turnamen with given id must be in DB');
        $this->assertModelData($turnamen, $createdTurnamen);
    }

    /**
     * @test read
     */
    public function testReadTurnamen()
    {
        $turnamen = $this->makeTurnamen();
        $dbTurnamen = $this->turnamenRepo->find($turnamen->id);
        $dbTurnamen = $dbTurnamen->toArray();
        $this->assertModelData($turnamen->toArray(), $dbTurnamen);
    }

    /**
     * @test update
     */
    public function testUpdateTurnamen()
    {
        $turnamen = $this->makeTurnamen();
        $fakeTurnamen = $this->fakeTurnamenData();
        $updatedTurnamen = $this->turnamenRepo->update($fakeTurnamen, $turnamen->id);
        $this->assertModelData($fakeTurnamen, $updatedTurnamen->toArray());
        $dbTurnamen = $this->turnamenRepo->find($turnamen->id);
        $this->assertModelData($fakeTurnamen, $dbTurnamen->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTurnamen()
    {
        $turnamen = $this->makeTurnamen();
        $resp = $this->turnamenRepo->delete($turnamen->id);
        $this->assertTrue($resp);
        $this->assertNull(Turnamen::find($turnamen->id), 'Turnamen should not exist in DB');
    }
}
