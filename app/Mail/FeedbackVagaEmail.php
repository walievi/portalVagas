<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class FeedbackVagaEmail extends Mailable
{
    public $vaga;
    public $unidade;
    public $titulo;
    public $feedbackTexto;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($titulo, $unidade, $feedbackTexto)
    {
        $this->titulo = $titulo;
        $this->unidade = $unidade;
        $this->feedbackTexto = $feedbackTexto;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */


    public function build()
    {
        $subject = 'Retorno candidatura de vaga: ' . $this->titulo;

        return $this->view('email.retornocandidato')
                    ->subject($subject) // Defina o assunto do email aqui
                    ->with(['titulo' => $this->titulo,
                        // Outros dados da vaga que você deseja incluir na view
                    ])
                    ->with(['unidade' => $this->unidade,
                        // Outros dados da vaga que você deseja incluir na view
                    ])
                    ->with(['feedbackTexto' => $this->feedbackTexto,
                        // Outros dados da vaga que você deseja incluir na view
                    ])
                    ;

    }
}