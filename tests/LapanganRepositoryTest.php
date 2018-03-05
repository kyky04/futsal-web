<?php

use App\Models\Lapangan;
use App\Repositories\LapanganRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LapanganRepositoryTest extends TestCase
{
    use MakeLapanganTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LapanganRepository
     */
    protected $lapanganRepo;

    public function setUp()
    {
        parent::setUp();
        $this->lapanganRepo = App::make(LapanganRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateLapangan()
    {
        $lapangan = $this->fakeLapanganData();
        $createdLapangan = $this->lapanganRepo->create($lapangan);
        $createdLapangan = $createdLapangan->toArray();
        $this->assertArrayHasKey('id', $createdLapangan);
        $this->assertNotNull($createdLapangan['id'], 'Created Lapangan must have id specified');
        $this->assertNotNull(Lapangan::find($createdLapangan['id']), 'Lapangan with given id must be in DB');
        $this->assertModelData($lapangan, $createdLapangan);
    }

    /**
     * @test read
     */
    public function testReadLapangan()
    {
        $lapangan = $this->makeLapangan();
        $dbLapangan = $this->lapanganRepo->find($lapangan->id);
        $dbLapangan = $dbLapangan->toArray();
        $this->assertModelData($lapangan->toArray(), $dbLapangan);
    }

    /**
     * @test update
     */
    public function testUpdateLapangan()
    {
        $lapangan = $this->makeLapangan();
        $fakeLapangan = $this->fakeLapanganData();
        $updatedLapangan = $this->lapanganRepo->update($fakeLapangan, $lapangan->id);
        $this->assertModelData($fakeLapangan, $updatedLapangan->toArray());
        $dbLapangan = $this->lapanganRepo->find($lapangan->id);
        $this->assertModelData($fakeLapangan, $dbLapangan->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteLapangan()
    {
        $lapangan = $this->makeLapangan();
        $resp = $this->lapanganRepo->delete($lapangan->id);
        $this->assertTrue($resp);
        $this->assertNull(Lapangan::find($lapangan->id), 'Lapangan should not exist in DB');
    }
}
