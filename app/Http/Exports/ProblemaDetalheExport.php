<?php

namespace App\Http\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProblemaDetalheExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private $repository;
    protected $request;

    public function __construct($repository, $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    public function collection()
    {
        return $this->repository->exportItems($this->request);
    }

    public function headings(): array
    {
        return [
            "Problema",
            "Local",
            "Usuário que comentou",
            "Comentário",
            "Data do comentário"
        ];
    }

    public function map($problema): array
    {
        return [
            $problema->problema->prob_titulo,
            $problema->problema->local->loc_descricao,
            $problema->usuario->usu_nome,
            $problema->probc_comentario,
            date("d/m/Y", strtotime($problema->probc_datahora))
        ];
    }
}