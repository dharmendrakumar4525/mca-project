<?php

namespace App\Jobs;

use App\Mail\OrderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderItemMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $orders = [];
    public $user = [];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orders,$user)
    {

        $this->orders = $orders;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
  
        $email = new OrderMail($this->orders,$this->user);
        Mail::to('danile.dharmendra@ithands.com')->send($email);
    }
}
