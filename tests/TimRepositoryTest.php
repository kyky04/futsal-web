<?php

use App\Models\Tim;
use App\Repositories\TimRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TimRepositoryTest extends TestCase
{
    use MakeTimTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TimRepository
     */
    protected $timRepo;

    public function setUp()
    {
        parent::setUp();
        $this->timRepo = App::make(TimRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTim()
    {
        $tim = $this->fakeTimData();
        $createdTim = $this->timRepo->create($tim);
        $createdTim = $createdTim->toArray();
        $this->assertArrayHasKey('id', $createdTim);
        $this->assertNotNull($createdTim['id'], 'Created Tim must have id specified');
        $this->assertNotNull(Tim::find($createdTim['id']), 'Tim with given id must be in DB');
        $this->assertModelData($tim, $createdTim);
    }

    /**
     * @test read
     */
    public function testReadTim()
    {
        $tim = $this->makeTim();
        $dbTim = $this->timRepo->find($tim->id);
        $dbTim = $dbTim->toArray();
        $this->assertModelData($tim->toArray(), $dbTim);
    }

    /**
     * @test update
     */
    public function testUpdateTim()
    {
        $tim = $this->makeTim();
        $fakeTim = $this->fakeTimData();
        $updatedTim = $this->timRepo->update($fakeTim, $tim->id);
        $this->assertModelData($fakeTim, $updatedTim->toArray());
        $dbTim = $this->timRepo->find($tim->id);
        $this->assertModelData($fakeTim, $dbTim->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTim()
    {
        $tim = $this->makeTim();
        $resp = $this->timRepo->delete($tim->id);
        $this->assertTrue($resp);
        $this->assertNull(Tim::find($tim->id), 'Tim should not exist in DB');
    }
}
