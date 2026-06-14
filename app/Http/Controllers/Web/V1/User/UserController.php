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
            //Get the authenticated user
            $user = Auth::user();

            // validate the request
            $validator = Validator::make($request->all(), [
                'first_name' => 'nullable|string|max:255',
                'last_name'  => 'nullable|string|max:255',
                'email'      => 'required|email|unique:users,email,' . $user->id,
                'phone'      => 'nullable|string|max:20',
                'location'   => 'nullable|string|max:500',
                'avatar'     => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB
            ]);

            // if validation fails
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // get validated data
            $data = $validator->validated();

            // handle avatar
            if ($request->hasFile('avatar')) {
                if (! empty($user->getRawOriginal('avatar'))) {
                    Helper::deleteFile($user->getRawOriginal('avatar'));
                }
                $file           = $request->file('avatar');
                $data['avatar'] = Helper::uploadFile($file, 'Avatar');
            }
            // update user
            $user->update($data);

            // response
            return redirect()->back()->with('t-success', 'Profile Updated Successfully');
        } catch (Exception $e) {
            // response on error
            return redirect()->back()->with('t-error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        $user = Auth::user();
        return view('backend.layouts.profile.password', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        try {
            //Get the authenticated user
            $user = Auth::user();

            // validate the request
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8|confirmed',
            ]);

            // if validation fails
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // update password
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // response on success
            return redirect()->back()->with('t-success', 'Password Updated Successfully');
        } catch (Exception $e) {
            // response on error
            return redirect()->back()->with('t-error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
