<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PertandinganApiTest extends TestCase
{
    use MakePertandinganTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePertandingan()
    {
        $pertandingan = $this->fakePertandinganData();
        $this->json('POST', '/api/v1/pertandingans', $pertandingan);

        $this->assertApiResponse($pertandingan);
    }

    /**
     * @test
     */
    public function testReadPertandingan()
    {
        $pertandingan = $this->makePertandingan();
        $this->json('GET', '/api/v1/pertandingans/'.$pertandingan->id);

        $this->assertApiResponse($pertandingan->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePertandingan()
    {
        $pertandingan = $this->makePertandingan();
        $editedPertandingan = $this->fakePertandinganData();

        $this->json('PUT', '/api/v1/pertandingans/'.$pertandingan->id, $editedPertandingan);

        $this->assertApiResponse($editedPertandingan);
    }

    /**
     * @test
     */
    public function testDeletePertandingan()
    {
        $pertandingan = $this->makePertandingan();
        $this->json('DELETE', '/api/v1/pertandingans/'.$pertandingan->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pertandingans/'.$pertandingan->id);

        $this->assertResponseStatus(404);
    }
}
