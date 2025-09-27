<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Guardar mensaje en BD
        $message = Message::create($data);

        // Enviar correo
        Mail::raw($data['message'], function ($mail) use ($data) {
            $mail->to('softsolution.eu.software@gmail.com')
                 ->subject("Nuevo mensaje de contacto: {$data['name']}")
                 ->from($data['email'], $data['name']);
        });

        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }
}
