<?php

use Faker\Factory as Faker;
use App\Models\Pertandingan;
use App\Repositories\PertandinganRepository;

trait MakePertandinganTrait
{
    /**
     * Create fake instance of Pertandingan and save it in database
     *
     * @param array $pertandinganFields
     * @return Pertandingan
     */
    public function makePertandingan($pertandinganFields = [])
    {
        /** @var PertandinganRepository $pertandinganRepo */
        $pertandinganRepo = App::make(PertandinganRepository::class);
        $theme = $this->fakePertandinganData($pertandinganFields);
        return $pertandinganRepo->create($theme);
    }

    /**
     * Get fake instance of Pertandingan
     *
     * @param array $pertandinganFields
     * @return Pertandingan
     */
    public function fakePertandingan($pertandinganFields = [])
    {
        return new Pertandingan($this->fakePertandinganData($pertandinganFields));
    }

    /**
     * Get fake data of Pertandingan
     *
     * @param array $postFields
     * @return array
     */
    public function fakePertandinganData($pertandinganFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id_team_home' => $fake->randomDigitNotNull,
            'id_team_away' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $pertandinganFields);
    }
}
