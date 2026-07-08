<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'profiles' => Profile::where('user_id', $request->user()->id)->get(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function setActiveProfile(Request $request): RedirectResponse
    {
        $request->validate(['profile_id' => 'required|exists:profiles,id']);
        $profile = Profile::findOrFail($request->profile_id);
        abort_if($profile->user_id !== auth()->id(), 403);
        session(['active_profile_id' => $profile->id]);
        return redirect()->back()->with('success', 'Profil aktif: ' . $profile->nama);
    }

    public function manage(Request $request): View
    {
        $profiles = Profile::where('user_id', $request->user()->id)->get();
        return view('profile.manage', compact('profiles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'npwp' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:16',
            'ptkp_status' => 'nullable|string|in:TK0,K0,K1,K2,K3',
            'pekerjaan' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'is_default' => 'nullable|boolean',
        ]);

        $validated['user_id'] = auth()->id();

        if (!empty($validated['is_default'])) {
            Profile::where('user_id', auth()->id())->where('is_default', true)->update(['is_default' => false]);
        }

        Profile::create($validated);

        return redirect()->route('profile.manage')->with('success', 'Profil berhasil ditambahkan');
    }

    public function updateProfile(Request $request, Profile $profile): RedirectResponse
    {
        abort_if($profile->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'npwp' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:16',
            'ptkp_status' => 'nullable|string|in:TK0,K0,K1,K2,K3',
            'pekerjaan' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'is_default' => 'nullable|boolean',
        ]);

        if (!empty($validated['is_default'])) {
            Profile::where('user_id', auth()->id())->where('is_default', true)->where('id', '!=', $profile->id)->update(['is_default' => false]);
        }

        $profile->update($validated);

        return redirect()->route('profile.manage')->with('success', 'Profil berhasil diperbarui');
    }

    public function destroyProfile(Profile $profile): RedirectResponse
    {
        abort_if($profile->user_id !== auth()->id(), 403);
        $profile->delete();
        return redirect()->route('profile.manage')->with('success', 'Profil berhasil dihapus');
    }
}
