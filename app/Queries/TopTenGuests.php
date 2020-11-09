<?php


namespace App\Queries;


use Illuminate\Support\Facades\DB;

class TopTenGuests
{
    public function get($month, $day)
    {
        $query = DB::table('guests')
            ->select('name as result')
            ->join('visits', 'guests.id', '=', 'visits.guest_id')
            ->whereMonth('time', '=', $month)
            ->when($day != 'all', function ($query) use ($day) {
                return $query->whereRaw("extract(dow from time) = $day");
            })
            ->groupBy('guests.id')
            ->orderByRaw('COUNT(name) DESC')
            ->take(10)
            ->get();

        return $query;
    }
}