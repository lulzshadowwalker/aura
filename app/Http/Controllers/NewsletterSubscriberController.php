<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    public function store(string $language, Request $request)
    {
        $request->validate(['email' => 'required|email']);

        if (NewsletterSubscriber::where('email', $request->input('email'))->exists()) {
            return redirect()
                ->back()
                ->with('warning', __('app.already-subscribed'));
        }

        //  TODO: We might wanna attach this to the current user
        NewsletterSubscriber::create(['email' => $request->input('email')]);

        return redirect()
            ->back()
            ->with('success', __('app.newsletter-thanks'));
    }
}
