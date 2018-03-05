<?php

use App\Models\Kompetisi;
use App\Repositories\KompetisiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KompetisiRepositoryTest extends TestCase
{
    use MakeKompetisiTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var KompetisiRepository
     */
    protected $kompetisiRepo;

    public function setUp()
    {
        parent::setUp();
        $this->kompetisiRepo = App::make(KompetisiRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateKompetisi()
    {
        $kompetisi = $this->fakeKompetisiData();
        $createdKompetisi = $this->kompetisiRepo->create($kompetisi);
        $createdKompetisi = $createdKompetisi->toArray();
        $this->assertArrayHasKey('id', $createdKompetisi);
        $this->assertNotNull($createdKompetisi['id'], 'Created Kompetisi must have id specified');
        $this->assertNotNull(Kompetisi::find($createdKompetisi['id']), 'Kompetisi with given id must be in DB');
        $this->assertModelData($kompetisi, $createdKompetisi);
    }

    /**
     * @test read
     */
    public function testReadKompetisi()
    {
        $kompetisi = $this->makeKompetisi();
        $dbKompetisi = $this->kompetisiRepo->find($kompetisi->id);
        $dbKompetisi = $dbKompetisi->toArray();
        $this->assertModelData($kompetisi->toArray(), $dbKompetisi);
    }

    /**
     * @test update
     */
    public function testUpdateKompetisi()
    {
        $kompetisi = $this->makeKompetisi();
        $fakeKompetisi = $this->fakeKompetisiData();
        $updatedKompetisi = $this->kompetisiRepo->update($fakeKompetisi, $kompetisi->id);
        $this->assertModelData($fakeKompetisi, $updatedKompetisi->toArray());
        $dbKompetisi = $this->kompetisiRepo->find($kompetisi->id);
        $this->assertModelData($fakeKompetisi, $dbKompetisi->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteKompetisi()
    {
        $kompetisi = $this->makeKompetisi();
        $resp = $this->kompetisiRepo->delete($kompetisi->id);
        $this->assertTrue($resp);
        $this->assertNull(Kompetisi::find($kompetisi->id), 'Kompetisi should not exist in DB');
    }
}
