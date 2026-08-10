<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('leader.contact.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('leader.contact.show', compact('contact'));
    }

    public function reply($id)
    {
        $contact = Contact::findOrFail($id);

        if ($contact->replied_at) {
            return redirect()->route('leader.contacts.show', $contact->id)
                ->with('error', 'This message has already been replied to.');
        }

        return view('leader.contact.reply', compact('contact'));
    }

    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'reply_message' => 'required|string|min:10|max:5000',
        ]);

        $contact = Contact::findOrFail($id);

        $contact->update([
            'reply_message' => $request->reply_message,
            'replied_at' => now(),
            'replied_by' => Auth::id(),
        ]);

        return redirect()->route('leader.contacts.index')
            ->with('success', 'Reply sent successfully to ' . $contact->email);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('leader.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
