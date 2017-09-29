<?php

namespace App\Http\Controllers\Nasa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Neo;

class HelloController extends Controller
{
    public function edit()
    {
        return response()->json(['hello' => 'world!']);
    }

    public function editHazardous()
    {
        $neos = Neo::where('is_hazardous', 1)->get();

        return response()->json($neos);
    }

    public function editFastest(Request $request)
    {
        $hazardous = $request->input('hazardous') ?? FALSE;
        $val = 0;
        if ($hazardous == 'true') {
            $val = 1;
        }
        $neo = Neo::where('is_hazardous', $val)
            ->orderBy('speed', 'desc')
            ->take(1)
            ->get();

        return response()->json($neo);
    }
}