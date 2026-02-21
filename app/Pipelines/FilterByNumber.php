<?php

namespace App\Pipelines;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class FilterByNumber
{
    public function __construct(private ?string $search) {}

    public function __invoke(Builder $builder, Closure $next)
    {
        if (!$this->search) {
            return $next($builder);
        }

        $normalized = strtolower(trim(preg_replace('/\s+/', ' ', $this->search)));
        $terms = explode(' ', $normalized);

        $builder->where(function ($q) use ($terms) {
            foreach ($terms as $term) {
                $q->orWhere('number', 'ILIKE', "%{$term}%");
            }
        });

        return $next($builder);
    }
}