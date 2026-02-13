<?php

namespace App\Pipelines;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class FilterByState
{
    private array $roomStates = [
        'libre',
        'ocupada',
        'limpieza',
        'mantenimiento',
        'reservado'
    ];

    public function __construct(private $state) {}

    public function __invoke(Builder $builder, Closure $next)
    {
        if (!is_null($this->state)) {

            // Si es array (ej: múltiples estados de habitaciones)
            if (is_array($this->state)) {
                $states = array_intersect($this->state, $this->roomStates);

                if (!empty($states)) {
                    $builder->whereIn('state', $states);
                }

                return $next($builder);
            }

            // Si es string y coincide con estados de habitaciones
            if (is_string($this->state) && in_array($this->state, $this->roomStates)) {
                $builder->where('state', $this->state);
                return $next($builder);
            }

            // Caso original → boolean (para otros módulos del sistema)
            if (filter_var($this->state, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null) {
                $builder->where('state', (bool) $this->state);
            }
        }

        return $next($builder);
    }
}
