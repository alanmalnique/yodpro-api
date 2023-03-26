<?php

namespace App\Http\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FaleConoscoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contato recebido (YodPro Website)')
                    ->view('emails.fale_conosco')
                    ->with([
                        'nome' => $this->data['nome'],
                        'condominio' => $this->data['condominio'],
                        'whatsapp' => $this->data['whatsapp'],
                        'mensagem' => $this->data['mensagem']
                    ]);
    }
}
