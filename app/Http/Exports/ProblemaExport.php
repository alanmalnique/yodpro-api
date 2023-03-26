<?php

namespace App\Http\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProblemaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
            "Usuário",
            "Problema",
            "Local",
            "Status atual",
            "Data de abertura", 
            "Data de fechamento", 
            "Tempo de resolução"
        ];
    }

    public function map($problema): array
    {
        return [
            $problema->usuario->usu_nome,
            $problema->prob_titulo,
            $problema->local->loc_descricao,
            $problema->prob_status === 1 ? 'Aberto' : 'Resolvido',
            date("d/m/Y", strtotime($problema->prob_datahora)),
            $problema->prob_dthrfinalizado ? date("d/m/Y", strtotime($problema->prob_dthrfinalizado)) : '-',
            $problema->prob_status === 2 ? $this->resolveDatas($problema->prob_datahora, $problema->prob_dthrfinalizado) : '-'
        ];
    }

    private function resolveDatas($data1, $data2)
    {
        $date1 = new \DateTime(date('Y-m-d', strtotime($data1)));
        $date2 = new \DateTime(date('Y-m-d', strtotime($data2)));
        $dias = $date1->diff($date2)->days;
        return $dias.($dias < 2 ? ' dia' : 'dias');
    }
}