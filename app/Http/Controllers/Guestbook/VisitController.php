<?php

namespace App\Http\Controllers\Guestbook;


use App\Http\Requests\VisitCreateRequest;
use App\Http\Requests\VisitUpdateRequest;
use App\Models\Visit;
use App\Repositories\GuestRepository;
use App\Repositories\VisitRepository;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\DataTables;

class VisitController extends BaseController
{
    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    private $visitRepository;

    private $guestRepository;

    /**
     * VisitController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->guestRepository = app(GuestRepository::class);
        $this->visitRepository = app(VisitRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('guestbook.visits.index');
    }

    public function getVisits()
    {
        return $this->visitRepository->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $item = new Visit();
        $guestList = $this->guestRepository->getForComboBox();

        return view('guestbook.visits.edit', compact('item', 'guestList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VisitCreateRequest $request)
    {
        $data = $request->input();
        $item = (new Visit())->create($data);

        if ($item) {
            return redirect()->route('guestbook.visits.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->visitRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $guestList = $this->guestRepository->getForComboBox();

        return view('guestbook.visits.edit', compact('item', 'guestList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VisitUpdateRequest $request, $id)
    {
        $item = $this->visitRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('guestbook.visits.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = Visit::destroy($id);

        if ($result) {
            return redirect()
                ->route('guestbook.visits.index')
                ->with(['success' => 'Успешно удалено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
