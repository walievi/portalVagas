<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Email;



class NovoRegistroEmail extends Mailable
{
    public $vaga;
    public $unidade;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vaga, $unidade)
    {
        $this->vaga = $vaga;
        $this->unidade = $unidade;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = Email::where('template', 'abertura_vaga')->first();
        $content = str_replace(['{{ $titulo }}', '{{ $unidade }}'], [$this->vaga, $this->unidade], $template->conteudo);

        $subject = 'Notificação de Abertura de Vaga: ' . $this->vaga;

        return $this->html($content)
        ->subject($subject)
        ->with([
            'titulo' => $this->vaga,
            'unidade' => $this->unidade,
        ]);

    }




}
