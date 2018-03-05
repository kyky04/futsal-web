<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLapanganRequest;
use App\Http\Requests\UpdateLapanganRequest;
use App\Repositories\LapanganRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class LapanganController extends AppBaseController
{
    /** @var  LapanganRepository */
    private $lapanganRepository;

    public function __construct(LapanganRepository $lapanganRepo)
    {
        $this->lapanganRepository = $lapanganRepo;
    }

    /**
     * Display a listing of the Lapangan.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->lapanganRepository->pushCriteria(new RequestCriteria($request));
        $lapangans = $this->lapanganRepository->all();

        return view('lapangans.index')
            ->with('lapangans', $lapangans);
    }

    /**
     * Show the form for creating a new Lapangan.
     *
     * @return Response
     */
    public function create()
    {
        return view('lapangans.create');
    }

    /**
     * Store a newly created Lapangan in storage.
     *
     * @param CreateLapanganRequest $request
     *
     * @return Response
     */
    public function store(CreateLapanganRequest $request)
    {
        $input = $request->all();

        $lapangan = $this->lapanganRepository->create($input);

        Flash::success('Lapangan saved successfully.');

        return redirect(route('lapangans.index'));
    }

    /**
     * Display the specified Lapangan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lapangan = $this->lapanganRepository->findWithoutFail($id);

        if (empty($lapangan)) {
            Flash::error('Lapangan not found');

            return redirect(route('lapangans.index'));
        }

        return view('lapangans.show')->with('lapangan', $lapangan);
    }

    /**
     * Show the form for editing the specified Lapangan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lapangan = $this->lapanganRepository->findWithoutFail($id);

        if (empty($lapangan)) {
            Flash::error('Lapangan not found');

            return redirect(route('lapangans.index'));
        }

        return view('lapangans.edit')->with('lapangan', $lapangan);
    }

    /**
     * Update the specified Lapangan in storage.
     *
     * @param  int              $id
     * @param UpdateLapanganRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLapanganRequest $request)
    {
        $lapangan = $this->lapanganRepository->findWithoutFail($id);

        if (empty($lapangan)) {
            Flash::error('Lapangan not found');

            return redirect(route('lapangans.index'));
        }

        $lapangan = $this->lapanganRepository->update($request->all(), $id);

        Flash::success('Lapangan updated successfully.');

        return redirect(route('lapangans.index'));
    }

    /**
     * Remove the specified Lapangan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lapangan = $this->lapanganRepository->findWithoutFail($id);

        if (empty($lapangan)) {
            Flash::error('Lapangan not found');

            return redirect(route('lapangans.index'));
        }

        $this->lapanganRepository->delete($id);

        Flash::success('Lapangan deleted successfully.');

        return redirect(route('lapangans.index'));
    }
}
