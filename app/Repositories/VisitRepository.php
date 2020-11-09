<?php

namespace App\Repositories;

use App\Models\Visit as Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Yajra\DataTables\DataTables;

class VisitRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получаем список
     *
     *
     * @return LengthAwarePaginator
     */
    public function getAllData()
    {
        $visits = Model::join('guests', 'guests.id', '=', 'visits.guest_id')
            ->select(['visits.id', 'visits.time', 'guests.name', 'guests.birthday', 'guests.gender']);

        return DataTables::of($visits)->make(true);

    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}