<?php


namespace App\Queries;


use Illuminate\Support\Facades\DB;

class GuestsOverEighteen
{
    public function get($month, $day)
    {
        $query = DB::table('guests')
            ->join('visits', 'guests.id', '=', 'visits.guest_id')
            ->whereMonth('time', '=', $month)
            ->when($day != 'all', function ($query) use ($day) {
                return $query->whereRaw("extract(dow from time) = $day");
            })
            ->where('birthday', '<=', date('Y-m-d', strtotime('-18 years')))
            ->count();

        return $query;
    }
}