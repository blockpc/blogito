<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $user = current_user();
        return view('system.profiles.index', compact('user'));
    }

    public function show(User $user)
    {
        return view('system.profiles.show');
    }

    public function edit_information(Request $request)
    {
        $redirect = url()->previous() . '#user-information';
        $user = current_user();
        $data = Validator::make($request->all(), [
            'firstname' => 'nullable|max:128',
            'lastname' => 'nullable|max:128',
            'phone' => ['nullable', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:8'],
            'name' => 'required|alpha_num|max:32',
            'email' => ['required', Rule::unique('users', 'email')->ignore($user->id)],
        ]);
        if ($data->fails()) {
            return redirect($redirect)->withErrors($data->errors());
        }
        $user->fill($data);
        $user->save();
        $user->profile->fill($data);
        $user->profile->save();
        toastr("La información de perfil fue actualizada", 'success', 'Información de Perfil');
        return redirect()->route('profiles.index')->with("success", "La información de perfil fue actualizada");
    }

    public function change_password(Request $request)
    {
        $redirect = url()->previous() . '#change-password';
        $user = current_user();
        $data = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ], [
            'password.confirmed' => 'Las claves no coinciden'
        ]);
        if ($data->fails()) {
            return redirect($redirect)->withErrors($data->errors());
        }
        $user->update($data);
        toastr("La clave de usuario fue cambiada", 'success', 'Cambio de Clave');
        return redirect()->route('profiles.index')->with("success", "La clave de usuario fue cambiada");
    }

    public function change_image(Request $request)
    {
        $redirect = url()->previous() . '#change-image';
        $user = current_user();
        $data = Validator::make($request->all(), [
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($data->fails()) {
            return redirect($redirect)->withErrors($data->errors());
        }
        if ( $request->file('logo') ) {
            $extension = $request->file('logo')->extension();
            $image = $user->profile->image();
            if ( $image->count() ) {
                $image->delete();
            }
            $path = $request->file('logo')->storeAs("photo_profiles", "{$user->name}.{$extension}", 'public');
            $image->create([
                'name' => $user->name,
                'url' => "/storage/{$path}",
            ]);
            toastr("La imagen del usuario fue actualizada", 'success', 'Cambio de Imagen');
            return redirect()->route('profiles.index')->with("success", "La imagen del usuario fue actualizada");
        } else {
            return redirect($redirect)->with("error", "No se ha subido ninguna imagen");
        }
    }
}
