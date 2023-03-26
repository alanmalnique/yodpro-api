<?php

namespace App\Http\Repository;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;

class ProblemaRepository extends Repository
{
    private function applyFilters(Builder $query, array $filters = null)
    {
        if (!$query) {
            $query = $this->query();
        }

        if ($filters === null) {
            return $query;
        }

        $this->filter($filters, "status", function ($value) use ($query) {
            $query->where("prob_status", "=", $value);
        });

        $this->filter($filters, "local", function ($value) use ($query) {
            $query->where("loc_id", "=", $value);
        });

        $this->filter($filters, "id", function ($value) use ($query) {
            $query->where("prob_id", "LIKE", "%".$value."%");
        });

        $this->filter($filters, "data_inicio", function ($value) use ($query) {
            $query->where("prob_datahora", ">=", $value);
        });

        $this->filter($filters, "data_fim", function ($value) use ($query) {
            $query->where("prob_datahora", "<=", $value);
        });

        return $query;
    }

    public function list(array $filters = null, $perPage = 20)
    {
        $query = $this->applyFilters($this->query(), $filters)
            ->with(['local']);

        if($perPage == -1){
            $perPage = $query->count();
        }
        return $query->paginate($perPage);
    }

    public function exportItems(array $filters = null){
        $query = $this->query()
            ->with(['usuario', 'local']);
        return $this->applyFilters($query, $filters)
            ->get();
    }
}