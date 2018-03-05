<?php

use Faker\Factory as Faker;
use App\Models\Pemain;
use App\Repositories\PemainRepository;

trait MakePemainTrait
{
    /**
     * Create fake instance of Pemain and save it in database
     *
     * @param array $pemainFields
     * @return Pemain
     */
    public function makePemain($pemainFields = [])
    {
        /** @var PemainRepository $pemainRepo */
        $pemainRepo = App::make(PemainRepository::class);
        $theme = $this->fakePemainData($pemainFields);
        return $pemainRepo->create($theme);
    }

    /**
     * Get fake instance of Pemain
     *
     * @param array $pemainFields
     * @return Pemain
     */
    public function fakePemain($pemainFields = [])
    {
        return new Pemain($this->fakePemainData($pemainFields));
    }

    /**
     * Get fake data of Pemain
     *
     * @param array $postFields
     * @return array
     */
    public function fakePemainData($pemainFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'id_team' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $pemainFields);
    }
}
