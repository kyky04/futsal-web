<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TimApiTest extends TestCase
{
    use MakeTimTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTim()
    {
        $tim = $this->fakeTimData();
        $this->json('POST', '/api/v1/tims', $tim);

        $this->assertApiResponse($tim);
    }

    /**
     * @test
     */
    public function testReadTim()
    {
        $tim = $this->makeTim();
        $this->json('GET', '/api/v1/tims/'.$tim->id);

        $this->assertApiResponse($tim->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTim()
    {
        $tim = $this->makeTim();
        $editedTim = $this->fakeTimData();

        $this->json('PUT', '/api/v1/tims/'.$tim->id, $editedTim);

        $this->assertApiResponse($editedTim);
    }

    /**
     * @test
     */
    public function testDeleteTim()
    {
        $tim = $this->makeTim();
        $this->json('DELETE', '/api/v1/tims/'.$tim->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tims/'.$tim->id);

        $this->assertResponseStatus(404);
    }
}
