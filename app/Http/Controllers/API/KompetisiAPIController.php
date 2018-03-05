<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKompetisiAPIRequest;
use App\Http\Requests\API\UpdateKompetisiAPIRequest;
use App\Models\Kompetisi;
use App\Repositories\KompetisiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class KompetisiController
 * @package App\Http\Controllers\API
 */

class KompetisiAPIController extends AppBaseController
{
    /** @var  KompetisiRepository */
    private $kompetisiRepository;

    public function __construct(KompetisiRepository $kompetisiRepo)
    {
        $this->kompetisiRepository = $kompetisiRepo;
    }

    /**
     * Display a listing of the Kompetisi.
     * GET|HEAD /kompetisis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->kompetisiRepository->pushCriteria(new RequestCriteria($request));
        $this->kompetisiRepository->pushCriteria(new LimitOffsetCriteria($request));
        $kompetisis = $this->kompetisiRepository->all();

        return $this->sendResponse($kompetisis->toArray(), 'Kompetisis retrieved successfully');
    }

    /**
     * Store a newly created Kompetisi in storage.
     * POST /kompetisis
     *
     * @param CreateKompetisiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKompetisiAPIRequest $request)
    {
        $input = $request->all();
     // dd($input);

        $kompetisis = Kompetisi::create($input);

        return $this->sendResponse($kompetisis->toArray(), 'Kompetisi saved successfully');
    }

    /**
     * Display the specified Kompetisi.
     * GET|HEAD /kompetisis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Kompetisi $kompetisi */
        $kompetisi = $this->kompetisiRepository->findWithoutFail($id);

        if (empty($kompetisi)) {
            return $this->sendError('Kompetisi not found');
        }

        return $this->sendResponse($kompetisi->toArray(), 'Kompetisi retrieved successfully');
    }

    /**
     * Update the specified Kompetisi in storage.
     * PUT/PATCH /kompetisis/{id}
     *
     * @param  int $id
     * @param UpdateKompetisiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKompetisiAPIRequest $request)
    {
        $input = $request->all();

        /** @var Kompetisi $kompetisi */
        $kompetisis = Kompetisi::create($input);

        if (empty($kompetisi)) {
            return $this->sendError('Kompetisi not found');
        }

        $kompetisi = $this->kompetisiRepository->update($input, $id);

        return $this->sendResponse($kompetisi->toArray(), 'Kompetisi updated successfully');
    }

    /**
     * Remove the specified Kompetisi from storage.
     * DELETE /kompetisis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Kompetisi $kompetisi */
        $kompetisi = $this->kompetisiRepository->findWithoutFail($id);

        if (empty($kompetisi)) {
            return $this->sendError('Kompetisi not found');
        }

        $kompetisi->delete();

        return $this->sendResponse($id, 'Kompetisi deleted successfully');
    }
}
