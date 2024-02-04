<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuestUser;

class HomeController extends Controller
{
    public function index()
    {
        $recordsPerPagination = 8;
        $results = GuestUser::orderByDesc('total_score')
            ->orderBy('duration')
            ->paginate($recordsPerPagination);
        $title = 'Famous Quote Quiz';

        return view('welcome', compact(
            'results',
            'title')
        );
    }
}
