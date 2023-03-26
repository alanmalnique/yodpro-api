<?php

namespace App\Http\Service\Mensageria\Adapter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Mail\FaleConoscoMail;

use App\Http\Interfaces\MensageriaInterface;

class EmailAdapter implements MensageriaInterface
{

	/**
	 * @param string 'template'
	 * @param string 'para'
	 * @param array 'dados'
	 */
    public function send($data)
    {
    	switch($data['template']){
    		case 'fale_conosco':
    			$send = Mail::to($data['para']);
                if(isset($data['cc']) && count($data['cc']) > 0)
                    $send->cc($data['cc']);
                $send->send(new FaleConoscoMail($data['dados']));
    		break;
    	}
    	return array("erro"=>false);
    }

}

