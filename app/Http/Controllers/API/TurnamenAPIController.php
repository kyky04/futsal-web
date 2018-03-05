<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTurnamenAPIRequest;
use App\Http\Requests\API\UpdateTurnamenAPIRequest;
use App\Models\Turnamen;
use App\Repositories\TurnamenRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TurnamenController
 * @package App\Http\Controllers\API
 */

class TurnamenAPIController extends AppBaseController
{
    /** @var  TurnamenRepository */
    private $turnamenRepository;

    public function __construct(TurnamenRepository $turnamenRepo)
    {
        $this->turnamenRepository = $turnamenRepo;
    }

    /**
     * Display a listing of the Turnamen.
     * GET|HEAD /turnamens
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->turnamenRepository->pushCriteria(new RequestCriteria($request));
        $this->turnamenRepository->pushCriteria(new LimitOffsetCriteria($request));
        $turnamens = $this->turnamenRepository->all();

        return $this->sendResponse($turnamens->toArray(), 'Turnamens retrieved successfully');
    }

    /**
     * Store a newly created Turnamen in storage.
     * POST /turnamens
     *
     * @param CreateTurnamenAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTurnamenAPIRequest $request)
    {
        $input = $request->all();

        $turnamens = $this->turnamenRepository->create($input);

        return $this->sendResponse($turnamens->toArray(), 'Turnamen saved successfully');
    }

    /**
     * Display the specified Turnamen.
     * GET|HEAD /turnamens/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Turnamen $turnamen */
        $turnamen = $this->turnamenRepository->findWithoutFail($id);

        if (empty($turnamen)) {
            return $this->sendError('Turnamen not found');
        }

        return $this->sendResponse($turnamen->toArray(), 'Turnamen retrieved successfully');
    }

    /**
     * Update the specified Turnamen in storage.
     * PUT/PATCH /turnamens/{id}
     *
     * @param  int $id
     * @param UpdateTurnamenAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTurnamenAPIRequest $request)
    {
        $input = $request->all();

        /** @var Turnamen $turnamen */
        $turnamen = $this->turnamenRepository->findWithoutFail($id);

        if (empty($turnamen)) {
            return $this->sendError('Turnamen not found');
        }

        $turnamen = $this->turnamenRepository->update($input, $id);

        return $this->sendResponse($turnamen->toArray(), 'Turnamen updated successfully');
    }

    /**
     * Remove the specified Turnamen from storage.
     * DELETE /turnamens/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Turnamen $turnamen */
        $turnamen = $this->turnamenRepository->findWithoutFail($id);

        if (empty($turnamen)) {
            return $this->sendError('Turnamen not found');
        }

        $turnamen->delete();

        return $this->sendResponse($id, 'Turnamen deleted successfully');
    }
}
