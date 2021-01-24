<?php

namespace App\Notifications;

use App\Mail\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;

class EmailVerification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $email_verification_code = Str::random(60);
        $notifiable->email_verified_at = null;
        $notifiable->email_verification_code = $email_verification_code;
        $notifiable->email_verification_code_expired_at = Carbon::now()->addDays(2);
        $notifiable->save();
        $emailData['user_name']=$notifiable->first_name .' '.$notifiable->last_name;
        $emailData['verificationURL']=env('APP_URL') .'/email/verify/' .$notifiable->id .'/' .$email_verification_code;
        return (new VerifyEmail($emailData))->to($notifiable->email);
    }
}
