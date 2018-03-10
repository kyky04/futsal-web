<?php

use App\Models\Pertandingan;
use App\Repositories\PertandinganRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PertandinganRepositoryTest extends TestCase
{
    use MakePertandinganTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PertandinganRepository
     */
    protected $pertandinganRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pertandinganRepo = App::make(PertandinganRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePertandingan()
    {
        $pertandingan = $this->fakePertandinganData();
        $createdPertandingan = $this->pertandinganRepo->create($pertandingan);
        $createdPertandingan = $createdPertandingan->toArray();
        $this->assertArrayHasKey('id', $createdPertandingan);
        $this->assertNotNull($createdPertandingan['id'], 'Created Pertandingan must have id specified');
        $this->assertNotNull(Pertandingan::find($createdPertandingan['id']), 'Pertandingan with given id must be in DB');
        $this->assertModelData($pertandingan, $createdPertandingan);
    }

    /**
     * @test read
     */
    public function testReadPertandingan()
    {
        $pertandingan = $this->makePertandingan();
        $dbPertandingan = $this->pertandinganRepo->find($pertandingan->id);
        $dbPertandingan = $dbPertandingan->toArray();
        $this->assertModelData($pertandingan->toArray(), $dbPertandingan);
    }

    /**
     * @test update
     */
    public function testUpdatePertandingan()
    {
        $pertandingan = $this->makePertandingan();
        $fakePertandingan = $this->fakePertandinganData();
        $updatedPertandingan = $this->pertandinganRepo->update($fakePertandingan, $pertandingan->id);
        $this->assertModelData($fakePertandingan, $updatedPertandingan->toArray());
        $dbPertandingan = $this->pertandinganRepo->find($pertandingan->id);
        $this->assertModelData($fakePertandingan, $dbPertandingan->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePertandingan()
    {
        $pertandingan = $this->makePertandingan();
        $resp = $this->pertandinganRepo->delete($pertandingan->id);
        $this->assertTrue($resp);
        $this->assertNull(Pertandingan::find($pertandingan->id), 'Pertandingan should not exist in DB');
    }
}
