<?php
/**
 * Created by PhpStorm.
 * User: rasez
 * Date: 8/7/20
 * Time: 4:18 PM
 */

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\ResetPasswordRepositoryInterface;
use App\PasswordReset;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ResetPasswordRepository implements ResetPasswordRepositoryInterface
{
    /**
     * @param $request
     * @return PasswordReset
     */
    public function makeToken($request): PasswordReset
    {
        $token = Str::random(60);

        $passwordReset = new PasswordReset();
        $passwordReset->email = $request->email;
        $passwordReset->token = $token;
        $passwordReset->save();
        return $passwordReset;
    }

    /**
     * @param $request
     * @return PasswordReset
     */
    public function checkToken($request): PasswordReset
    {
        return PasswordReset::where(['email' => $request->email, 'token' => $request->token])->first();
    }

    /**
     * @param $request
     */
    public function resetPassword($request): void
    {
        //update password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        PasswordReset::where(['email' => $request->email])->delete();
    }
}
