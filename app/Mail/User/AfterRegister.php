<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterRegister extends Mailable
{
    use Queueable, SerializesModels;
    
    //1. buat global variabel user
    private $user;

    //parameter $user didapat dari Controller
    public function __construct($user)
    {
        //2.mengisi value dari variabe user dengan parameter dari controller
       $this->user = $user;
    }

    public function build()
    {
       
        return $this->subject('Registration on Laracamp')->markdown('emails.user.afterRegister',[
            //3. $user berasal dari global variabel yang value nya berasal dari parameter di __construct()
            'user' => $this->user
        ]);
    }
}
