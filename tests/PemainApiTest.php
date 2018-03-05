<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PemainApiTest extends TestCase
{
    use MakePemainTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePemain()
    {
        $pemain = $this->fakePemainData();
        $this->json('POST', '/api/v1/pemains', $pemain);

        $this->assertApiResponse($pemain);
    }

    /**
     * @test
     */
    public function testReadPemain()
    {
        $pemain = $this->makePemain();
        $this->json('GET', '/api/v1/pemains/'.$pemain->id);

        $this->assertApiResponse($pemain->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePemain()
    {
        $pemain = $this->makePemain();
        $editedPemain = $this->fakePemainData();

        $this->json('PUT', '/api/v1/pemains/'.$pemain->id, $editedPemain);

        $this->assertApiResponse($editedPemain);
    }

    /**
     * @test
     */
    public function testDeletePemain()
    {
        $pemain = $this->makePemain();
        $this->json('DELETE', '/api/v1/pemains/'.$pemain->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pemains/'.$pemain->id);

        $this->assertResponseStatus(404);
    }
}
