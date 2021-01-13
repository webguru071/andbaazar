<?php

namespace App\Notifications;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class PhoneVerification extends Notification
{
    protected $entity;
    public function __construct($entity)
    {
        $this->entity = $entity;
    }
    
    public function via($notifiable)
    {
        return [TwilioChannel::class,'database'];
    }
    
    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())->content($notifiable->phone_otp.' is your andbaazar verification code.');
    }

    public function toDatabase(){
        return [
            'token' => $this->entity->phone_otp,
            'user_id' => $this->entity->id,
            'user_type' => $this->entity->type,
            'user_name' => $this->entity->first_name.' '.$this->entity->last_name
        ];
    }
}
