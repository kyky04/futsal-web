<?php

use Faker\Factory as Faker;
use App\Models\Team;
use App\Repositories\TeamRepository;

trait MakeTeamTrait
{
    /**
     * Create fake instance of Team and save it in database
     *
     * @param array $teamFields
     * @return Team
     */
    public function makeTeam($teamFields = [])
    {
        /** @var TeamRepository $teamRepo */
        $teamRepo = App::make(TeamRepository::class);
        $theme = $this->fakeTeamData($teamFields);
        return $teamRepo->create($theme);
    }

    /**
     * Get fake instance of Team
     *
     * @param array $teamFields
     * @return Team
     */
    public function fakeTeam($teamFields = [])
    {
        return new Team($this->fakeTeamData($teamFields));
    }

    /**
     * Get fake data of Team
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTeamData($teamFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'id_lapang' => $fake->randomDigitNotNull,
            'id_user' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $teamFields);
    }
}
