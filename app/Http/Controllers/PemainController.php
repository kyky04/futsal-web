<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePemainRequest;
use App\Http\Requests\UpdatePemainRequest;
use App\Repositories\PemainRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PemainController extends AppBaseController
{
    /** @var  PemainRepository */
    private $pemainRepository;

    public function __construct(PemainRepository $pemainRepo)
    {
        $this->pemainRepository = $pemainRepo;
    }

    /**
     * Display a listing of the Pemain.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pemainRepository->pushCriteria(new RequestCriteria($request));
        $pemains = $this->pemainRepository->all();

        return view('pemains.index')
            ->with('pemains', $pemains);
    }

    /**
     * Show the form for creating a new Pemain.
     *
     * @return Response
     */
    public function create()
    {
        return view('pemains.create');
    }

    /**
     * Store a newly created Pemain in storage.
     *
     * @param CreatePemainRequest $request
     *
     * @return Response
     */
    public function store(CreatePemainRequest $request)
    {
        $input = $request->all();

        $pemain = $this->pemainRepository->create($input);

        Flash::success('Pemain saved successfully.');

        return redirect(route('pemains.index'));
    }

    /**
     * Display the specified Pemain.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pemain = $this->pemainRepository->findWithoutFail($id);

        if (empty($pemain)) {
            Flash::error('Pemain not found');

            return redirect(route('pemains.index'));
        }

        return view('pemains.show')->with('pemain', $pemain);
    }

    /**
     * Show the form for editing the specified Pemain.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pemain = $this->pemainRepository->findWithoutFail($id);

        if (empty($pemain)) {
            Flash::error('Pemain not found');

            return redirect(route('pemains.index'));
        }

        return view('pemains.edit')->with('pemain', $pemain);
    }

    /**
     * Update the specified Pemain in storage.
     *
     * @param  int              $id
     * @param UpdatePemainRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePemainRequest $request)
    {
        $pemain = $this->pemainRepository->findWithoutFail($id);

        if (empty($pemain)) {
            Flash::error('Pemain not found');

            return redirect(route('pemains.index'));
        }

        $pemain = $this->pemainRepository->update($request->all(), $id);

        Flash::success('Pemain updated successfully.');

        return redirect(route('pemains.index'));
    }

    /**
     * Remove the specified Pemain from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pemain = $this->pemainRepository->findWithoutFail($id);

        if (empty($pemain)) {
            Flash::error('Pemain not found');

            return redirect(route('pemains.index'));
        }

        $this->pemainRepository->delete($id);

        Flash::success('Pemain deleted successfully.');

        return redirect(route('pemains.index'));
    }

}
