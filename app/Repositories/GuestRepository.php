<?php

namespace App\Repositories;

use App\Models\Guest;
use App\Models\Guest as Model;
use Yajra\DataTables\DataTables;

class GuestRepository extends CoreRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getForComboBox()
    {
        return $this->startConditions()->all();
    }

    /**
     * @param null $perPage
     * @return mixed
     */
    public function getAllData()
    {
        return DataTables::of(Guest::query())->make(true);
    }
}
