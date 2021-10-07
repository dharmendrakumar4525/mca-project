<?php

namespace App\Console\Commands;

use App\Jobs\SentOfferMail as JobsSentOfferMail;
use App\Mail\SentOfferMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CostomerOfferMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:offer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'New User Offer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Started sending emails...');
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new SentOfferMail($user));
        }
        $this->info('Email sent to all the users!');
    }
}
