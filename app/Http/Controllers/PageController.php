<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function index()
    {
        $latest = Post::latest()->take(5)->get();
        return view('pages.index', compact('latest'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function send(Request $request)
    {
        $data = $this->validate($request, [
            'firstname' => 'required|string|max:64',
            'lastname' => 'nullable|string|max:64',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:16',
            'message' => 'required|string|max:512',
        ], [], [
            'firstname' => 'nombre',
            'lastname' => 'apellido',
            'email' => 'correo',
            'phone' => 'teléfono',
            'message' => 'mensaje',
        ]);
        Mail::to('soporte@blockpc.cl')->send(new ContactEmail($data));
        session()->flash('success', 'Mensaje enviado');
        return redirect()->route('contact');
    }
}
