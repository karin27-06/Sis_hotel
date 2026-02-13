<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Gate;
class RoomWebController extends Controller{
    public function index(): Response{
        Gate::authorize('viewAny', Room::class);
        return Inertia::render('panel/Room/indexRoom');
    }
}
