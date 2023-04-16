<?php

namespace App\Console\Commands;

use App\Jobs\NotifyUsersJob;
use App\Models\Subscription;
use Illuminate\Console\Command;

class NotifyUsersAboutNewPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users about new posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
            [1] => Get all the subscriptions
            [2] => Loop all the subscriptions
            [3] => Get all subscripted website posts
            [4] => Loop all posts to check if notified before
        */

        $subscriptions = Subscription::all();
        dispatch((new NotifyUsersJob($subscriptions))->onQueue('high'));
    }
}
