<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLapanganAPIRequest;
use App\Http\Requests\API\UpdateLapanganAPIRequest;
use App\Models\Lapangan;
use App\Repositories\LapanganRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LapanganController
 * @package App\Http\Controllers\API
 */

class LapanganAPIController extends AppBaseController
{
    /** @var  LapanganRepository */
    private $lapanganRepository;

    public function __construct(LapanganRepository $lapanganRepo)
    {
        $this->lapanganRepository = $lapanganRepo;
    }

    /**
     * Display a listing of the Lapangan.
     * GET|HEAD /lapangans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->lapanganRepository->pushCriteria(new RequestCriteria($request));
        $this->lapanganRepository->pushCriteria(new LimitOffsetCriteria($request));
        $lapangans = $this->lapanganRepository->with('team')->all();

        return $this->sendResponse($lapangans->toArray(), 'Lapangans retrieved successfully');
    }

    /**
     * Store a newly created Lapangan in storage.
     * POST /lapangans
     *
     * @param CreateLapanganAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLapanganAPIRequest $request)
    {
        $input = $request->all();

        $lapangans = $this->lapanganRepository->create($input);

        return $this->sendResponse($lapangans->toArray(), 'Lapangan saved successfully');
    }

    /**
     * Display the specified Lapangan.
     * GET|HEAD /lapangans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Lapangan $lapangan */
        $lapangan = $this->lapanganRepository->findWithoutFail($id);

        if (empty($lapangan)) {
            return $this->sendError('Lapangan not found');
        }

        return $this->sendResponse($lapangan->toArray(), 'Lapangan retrieved successfully');
    }

    /**
     * Update the specified Lapangan in storage.
     * PUT/PATCH /lapangans/{id}
     *
     * @param  int $id
     * @param UpdateLapanganAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLapanganAPIRequest $request)
    {
        $input = $request->all();

        /** @var Lapangan $lapangan */
        $lapangan = $this->lapanganRepository->findWithoutFail($id);

        if (empty($lapangan)) {
            return $this->sendError('Lapangan not found');
        }

        $lapangan = $this->lapanganRepository->update($input, $id);

        return $this->sendResponse($lapangan->toArray(), 'Lapangan updated successfully');
    }

    /**
     * Remove the specified Lapangan from storage.
     * DELETE /lapangans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Lapangan $lapangan */
        $lapangan = $this->lapanganRepository->findWithoutFail($id);

        if (empty($lapangan)) {
            return $this->sendError('Lapangan not found');
        }

        $lapangan->delete();

        return $this->sendResponse($id, 'Lapangan deleted successfully');
    }
}
