<?php


namespace App\Queries;


use Illuminate\Support\Facades\DB;

class GuestsFemaleUnderEighteen
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
                ['gender', '=', 'женский'],
                ['birthday', '>', date('Y-m-d', strtotime('-18 years'))]])
            ->count();

        return $query;
    }
//        if ($day == 10) {
//            $query = DB::table('guests')
//                ->join('visits', 'guests.id', '=', 'visits.guest_id')
//                ->whereMonth('time', '=', $month)
//                ->where([
//                    ['gender', '=', 'женский'],
//                    ['birthday', '>', date('Y-m-d', strtotime('-18 years'))]])
//                ->count();
//
//            return $query;
//        } else {
//            $query = DB::table('guests')
//                ->join('visits', 'guests.id', '=', 'visits.guest_id')
//                ->whereMonth('time', '=', $month)
//                ->whereRaw("extract(dow from time) = $day")
//                ->where([
//                    ['gender', '=', 'женский'],
//                    ['birthday', '>', date('Y-m-d', strtotime('-18 years'))]])
//                ->count();
//
//            return $query;
//        }
}