<?php

namespace App\Http\Service\Mensageria;

use App\Http\Interfaces\MensageriaInterface;

class MensageriaService
{
    protected $service;

    public function __construct(MensageriaInterface $service)
    {
        $this->service = $service;
    }

    public function send($data)
    {       
        $result = $this->service->send($data);

        return response()->json($result);
    }

}
