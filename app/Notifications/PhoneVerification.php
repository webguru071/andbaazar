<?php

namespace App\Notifications;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class PhoneVerification extends Notification
{

    protected $entity;
    // protected $entityRef;
    // protected $tokenUrl;
    
    public function __construct($entity)
    {
        $this->entity = $entity;
        // $this->entityRef = $entityRef;
        
        // Get the Token verification URL
        // $this->tokenUrl = (isset($entityRef['slug'])) ? url(config('app.locale') . '/verify/' . $entityRef['slug'] . '/phone') : '';
    }
    
    public function via($notifiable)
    {
        // dd($notifiable);
        // if (!isset($this->entityRef['name'])) {
        //     return false;
        // }
        // echo 'dfa';
        // dd($this->entity);
        return [TwilioChannel::class];
    }
    
    public function toTwilio($notifiable)
    {
        // dd($this->smsMessage());
        return (new TwilioSmsMessage())->content($this->smsMessage());
    }
    
    protected function smsMessage()
    {
        return [
            'appName'  => 'Krishi Baazar',
            'token'    => $this->entity->phone_otp,
            'message'   => 'we care about you...'
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'invoice_id' => 'dd',
            'amount' => 200,
        ];
    }
}
