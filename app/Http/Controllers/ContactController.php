<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\SupportMessage;
use function PHPUnit\Framework\returnArgument;

class ContactController extends Controller
{
    public function index()
    {
        return view("contact.index");
    }

    public function store(StoreContactRequest $request)
    {
        SupportMessage::create([
            ...$request->validated(),
            "customer_id" => auth()->id(),
        ]);

        return redirect()
            ->route("contact.index")
            ->with("success", "Message sent successfully");
    }
}
