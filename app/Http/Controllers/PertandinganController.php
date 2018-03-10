<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePertandinganRequest;
use App\Http\Requests\UpdatePertandinganRequest;
use App\Repositories\PertandinganRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PertandinganController extends AppBaseController
{
    /** @var  PertandinganRepository */
    private $pertandinganRepository;

    public function __construct(PertandinganRepository $pertandinganRepo)
    {
        $this->pertandinganRepository = $pertandinganRepo;
    }

    /**
     * Display a listing of the Pertandingan.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pertandinganRepository->pushCriteria(new RequestCriteria($request));
        $pertandingans = $this->pertandinganRepository->all();

        return view('pertandingans.index')
            ->with('pertandingans', $pertandingans);
    }

    /**
     * Show the form for creating a new Pertandingan.
     *
     * @return Response
     */
    public function create()
    {
        return view('pertandingans.create');
    }

    /**
     * Store a newly created Pertandingan in storage.
     *
     * @param CreatePertandinganRequest $request
     *
     * @return Response
     */
    public function store(CreatePertandinganRequest $request)
    {
        $input = $request->all();

        $pertandingan = $this->pertandinganRepository->create($input);

        Flash::success('Pertandingan saved successfully.');

        return redirect(route('pertandingans.index'));
    }

    /**
     * Display the specified Pertandingan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pertandingan = $this->pertandinganRepository->findWithoutFail($id);

        if (empty($pertandingan)) {
            Flash::error('Pertandingan not found');

            return redirect(route('pertandingans.index'));
        }

        return view('pertandingans.show')->with('pertandingan', $pertandingan);
    }

    /**
     * Show the form for editing the specified Pertandingan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pertandingan = $this->pertandinganRepository->findWithoutFail($id);

        if (empty($pertandingan)) {
            Flash::error('Pertandingan not found');

            return redirect(route('pertandingans.index'));
        }

        return view('pertandingans.edit')->with('pertandingan', $pertandingan);
    }

    /**
     * Update the specified Pertandingan in storage.
     *
     * @param  int              $id
     * @param UpdatePertandinganRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePertandinganRequest $request)
    {
        $pertandingan = $this->pertandinganRepository->findWithoutFail($id);

        if (empty($pertandingan)) {
            Flash::error('Pertandingan not found');

            return redirect(route('pertandingans.index'));
        }

        $pertandingan = $this->pertandinganRepository->update($request->all(), $id);

        Flash::success('Pertandingan updated successfully.');

        return redirect(route('pertandingans.index'));
    }

    /**
     * Remove the specified Pertandingan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pertandingan = $this->pertandinganRepository->findWithoutFail($id);

        if (empty($pertandingan)) {
            Flash::error('Pertandingan not found');

            return redirect(route('pertandingans.index'));
        }

        $this->pertandinganRepository->delete($id);

        Flash::success('Pertandingan deleted successfully.');

        return redirect(route('pertandingans.index'));
    }
}
