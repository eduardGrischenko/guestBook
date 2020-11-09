<?php

namespace App\Http\Controllers\Guestbook;

use App\Http\Requests\GuestCreateRequest;
use App\Http\Requests\GuestUpdateRequest;
use App\Models\Guest;
use App\Repositories\GuestRepository;


class GuestController extends BaseController
{
    /**
     * @var GuestRepository
     */
    private $guestRepository;

    public function __construct()
    {
        parent::__construct();
        $this->guestRepository = app(GuestRepository::class);
    }
// репозиторий позволяет работаь с данными разных типов

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('guestbook.guests.index');
    }

    public function getGuests()
    {
        return $this->guestRepository->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $item = new Guest();

        return view('guestbook.guests.edit', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GuestCreateRequest $request)
    {
        $data = $request->input();

        $item = (new Guest())->create($data);

        if ($item) {
            return redirect()->route('guestbook.guests.index', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['msg' => 'Ошибка сохранения']);
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
        $item = $this->guestRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        return view('guestbook.guests.edit', compact('item'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param GuestUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GuestUpdateRequest $request, $id)
    {
        $item = $this->guestRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id = [{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('guestbook.guests.edit', $item->id)
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
    { $result = Guest::destroy($id);

        if ($result) {
            return redirect()
                ->route('guestbook.guests.index')
                ->with(['success' => "Запись id[$id] удалена"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
