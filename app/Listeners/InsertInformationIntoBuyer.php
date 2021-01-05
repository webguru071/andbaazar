<?php

namespace App\Listeners;

use App\Events\CustomerRegistration;
use App\Models\CustomerProfile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InsertInformationIntoBuyer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CustomerRegistration  $event
     * @return void
     */
    public function handle(CustomerRegistration $event)
    {
        // dd($event->customer);
        $data = [
            'user_id'   => $event->customer->id,
            'full_name'      => $event->customer->first_name.' '.$event->customer->last_name,
        ];
        CustomerProfile::create($data);
    }
}
