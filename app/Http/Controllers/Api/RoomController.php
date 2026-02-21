<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exports\CustomersExport;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Cliente\StoreCustomerRequest;
use App\Http\Requests\Cliente\UpdateCustomerRequest;
use App\Http\Requests\Habitacion\StoreRoomRequest;
use App\Http\Requests\Habitacion\UpdateRoomRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\RoomResource;
use App\Models\Customer;
use App\Models\Room;
use App\Pipelines\FilterByName;
use App\Pipelines\FilterByState;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Pipelines\FilterByCodigo;
use App\Pipelines\FilterByNumber;
use Maatwebsite\Excel\Excel as ExcelFormat;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Room::class);
        $perPage = $request->input('per_page', 15);
        $search = $request->input('search');
        $query = app(Pipeline::class)
            ->send(Room::query())
            ->through([
                new FilterByNumber($search),
                new FilterByState($request->input('state')),
            ])
            ->thenReturn();

        return RoomResource::collection($query->paginate($perPage));
    }
    public function store(StoreRoomRequest $request)
    {
        Gate::authorize('create', Room::class);
        $validated = $request->validated();
        $room = Room::create($validated);
        return response()->json([
            'state' => true,
            'message' => 'Habitación registrada correctamente.',
            'room' => $room
        ]);
    }
    public function show(Room $room)
    {
        Gate::authorize('view', $room);
        return response()->json([
            'status' => true,
            'message' => 'Habitación encontrada',
            'room' => new RoomResource($room)
        ]);
    }
    public function update(UpdateRoomRequest $request, Room $room)
    {
        Gate::authorize('update', $room);
        $validated = $request->validated();
        $room->update($validated);
        return response()->json([
            'state' => true,
            'message' => 'Habitación actualizada correctamente.',
            'room' => $room->refresh()
        ]);
    }
    public function destroy(Room $room)
    {
        Gate::authorize('delete', $room);
        /*if (
            $room->tieneRelaciones()
        ) {
            return response()->json([
                'state' => false,
                'message' => 'No se puede eliminar esta habitación porque está relacionada con otros registros.'
            ], 400);
        }*/
        $room->delete();
        return response()->json([
            'state' => true,
            'message' => 'Habitación eliminada correctamente'
        ]);
    }
    #EXPORTACION
    /*public function exportCsv()
    {
        return Excel::download(new CustomersExport, 'Clientes.csv', ExcelFormat::CSV);
    }*/
}
