<?php

namespace App\Jobs;

use App\Mail\PostEmail;
use App\Models\NotifiedPost;
use App\Models\NotifiedPosts;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subscriptions;

    /**
     * Create a new job instance.
     */
    public function __construct($subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->subscriptions as $subscription) {
            $email = $subscription->email;
            $website = $subscription->website;
            $posts = $website->posts;

            $unNotifiedPosts = [];

            foreach ($posts as $post) {
                $notifiedPostsExists = NotifiedPost::where('post_id', $post->id)
                            ->where('subscription_id', $subscription->id)
                            ->exists();

                if (!$notifiedPostsExists) {
                    array_push($unNotifiedPosts, $post);
                    NotifiedPost::create([
                        'post_id' => $post->id,
                        'subscription_id' => $subscription->id,
                    ]);
                }
            }

            if (count($unNotifiedPosts)) {
                $data = [
                    'website' => $website,
                    'posts' => $unNotifiedPosts,
                ];
    
                Mail::to($email)->send(new \App\Mail\PostEmail($data));
            }
        }
    }
}
