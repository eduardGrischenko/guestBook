<?php


namespace App\Queries;


use Illuminate\Support\Facades\DB;

class TopTenAges
{
    public function get($month, $day)
    {
        $query = DB::table('guests')
            ->selectRaw("date_part('year', age(birthday)) as result")
            ->join('visits', 'guests.id', '=', 'visits.guest_id')
            ->whereMonth('time', '=', $month)
            ->when($day != 'all', function ($query) use ($day) {
                return $query->whereRaw("extract(dow from time) = $day");
            })
            ->groupBy('result')
            ->orderByRaw("COUNT(distinct name) DESC")
            ->take(10)
            ->get();

        return $query;
    }
}