<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = auth()->user();

        // Apagar avatar antigo
        if ($user->avatar) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
        }

        // Guardar novo avatar
        $filename = uniqid('user_') . '.' . $request->avatar->extension();

        $request->avatar->storeAs(
            'avatars',
            $filename,
            'public'
        );

        $user->update([
            'avatar' => $filename,
        ]);

        return back()->with('success', 'Avatar atualizado com sucesso.');
    }
}
