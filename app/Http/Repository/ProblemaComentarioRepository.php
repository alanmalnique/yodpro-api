<?php

namespace App\Http\Repository;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;

class ProblemaComentarioRepository extends Repository
{
    private function applyFilters(Builder $query, array $filters = null)
    {
        if (!$query) {
            $query = $this->query();
        }

        if ($filters === null) {
            return $query;
        }

        $this->filter($filters, "id", function ($value) use ($query) {
            $query->where("prob_id", "=", $value);
        });

        return $query;
    }

    public function exportItems(array $filters = null){
        $query = $this->query()
            ->with(['problema' => function($problema) {
                $problema->with(['local']);
            }, 'usuario']);
        return $this->applyFilters($query, $filters)
            ->get();
    }
}