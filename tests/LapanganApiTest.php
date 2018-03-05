<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LapanganApiTest extends TestCase
{
    use MakeLapanganTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLapangan()
    {
        $lapangan = $this->fakeLapanganData();
        $this->json('POST', '/api/v1/lapangans', $lapangan);

        $this->assertApiResponse($lapangan);
    }

    /**
     * @test
     */
    public function testReadLapangan()
    {
        $lapangan = $this->makeLapangan();
        $this->json('GET', '/api/v1/lapangans/'.$lapangan->id);

        $this->assertApiResponse($lapangan->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLapangan()
    {
        $lapangan = $this->makeLapangan();
        $editedLapangan = $this->fakeLapanganData();

        $this->json('PUT', '/api/v1/lapangans/'.$lapangan->id, $editedLapangan);

        $this->assertApiResponse($editedLapangan);
    }

    /**
     * @test
     */
    public function testDeleteLapangan()
    {
        $lapangan = $this->makeLapangan();
        $this->json('DELETE', '/api/v1/lapangans/'.$lapangan->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/lapangans/'.$lapangan->id);

        $this->assertResponseStatus(404);
    }
}
