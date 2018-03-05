<?php

use Faker\Factory as Faker;
use App\Models\Lapangan;
use App\Repositories\LapanganRepository;

trait MakeLapanganTrait
{
    /**
     * Create fake instance of Lapangan and save it in database
     *
     * @param array $lapanganFields
     * @return Lapangan
     */
    public function makeLapangan($lapanganFields = [])
    {
        /** @var LapanganRepository $lapanganRepo */
        $lapanganRepo = App::make(LapanganRepository::class);
        $theme = $this->fakeLapanganData($lapanganFields);
        return $lapanganRepo->create($theme);
    }

    /**
     * Get fake instance of Lapangan
     *
     * @param array $lapanganFields
     * @return Lapangan
     */
    public function fakeLapangan($lapanganFields = [])
    {
        return new Lapangan($this->fakeLapanganData($lapanganFields));
    }

    /**
     * Get fake data of Lapangan
     *
     * @param array $postFields
     * @return array
     */
    public function fakeLapanganData($lapanganFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'latitude' => $fake->randomDigitNotNull,
            'longitude' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $lapanganFields);
    }
}
