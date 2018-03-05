<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTurnamenRequest;
use App\Http\Requests\UpdateTurnamenRequest;
use App\Repositories\TurnamenRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TurnamenController extends AppBaseController
{
    /** @var  TurnamenRepository */
    private $turnamenRepository;

    public function __construct(TurnamenRepository $turnamenRepo)
    {
        $this->turnamenRepository = $turnamenRepo;
    }

    /**
     * Display a listing of the Turnamen.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->turnamenRepository->pushCriteria(new RequestCriteria($request));
        $turnamens = $this->turnamenRepository->all();

        return view('turnamens.index')
            ->with('turnamens', $turnamens);
    }

    /**
     * Show the form for creating a new Turnamen.
     *
     * @return Response
     */
    public function create()
    {
        return view('turnamens.create');
    }

    /**
     * Store a newly created Turnamen in storage.
     *
     * @param CreateTurnamenRequest $request
     *
     * @return Response
     */
    public function store(CreateTurnamenRequest $request)
    {
        $input = $request->all();

        $turnamen = $this->turnamenRepository->create($input);

        Flash::success('Turnamen saved successfully.');

        return redirect(route('turnamens.index'));
    }

    /**
     * Display the specified Turnamen.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $turnamen = $this->turnamenRepository->findWithoutFail($id);

        if (empty($turnamen)) {
            Flash::error('Turnamen not found');

            return redirect(route('turnamens.index'));
        }

        return view('turnamens.show')->with('turnamen', $turnamen);
    }

    /**
     * Show the form for editing the specified Turnamen.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $turnamen = $this->turnamenRepository->findWithoutFail($id);

        if (empty($turnamen)) {
            Flash::error('Turnamen not found');

            return redirect(route('turnamens.index'));
        }

        return view('turnamens.edit')->with('turnamen', $turnamen);
    }

    /**
     * Update the specified Turnamen in storage.
     *
     * @param  int              $id
     * @param UpdateTurnamenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTurnamenRequest $request)
    {
        $turnamen = $this->turnamenRepository->findWithoutFail($id);

        if (empty($turnamen)) {
            Flash::error('Turnamen not found');

            return redirect(route('turnamens.index'));
        }

        $turnamen = $this->turnamenRepository->update($request->all(), $id);

        Flash::success('Turnamen updated successfully.');

        return redirect(route('turnamens.index'));
    }

    /**
     * Remove the specified Turnamen from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $turnamen = $this->turnamenRepository->findWithoutFail($id);

        if (empty($turnamen)) {
            Flash::error('Turnamen not found');

            return redirect(route('turnamens.index'));
        }

        $this->turnamenRepository->delete($id);

        Flash::success('Turnamen deleted successfully.');

        return redirect(route('turnamens.index'));
    }
}
