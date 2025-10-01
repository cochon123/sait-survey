<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JoinApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $program;
    public $competence;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $program
     * @param string|null $competence
     * @return void
     */
    public function __construct($name, $program, $competence = null)
    {
        $this->name = $name;
        $this->program = $program;
        $this->competence = $competence;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('SAIT-Survey-Application')
                    ->view('emails.join-application')
                    ->with([
                        'name' => $this->name,
                        'program' => $this->program,
                        'competence' => $this->competence,
                    ]);
    }
}