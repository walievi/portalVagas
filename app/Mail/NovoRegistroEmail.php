<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;




class NovoRegistroEmail extends Mailable
{
    public $vaga;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vaga)
    {
        $this->vaga = $vaga;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Notificação de Abertura de Vaga: ' . $this->vaga;

        return $this->view('email.marketing')
                    ->subject($subject) // Defina o assunto do email aqui
                    ->with(['titulo' => $this->vaga,
                        // Outros dados da vaga que você deseja incluir na view
                    ]);
    }




}
