<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePertandinganAPIRequest;
use App\Http\Requests\API\UpdatePertandinganAPIRequest;
use App\Models\Pertandingan;
use App\Repositories\PertandinganRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PertandinganController
 * @package App\Http\Controllers\API
 */

class PertandinganAPIController extends AppBaseController
{
    /** @var  PertandinganRepository */
    private $pertandinganRepository;

    public function __construct(PertandinganRepository $pertandinganRepo)
    {
        $this->pertandinganRepository = $pertandinganRepo;
    }

    /**
     * Display a listing of the Pertandingan.
     * GET|HEAD /pertandingans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pertandinganRepository->pushCriteria(new RequestCriteria($request));
        $this->pertandinganRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pertandingans = $this->pertandinganRepository->with('teamHome')->with('teamAway')->all();

        return $this->sendResponse($pertandingans->toArray(), 'Pertandingans retrieved successfully');
    }

    /**
     * Store a newly created Pertandingan in storage.
     * POST /pertandingans
     *
     * @param CreatePertandinganAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePertandinganAPIRequest $request)
    {
        $input = $request->all();

        $pertandingans = $this->pertandinganRepository->create($input);

        return $this->sendResponse($pertandingans->toArray(), 'Pertandingan saved successfully');
    }

    /**
     * Display the specified Pertandingan.
     * GET|HEAD /pertandingans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Pertandingan $pertandingan */
        $this->pertandinganRepository->pushCriteria(new RequestCriteria($request));
        $this->pertandinganRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pertandingans = $this->pertandinganRepository->with('teamHome')->with('teamAway')->all();

        return $this->sendResponse($pertandingans->toArray(), 'Pertandingans retrieved successfully');
    }

    public function pertandingan($id)
    {
        /** @var Pertandingan $pertandingan */
        $pertandingans = Pertandingan::with('teamHome')->with('teamAway')->where('id_team_home',$id)->orWhere('id_team_away',$id)->get();

        return $this->sendResponse($pertandingans->toArray(), 'Pertandingans retrieved successfully');
    }

    /**
     * Update the specified Pertandingan in storage.
     * PUT/PATCH /pertandingans/{id}
     *
     * @param  int $id
     * @param UpdatePertandinganAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePertandinganAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pertandingan $pertandingan */
        $pertandingan = $this->pertandinganRepository->findWithoutFail($id);

        if (empty($pertandingan)) {
            return $this->sendError('Pertandingan not found');
        }

        $pertandingan = $this->pertandinganRepository->update($input, $id);

        return $this->sendResponse($pertandingan->toArray(), 'Pertandingan updated successfully');
    }

    /**
     * Remove the specified Pertandingan from storage.
     * DELETE /pertandingans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Pertandingan $pertandingan */
        $pertandingan = $this->pertandinganRepository->findWithoutFail($id);

        if (empty($pertandingan)) {
            return $this->sendError('Pertandingan not found');
        }

        $pertandingan->delete();

        return $this->sendResponse($id, 'Pertandingan deleted successfully');
    }
}
