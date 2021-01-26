<?php

namespace App\Listeners;

use App\Mail\UserMail;
use App\Models\MailUser;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


class MailWasSendListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->data['status']='Enviado';//cambia el status antes de enviarlo 
        MailUser::where("id", $event->data['id'])->update($event->data);// actualiza los valores del correo 
        Mail::to($event->data['email'])->send(New UserMail($event->data));//envia el correo
    }
}
