<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Gate;

class RoomTypeWebController extends Controller
{
    public function index(): Response
    {
        Gate::authorize('viewAny', RoomType::class);
        return Inertia::render('panel/RoomType/indexRoomType');
    }
}
