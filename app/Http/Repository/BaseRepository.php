<?php

namespace App\Http\Repository;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    private $app;

    private $model;

    public function __construct(App $app)
    {
        $this->query();
    }

    protected function setInstanceModel($model) 
    {
        $this->model = $model;
    }

    protected function hasFilter($filters, $name)
    {
        return array_key_exists($name, $filters) && $name && $filters[$name] !== null;
    }

    protected function filter($filters, $name, callable $callback)
    {
        if (!$this->hasFilter($filters, $name)) {
            return;
        }

        $callback($filters[$name]);
    }

    public function find($id, $attribute="id", $columns = array('*'))
    {
        return $this->query()
            ->select($columns)
            ->where($attribute, "=", $id)
            ->first();
    }

    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    public function all($columns = array('*'))
    {
        return $this->query()->get($columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute="id")
    {
        $return = $this->model->where($attribute, '=', $id);
        $response = $return->first();
        $return->update($data);

        return $response;
    }

    public function delete($id, $attribute="id")
    {
        $data = $this->model->where($attribute, '=', $id);
        $response = $data->first();
        $data->delete();

        return $response;
    }

    public function query(): Builder
    {
        return $this->model->newQuery();
    }
}