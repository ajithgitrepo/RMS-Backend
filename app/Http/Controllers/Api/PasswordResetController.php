<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\User;
use App\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Passwords\PasswordBroker;

class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function forgot_password(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We can`t find a user with that e-mail address.'
            ], 404);

        //$token = Str::random(60);

        //$hash_token = Hash::make($token);

        // insert a token record into the password reset table
        $token = app(PasswordBroker::class)->createToken($user);

        //dd($token);

        $hash_token = Hash::make($token);

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => $token
             ]
        );
        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($token, $passwordReset->email)
            );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }
    
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return response()->json($passwordReset);
    }
   
    public function reset_password(Request $request)
    {
        //dd('working..');
    	//dd($request->email);

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);

       // $passwordReset = PasswordReset::where('token', $request->token)->where('email', $request->email)->first();

        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We can`t find a user with that e-mail address.'
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));

       // return redirect()->route('home')->withStatus(__('Password reset successfully.'));

        return response()->json($user);
    }
}