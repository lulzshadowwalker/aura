<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Faq;
use App\Models\SupportMessage;

class ContactController extends Controller
{
    public function index()
    {
        $faqs = Faq::select('question', 'answer')->get();

        return view('contact.index', compact('faqs'));
    }

    public function store(string $language, StoreContactRequest $request)
    {
        SupportMessage::create([
            ...$request->validated(),
            'customer_id' => auth()->id(),
        ]);

        return redirect()
            ->route('contact.index', ['language' => $language])
            ->with('success', 'Message sent successfully');
    }
}
