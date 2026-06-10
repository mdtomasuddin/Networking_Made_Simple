<?php

namespace App\Http\Controllers\Web\V1\User;

use App\Helpers\Helper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('backend.layouts.profile.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $validator->validated();

            // handle avatar
            if ($request->hasFile('avatar')) {
                if (! empty($user->getRawOriginal('avatar'))) {
                    $path = public_path($user->getRawOriginal('avatar'));
                    Helper::fileDelete($path);
                }
                $file = $request->file('avatar');
                $imageName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $data['avatar'] = Helper::fileUpload($file, 'Avatar', $imageName);
            }

            $user->update($data);

            // response
            return redirect()->back()->with('t-success', 'Profile Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function password()
    {
        $user = Auth::user();

        return view('backend.layouts.profile.password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('t-success', 'Password Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong: '.$e->getMessage());
        }
    }
}
