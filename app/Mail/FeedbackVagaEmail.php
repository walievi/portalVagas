<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Email;

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
         $template = Email::where('template', 'retorno_candidato')->first();
     
         // Substituir as variáveis no conteúdo do template
         $content = str_replace(['{{ $titulo }}', '{{ $unidade }}', '{{ $feedbackTexto }}'], [$this->titulo, $this->unidade, $this->feedbackTexto], $template->conteudo);
     
         $subject = 'Retorno candidatura de vaga: ' . $this->titulo;
     
         return $this->html($content)
                     ->subject($subject)
                     ->with([
                         'titulo' => $this->titulo,
                         'unidade' => $this->unidade,
                         'feedbackTexto' => $this->feedbackTexto,
                     ]);
     }
     
     
}