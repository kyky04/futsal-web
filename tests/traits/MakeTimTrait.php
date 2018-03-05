<?php

use Faker\Factory as Faker;
use App\Models\Tim;
use App\Repositories\TimRepository;

trait MakeTimTrait
{
    /**
     * Create fake instance of Tim and save it in database
     *
     * @param array $timFields
     * @return Tim
     */
    public function makeTim($timFields = [])
    {
        /** @var TimRepository $timRepo */
        $timRepo = App::make(TimRepository::class);
        $theme = $this->fakeTimData($timFields);
        return $timRepo->create($theme);
    }

    /**
     * Get fake instance of Tim
     *
     * @param array $timFields
     * @return Tim
     */
    public function fakeTim($timFields = [])
    {
        return new Tim($this->fakeTimData($timFields));
    }

    /**
     * Get fake data of Tim
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTimData($timFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'id_lapang' => $fake->randomDigitNotNull,
            'id_user' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $timFields);
    }
}
