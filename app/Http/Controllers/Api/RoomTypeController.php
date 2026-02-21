<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exports\RoomTypesExport;
//use App\Imports\RoomTypeImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\TipoHabitacion\StoreRoomTypeRequest;
use App\Http\Requests\TipoHabitacion\UpdateRoomTypeRequest;
use App\Http\Resources\RoomTypeResource;
use App\Models\RoomType;
use App\Pipelines\FilterByName;
use App\Pipelines\FilterByState;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class RoomTypeController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', RoomType::class);
        $perPage = $request->input('per_page', 15);
        $search = $request->input('search');

        $query = app(Pipeline::class)
            ->send(RoomType::query())
            ->through([
                new FilterByName($search),
                new FilterByState($request->input('state')),
            ])
            ->thenReturn();

        return RoomTypeResource::collection($query->paginate($perPage));
    }

    public function store(StoreRoomTypeRequest $request)
    {
        Gate::authorize('create', RoomType::class);
        $validated = $request->validated();
        $roomtype = RoomType::create($validated);

        return response()->json([
            'state' => true,
            'message' => 'Tipo de habitacion registrado correctamente.',
            'roomtype' => $roomtype,
        ]);
    }

    public function show(RoomType $roomtype)
    {
        Gate::authorize('view', $roomtype);
        return response()->json([
            'state' => true,
            'message' => 'Tipo de habitacion encontrado',
            'roomtype' => new RoomTypeResource($roomtype),
        ]);
    }

    public function update(UpdateRoomTypeRequest $request, RoomType $roomtype)
    {
        Gate::authorize('update', $roomtype);
        $validated = $request->validated();
        $roomtype->update($validated);

        return response()->json([
            'state' => true,
            'message' => 'Tipo de habitacion actualizado correctamente.',
            'roomtype' => $roomtype->refresh(),
        ]);
    }

    public function destroy(RoomType $roomtype)
    {
        Gate::authorize('delete', $roomtype);
        if($roomtype->tieneRelaciones())
        {
            return response()->json([
                'state'=>false,
                'message'=> 'No se puede eliminar este tipo de habitacion porque tiene relaciones con otros registros.'
            ],400);
        }//PONER AQUI LAS RELACIONES QUE EXISTEN CON OTROS MODELOS
        $roomtype->delete();
        return response()->json([
            'state' => true,
            'message' => 'Tipo de habitacion eliminado correctamente.',
        ]);
    }

    # EXPORTACION
    public function exportExcel()
    {
        set_time_limit(0);
        return Excel::download(new RoomTypesExport, 'Tipos de habitacion.xlsx');
    }
}
