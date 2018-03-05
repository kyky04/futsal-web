<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TurnamenApiTest extends TestCase
{
    use MakeTurnamenTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTurnamen()
    {
        $turnamen = $this->fakeTurnamenData();
        $this->json('POST', '/api/v1/turnamens', $turnamen);

        $this->assertApiResponse($turnamen);
    }

    /**
     * @test
     */
    public function testReadTurnamen()
    {
        $turnamen = $this->makeTurnamen();
        $this->json('GET', '/api/v1/turnamens/'.$turnamen->id);

        $this->assertApiResponse($turnamen->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTurnamen()
    {
        $turnamen = $this->makeTurnamen();
        $editedTurnamen = $this->fakeTurnamenData();

        $this->json('PUT', '/api/v1/turnamens/'.$turnamen->id, $editedTurnamen);

        $this->assertApiResponse($editedTurnamen);
    }

    /**
     * @test
     */
    public function testDeleteTurnamen()
    {
        $turnamen = $this->makeTurnamen();
        $this->json('DELETE', '/api/v1/turnamens/'.$turnamen->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/turnamens/'.$turnamen->id);

        $this->assertResponseStatus(404);
    }
}
