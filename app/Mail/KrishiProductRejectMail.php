<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KrishiProductRejectMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $name;
    public $rej_desc;
    public function __construct($data,$name,$rej_desc)
    {
        $this->data = $data;
        $this->name = $name;
        $this->rej_desc = $rej_desc;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.emails.KrishiProductReject',['data'=>$this->data,'name'=>$this->name,'rej_desc'=>$this->rej_desc]);
    }
}
