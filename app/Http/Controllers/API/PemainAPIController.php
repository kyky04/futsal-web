<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePemainAPIRequest;
use App\Http\Requests\API\UpdatePemainAPIRequest;
use App\Models\Pemain;
use App\Repositories\PemainRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PemainController
 * @package App\Http\Controllers\API
 */

class PemainAPIController extends AppBaseController
{
    /** @var  PemainRepository */
    private $pemainRepository;

    public function __construct(PemainRepository $pemainRepo)
    {
        $this->pemainRepository = $pemainRepo;
    }

    /**
     * Display a listing of the Pemain.
     * GET|HEAD /pemains
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pemainRepository->pushCriteria(new RequestCriteria($request));
        $this->pemainRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pemains = $this->pemainRepository->all();

        return $this->sendResponse($pemains->toArray(), 'Pemains retrieved successfully');
    }

    /**
     * Store a newly created Pemain in storage.
     * POST /pemains
     *
     * @param CreatePemainAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePemainAPIRequest $request)
    {
        $input = $request->all();

        $pemains = $this->pemainRepository->create($input);

        return $this->sendResponse($pemains->toArray(), 'Pemain saved successfully');
    }

    /**
     * Display the specified Pemain.
     * GET|HEAD /pemains/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Pemain $pemain */
        $pemain = $this->pemainRepository->findWithoutFail($id);

        if (empty($pemain)) {
            return $this->sendError('Pemain not found');
        }

        return $this->sendResponse($pemain->toArray(), 'Pemain retrieved successfully');
    }

    /**
     * Update the specified Pemain in storage.
     * PUT/PATCH /pemains/{id}
     *
     * @param  int $id
     * @param UpdatePemainAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePemainAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pemain $pemain */
        $pemain = Pemain::find($id);

        if (empty($pemain)) {
            return $this->sendError('Pemain not found');
        }

        $pemain = $this->pemainRepository->update($input, $id);

        return $this->sendResponse($pemain->toArray(), 'Pemain updated successfully');
    }

    /**
     * Remove the specified Pemain from storage.
     * DELETE /pemains/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Pemain $pemain */
        $pemain = $this->pemainRepository->findWithoutFail($id);

        if (empty($pemain)) {
            return $this->sendError('Pemain not found');
        }

        $pemain->delete();

        return $this->sendResponse($id, 'Pemain deleted successfully');
    }


      public function showByTeam($id_team)
    {
        $pemain = Pemain::where('id_team',$id_team)->get();
         if (empty($pemain)) {
            return $this->sendError('Pemain not found');
        }

        return $this->sendResponse($pemain->toArray(), 'Pemain retrieved successfully');
    }
}
