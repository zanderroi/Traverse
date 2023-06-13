<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $carOwnerName;
    public $carBrand;
    public $carModel;
    public $customerName;

    /**
     * Create a new message instance.
     *
     * @param string $carOwnerName
     * @param string $carBrand
     * @param string $carModel
     * @param string $customerName
     */
    public function __construct($carOwnerName, $carBrand, $carModel, $customerName)
    {
        $this->carOwnerName = $carOwnerName;
        $this->carBrand = $carBrand;
        $this->carModel = $carModel;
        $this->customerName = $customerName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.booking_confirmation')
            ->subject('Booking Confirmation');
    }
}
