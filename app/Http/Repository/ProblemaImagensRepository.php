<?php

namespace App\Http\Repository;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;

class ProblemaImagensRepository extends Repository
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
}