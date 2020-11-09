<?php


namespace App\Queries;


use Illuminate\Support\Facades\DB;

class GuestsMaleUnderTwentyOne
{
    public function get($month, $day)
    {
        $query = DB::table('guests')
            ->join('visits', 'guests.id', '=', 'visits.guest_id')
            ->whereMonth('time', '=', $month)
            ->when($day != 'all', function ($query) use ($day) {
                return $query->whereRaw("extract(dow from time) = $day");
            })
            ->where([
                ['gender', '=', 'мужской'],
                ['birthday', '>', date('Y-m-d', strtotime('-21 years'))]])
            ->count();

        return $query;
    }
}