<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KompetisiApiTest extends TestCase
{
    use MakeKompetisiTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateKompetisi()
    {
        $kompetisi = $this->fakeKompetisiData();
        $this->json('POST', '/api/v1/kompetisis', $kompetisi);

        $this->assertApiResponse($kompetisi);
    }

    /**
     * @test
     */
    public function testReadKompetisi()
    {
        $kompetisi = $this->makeKompetisi();
        $this->json('GET', '/api/v1/kompetisis/'.$kompetisi->id);

        $this->assertApiResponse($kompetisi->toArray());
    }

    /**
     * @test
     */
    public function testUpdateKompetisi()
    {
        $kompetisi = $this->makeKompetisi();
        $editedKompetisi = $this->fakeKompetisiData();

        $this->json('PUT', '/api/v1/kompetisis/'.$kompetisi->id, $editedKompetisi);

        $this->assertApiResponse($editedKompetisi);
    }

    /**
     * @test
     */
    public function testDeleteKompetisi()
    {
        $kompetisi = $this->makeKompetisi();
        $this->json('DELETE', '/api/v1/kompetisis/'.$kompetisi->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/kompetisis/'.$kompetisi->id);

        $this->assertResponseStatus(404);
    }
}
