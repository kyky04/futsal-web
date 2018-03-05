<?php

use Faker\Factory as Faker;
use App\Models\Turnamen;
use App\Repositories\TurnamenRepository;

trait MakeTurnamenTrait
{
    /**
     * Create fake instance of Turnamen and save it in database
     *
     * @param array $turnamenFields
     * @return Turnamen
     */
    public function makeTurnamen($turnamenFields = [])
    {
        /** @var TurnamenRepository $turnamenRepo */
        $turnamenRepo = App::make(TurnamenRepository::class);
        $theme = $this->fakeTurnamenData($turnamenFields);
        return $turnamenRepo->create($theme);
    }

    /**
     * Get fake instance of Turnamen
     *
     * @param array $turnamenFields
     * @return Turnamen
     */
    public function fakeTurnamen($turnamenFields = [])
    {
        return new Turnamen($this->fakeTurnamenData($turnamenFields));
    }

    /**
     * Get fake data of Turnamen
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTurnamenData($turnamenFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'waktu' => $fake->word,
            'tempat' => $fake->word,
            'keterangan' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $turnamenFields);
    }
}
