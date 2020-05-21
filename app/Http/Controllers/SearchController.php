<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        if(!$query = $request->get('query'))
        {
            return redirect()->route('home');
        }

        $users = User::where(DB::raw("CONCAT (first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
        ->orWhere('username', 'LIKE', "%{$query}%")->get();

        return view('search.results', ['users' => $users]);
    }
}
