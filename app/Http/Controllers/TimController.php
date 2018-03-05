<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTimRequest;
use App\Http\Requests\UpdateTimRequest;
use App\Repositories\TimRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TimController extends AppBaseController
{
    /** @var  TimRepository */
    private $timRepository;

    public function __construct(TimRepository $timRepo)
    {
        $this->timRepository = $timRepo;
    }

    /**
     * Display a listing of the Tim.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->timRepository->pushCriteria(new RequestCriteria($request));
        $tims = $this->timRepository->all();

        return view('tims.index')
            ->with('tims', $tims);
    }

    /**
     * Show the form for creating a new Tim.
     *
     * @return Response
     */
    public function create()
    {
        return view('tims.create');
    }

    /**
     * Store a newly created Tim in storage.
     *
     * @param CreateTimRequest $request
     *
     * @return Response
     */
    public function store(CreateTimRequest $request)
    {
        $input = $request->all();

        $tim = $this->timRepository->create($input);

        Flash::success('Tim saved successfully.');

        return redirect(route('tims.index'));
    }

    /**
     * Display the specified Tim.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tim = $this->timRepository->findWithoutFail($id);

        if (empty($tim)) {
            Flash::error('Tim not found');

            return redirect(route('tims.index'));
        }

        return view('tims.show')->with('tim', $tim);
    }

    /**
     * Show the form for editing the specified Tim.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tim = $this->timRepository->findWithoutFail($id);

        if (empty($tim)) {
            Flash::error('Tim not found');

            return redirect(route('tims.index'));
        }

        return view('tims.edit')->with('tim', $tim);
    }

    /**
     * Update the specified Tim in storage.
     *
     * @param  int              $id
     * @param UpdateTimRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTimRequest $request)
    {
        $tim = $this->timRepository->findWithoutFail($id);

        if (empty($tim)) {
            Flash::error('Tim not found');

            return redirect(route('tims.index'));
        }

        $tim = $this->timRepository->update($request->all(), $id);

        Flash::success('Tim updated successfully.');

        return redirect(route('tims.index'));
    }

    /**
     * Remove the specified Tim from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tim = $this->timRepository->findWithoutFail($id);

        if (empty($tim)) {
            Flash::error('Tim not found');

            return redirect(route('tims.index'));
        }

        $this->timRepository->delete($id);

        Flash::success('Tim deleted successfully.');

        return redirect(route('tims.index'));
    }
}
