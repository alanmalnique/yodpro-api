<?php

namespace App\Http\Repository;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;

class LocaisRepository extends Repository
{
    private function applyFilters(Builder $query, array $filters = null)
    {
        if (!$query) {
            $query = $this->query();
        }

        if ($filters === null) {
            return $query;
        }

        // $this->filter($filters, "", function ($value) use ($query) {
        //     $query->where("", "=", $value);
        // });

        return $query;
    }

    public function list(array $filters = null, $perPage = 20)
    {
        $query = $this->applyFilters($this->query(), $filters);

        if($perPage == -1){
            $perPage = $query->count();
        }
        return $query->paginate($perPage);
    }
}