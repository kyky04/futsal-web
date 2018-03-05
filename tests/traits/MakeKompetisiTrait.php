<?php

use Faker\Factory as Faker;
use App\Models\Kompetisi;
use App\Repositories\KompetisiRepository;

trait MakeKompetisiTrait
{
    /**
     * Create fake instance of Kompetisi and save it in database
     *
     * @param array $kompetisiFields
     * @return Kompetisi
     */
    public function makeKompetisi($kompetisiFields = [])
    {
        /** @var KompetisiRepository $kompetisiRepo */
        $kompetisiRepo = App::make(KompetisiRepository::class);
        $theme = $this->fakeKompetisiData($kompetisiFields);
        return $kompetisiRepo->create($theme);
    }

    /**
     * Get fake instance of Kompetisi
     *
     * @param array $kompetisiFields
     * @return Kompetisi
     */
    public function fakeKompetisi($kompetisiFields = [])
    {
        return new Kompetisi($this->fakeKompetisiData($kompetisiFields));
    }

    /**
     * Get fake data of Kompetisi
     *
     * @param array $postFields
     * @return array
     */
    public function fakeKompetisiData($kompetisiFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'waktu' => $fake->word,
            'nama' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $kompetisiFields);
    }
}
