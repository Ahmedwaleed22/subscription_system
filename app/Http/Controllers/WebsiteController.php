<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionResource;
use App\Http\Resources\WebsitePostsResource;
use App\Http\Resources\WebsiteResource;
use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function all() {
        $websites = Website::all();
        return response()->json(WebsiteResource::collection($websites));
    }

    public function show(Website $website) {
        return response()->json(new WebsitePostsResource($website));
    }

    public function subscribe(Request $request, $websiteID) {
        $request->validate([
            'email' => 'required|email',
        ]);

        Website::findOrFail($websiteID);
        $subscription = Subscription::firstOrCreate([
            'email' => $request->email,
            'website_id' => $websiteID,
        ]);

        return response()->json(new SubscriptionResource($subscription));
    }
}
