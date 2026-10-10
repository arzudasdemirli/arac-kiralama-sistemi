<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    // Kullanıcıdan gelen mesajı kaydetme
   public function store(Request $request)
{
    $request->validate([
        'ad_soyad' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'konu' => 'required|string|max:255',
        'mesaj' => 'required|string',
    ]);

    Message::create([
        'ad_soyad' => $request->ad_soyad,
        'email' => $request->email,
        'konu' => $request->konu,
        'mesaj' => $request->mesaj,
        'read' => 0,
    ]);

    return back()->with('success', 'Mesajınız gönderilmiştir.');
}


    // Admin - Mesajları listeleme
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', compact('messages'));
    }

    // Admin - Tek bir mesajı görüntüleme ve okundu olarak işaretleme
    public function show($id)
    {
        $message = Message::findOrFail($id);

        if (!$message->read) {
            $message->update(['read' => 1]);
        }

        return view('admin.messages.show', compact('message'));
    }

    // Admin - Mesajı silme
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Mesaj silindi.');
    }

    // Admin - Mesaja cevap verme
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $message = Message::findOrFail($id);
        $message->update([
            'reply' => $request->reply,
            'replied_at' => now(),
        ]);

        return redirect()->route('admin.messages.show', $id)->with('success', 'Mesaja cevap gönderildi.');
    }
}
