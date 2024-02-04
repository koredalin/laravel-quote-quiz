<?php

namespace App\Http\Controllers;

use App\Models\GuestUser;

class GuestUserController extends Controller
{
    public function index()
    {
        $recordsPerPagination = 8;
        $results = GuestUser::orderByDesc('total_score')
            ->orderBy('duration')
            ->paginate($recordsPerPagination);
        $title = 'Famous Quote Quiz';

        return view('guest_users.index', compact(
            'results',
            'title')
        );
    }

    public function indexAdmin()
    {
        $recordsPerPagination = 8;
        $results = GuestUser::orderByDesc('total_score')
            ->orderBy('duration')
            ->paginate($recordsPerPagination);
        $title = 'Famous Quote Quiz';

        return view('guest_users.index_admin', compact(
            'results',
            'title')
        );
    }
}
