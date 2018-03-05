<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKompetisiRequest;
use App\Http\Requests\UpdateKompetisiRequest;
use App\Repositories\KompetisiRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class KompetisiController extends AppBaseController
{
    /** @var  KompetisiRepository */
    private $kompetisiRepository;

    public function __construct(KompetisiRepository $kompetisiRepo)
    {
        $this->kompetisiRepository = $kompetisiRepo;
    }

    /**
     * Display a listing of the Kompetisi.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->kompetisiRepository->pushCriteria(new RequestCriteria($request));
        $kompetisis = $this->kompetisiRepository->all();

        return view('kompetisis.index')
            ->with('kompetisis', $kompetisis);
    }

    /**
     * Show the form for creating a new Kompetisi.
     *
     * @return Response
     */
    public function create()
    {
        return view('kompetisis.create');
    }

    /**
     * Store a newly created Kompetisi in storage.
     *
     * @param CreateKompetisiRequest $request
     *
     * @return Response
     */
    public function store(CreateKompetisiRequest $request)
    {
        $input = $request->all();

        $kompetisi = $this->kompetisiRepository->create($input);

        Flash::success('Kompetisi saved successfully.');

        return redirect(route('kompetisis.index'));
    }

    /**
     * Display the specified Kompetisi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kompetisi = $this->kompetisiRepository->findWithoutFail($id);

        if (empty($kompetisi)) {
            Flash::error('Kompetisi not found');

            return redirect(route('kompetisis.index'));
        }

        return view('kompetisis.show')->with('kompetisi', $kompetisi);
    }

    /**
     * Show the form for editing the specified Kompetisi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kompetisi = $this->kompetisiRepository->findWithoutFail($id);

        if (empty($kompetisi)) {
            Flash::error('Kompetisi not found');

            return redirect(route('kompetisis.index'));
        }

        return view('kompetisis.edit')->with('kompetisi', $kompetisi);
    }

    /**
     * Update the specified Kompetisi in storage.
     *
     * @param  int              $id
     * @param UpdateKompetisiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKompetisiRequest $request)
    {
        $kompetisi = $this->kompetisiRepository->findWithoutFail($id);

        if (empty($kompetisi)) {
            Flash::error('Kompetisi not found');

            return redirect(route('kompetisis.index'));
        }

        $kompetisi = $this->kompetisiRepository->update($request->all(), $id);

        Flash::success('Kompetisi updated successfully.');

        return redirect(route('kompetisis.index'));
    }

    /**
     * Remove the specified Kompetisi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kompetisi = $this->kompetisiRepository->findWithoutFail($id);

        if (empty($kompetisi)) {
            Flash::error('Kompetisi not found');

            return redirect(route('kompetisis.index'));
        }

        $this->kompetisiRepository->delete($id);

        Flash::success('Kompetisi deleted successfully.');

        return redirect(route('kompetisis.index'));
    }
}
