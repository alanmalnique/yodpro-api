<?php

namespace App\Http\Repository;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Http\Repository\BaseRepository;

abstract class Repository extends BaseRepository
{

    private $app;

    private $fqcn;

    public function __construct(App $app)
    {
        $modelFQCN = str_replace('\\Repository\\', '\\Model\\', static::class);

        $this->fqcn =  preg_replace('@Repository$@', '', $modelFQCN);
        $this->app = $app;

        $this->setModel();

        parent::__construct($app);
    }

    public function setModel()
    {
        $model = $this->app->make($this->fqcn);
        
        if (!$model instanceof Model) {
            throw new \RuntimeException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        
        $this->setInstanceModel($model);
    }
}