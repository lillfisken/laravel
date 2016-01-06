<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-12-27
 * Time: 20:36
 */

namespace market\Http\Controllers\account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use market\Http\Controllers\Controller;
use market\Http\Requests\settings\changePasswordRequest;

class changePasswordController extends Controller
{
    public function newPassword()
    {
        return view('account.settings.newPassword', ['user' => Auth::user()]);
    }

    public function newPasswordPost(changePasswordRequest $request )
    {
        //TODO: Move password verification to custom rule in request

        if(Hash::check($request->input('pswdOld'), Auth::user()->password))
        {
            //User entered correct password
            $user = Auth::user();
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return redirect()->route('accounts.settings.password')->withMessage('Lösenord ändrat');
        }
        else
        {
            return redirect()->back()->with('pswdOld' , 'Fel lösenord');
        }
    }
}