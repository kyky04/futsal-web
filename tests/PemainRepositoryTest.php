<?php

use App\Models\Pemain;
use App\Repositories\PemainRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PemainRepositoryTest extends TestCase
{
    use MakePemainTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PemainRepository
     */
    protected $pemainRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pemainRepo = App::make(PemainRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePemain()
    {
        $pemain = $this->fakePemainData();
        $createdPemain = $this->pemainRepo->create($pemain);
        $createdPemain = $createdPemain->toArray();
        $this->assertArrayHasKey('id', $createdPemain);
        $this->assertNotNull($createdPemain['id'], 'Created Pemain must have id specified');
        $this->assertNotNull(Pemain::find($createdPemain['id']), 'Pemain with given id must be in DB');
        $this->assertModelData($pemain, $createdPemain);
    }

    /**
     * @test read
     */
    public function testReadPemain()
    {
        $pemain = $this->makePemain();
        $dbPemain = $this->pemainRepo->find($pemain->id);
        $dbPemain = $dbPemain->toArray();
        $this->assertModelData($pemain->toArray(), $dbPemain);
    }

    /**
     * @test update
     */
    public function testUpdatePemain()
    {
        $pemain = $this->makePemain();
        $fakePemain = $this->fakePemainData();
        $updatedPemain = $this->pemainRepo->update($fakePemain, $pemain->id);
        $this->assertModelData($fakePemain, $updatedPemain->toArray());
        $dbPemain = $this->pemainRepo->find($pemain->id);
        $this->assertModelData($fakePemain, $dbPemain->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePemain()
    {
        $pemain = $this->makePemain();
        $resp = $this->pemainRepo->delete($pemain->id);
        $this->assertTrue($resp);
        $this->assertNull(Pemain::find($pemain->id), 'Pemain should not exist in DB');
    }
}
