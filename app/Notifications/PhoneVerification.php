<?php

namespace App\Notifications;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Channels\SmsChannel;
// use NotificationChannels\Twilio\TwilioChannel;
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
        // return [TwilioChannel::class,'database'];
        return [SmsChannel::class];
    }
    
    public function toSms($notifiable){
        $notifiable->phone_no_verified_at = null;
        $notifiable->phone_otp = rand(10000,99999);
        $notifiable->phone_otp_expired_at = Carbon::now()->addMinute();
        $notifiable->save();
        // send sms here...

    }

    // public function toTwilio($notifiable){
    //     dd()
    //     //return (new TwilioSmsMessage())->content($notifiable->phone_otp.' is your andbaazar verification code.');
    // }

    // public function toDatabase(){
    //     return [
    //         'token' => $this->entity->phone_otp,
    //         'user_id' => $this->entity->id,
    //         'user_type' => $this->entity->type,
    //         'user_name' => $this->entity->first_name.' '.$this->entity->last_name
    //     ];
    // }
}
