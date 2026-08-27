<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        return view('admin.contact-messages.show', compact('message'));
    }

    public function destroy($id)
    {
        ContactMessage::findOrFail($id)->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
