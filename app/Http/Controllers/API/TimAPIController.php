<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTimAPIRequest;
use App\Http\Requests\API\UpdateTimAPIRequest;
use App\Models\Tim;
use App\Repositories\TimRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TimController
 * @package App\Http\Controllers\API
 */

class TimAPIController extends AppBaseController
{
    /** @var  TimRepository */
    private $timRepository;

    public function __construct(TimRepository $timRepo)
    {
        $this->timRepository = $timRepo;
    }

    /**
     * Display a listing of the Tim.
     * GET|HEAD /tims
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->timRepository->pushCriteria(new RequestCriteria($request));
        $this->timRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tims = $this->timRepository->all();

        return $this->sendResponse($tims->toArray(), 'Tims retrieved successfully');
    }

    /**
     * Store a newly created Tim in storage.
     * POST /tims
     *
     * @param CreateTimAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTimAPIRequest $request)
    {
        $input = $request->all();

        $tims = $this->timRepository->create($input);

        return $this->sendResponse($tims->toArray(), 'Tim saved successfully');
    }

    /**
     * Display the specified Tim.
     * GET|HEAD /tims/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Tim $tim */
        $tim = $this->timRepository->with('lapang')->findWithoutFail($id);

        if (empty($tim)) {
            return $this->sendError('Tim not found');
        }

        return $this->sendResponse($tim->toArray(), 'Tim retrieved successfully');
    }

    /**
     * Update the specified Tim in storage.
     * PUT/PATCH /tims/{id}
     *
     * @param  int $id
     * @param UpdateTimAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTimAPIRequest $request)
    {
        $input = $request->all();

        /** @var Tim $tim */
        $tim = $this->timRepository->findWithoutFail($id);

        if (empty($tim)) {
            return $this->sendError('Tim not found');
        }

        $tim = $this->timRepository->update($input, $id);

        return $this->sendResponse($tim->toArray(), 'Tim updated successfully');
    }

    /**
     * Remove the specified Tim from storage.
     * DELETE /tims/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Tim $tim */
        $tim = $this->timRepository->findWithoutFail($id);

        if (empty($tim)) {
            return $this->sendError('Tim not found');
        }

        $tim->delete();

        return $this->sendResponse($id, 'Tim deleted successfully');
    }
}
