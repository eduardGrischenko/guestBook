<?php

namespace App\Http\Controllers\Guestbook;


use App\Queries\GuestsFemaleUnderEighteen;
use App\Queries\GuestsMaleUnderTwentyOne;
use App\Queries\GuestsOverEighteen;
use App\Queries\GuestsUniqueNames;
use App\Queries\TopTenAges;
use App\Queries\TopTenGuests;
use Illuminate\Http\Request;


class StatisticController extends BaseController
{
    public function getForm()
    {
        return view('guestbook.statistic.index');
    }

    public function getResult(Request $request)
    {
        $data = $request->input();

        $guestsUniqueNames = (new GuestsUniqueNames())->get($data['month'], $data['day']);
        $guestsOverEighteen = (new GuestsOverEighteen)->get($data['month'], $data['day']);
        $guestsMaleUnderTwentyOne = (new GuestsMaleUnderTwentyOne)->get($data['month'], $data['day']);
        $guestsFemaleUnderEighteen = (new GuestsFemaleUnderEighteen)->get($data['month'], $data['day']);
        $topTenGuests = (new TopTenGuests)->get($data['month'], $data['day']);
        $topTenAges = (new TopTenAges)->get($data['month'], $data['day']);

        return response()->json([
            'guestsOverEighteen' => $guestsOverEighteen,
            'guestsUniqueNames' => $guestsUniqueNames,
            'guestsMaleUnderTwentyOne' => $guestsMaleUnderTwentyOne,
            'guestsFemaleUnderEighteen' => $guestsFemaleUnderEighteen,
            'topTenGuests' => $topTenGuests,
            'topTenAges' => $topTenAges
        ]);

    }
}







