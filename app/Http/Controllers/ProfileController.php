<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
	public function index()
	{
		$dataProfile = Auth::user();
        
		return view('pages.myprofile', compact('dataProfile'));
	}

	public function update(Request $request)
	{
		$usersData = User::findOrFail(Auth::user()->id);
		// Validasi input
		$validated_data_user = $request->validate([
			'name' => 'required|string|max:255',
			'phone_number' => ['required', 'string', 'max:25', Rule::unique('users')->ignore($usersData->id)],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usersData->id)],
			'password' => 'nullable|string|min:8|confirmed',
			'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
			'request-del-profile' => 'nullable|in:true,false'
		]);
		
		
		// Update informasi user
		$usersData->name = $validated_data_user['name'];
		$usersData->phone_number = $validated_data_user['phone_number'];
		$usersData->email = $validated_data_user['email'];
	
		// Handle perubahan password
		if ($request->filled('password')) {
			$usersData->password = Hash::make($validated_data_user['password']);
		}
	
		// Handle penghapusan foto profil
		if ($request->input('request-del-profile') === 'true') {
			if ($usersData->photo) {
				Storage::disk('public')->delete($usersData->photo);
				$usersData->photo = null;
			}
		}
	
		// Handle upload foto profil
		if ($request->hasFile('photo')) {
			// Hapus foto lama jika ada
			if ($usersData->photo) {
				Storage::disk('public')->delete($usersData->photo);
			}
	
			// Simpan foto baru
			$profilePhotoPath = $request->file('photo')->store('profile_photos', 'public');
			$usersData->photo = $profilePhotoPath;
		}
	
		// Simpan perubahan
		$usersData->save();
	
		// Redirect kembali dengan pesan sukses
		return redirect()->back()->with('message', 'Profile updated successfully');
	}
	
}
