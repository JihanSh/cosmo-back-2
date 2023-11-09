<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Mail;
use Illuminate\Database\QueryException;

use App\Mail\SendMail;

class UserAuth extends Controller
{
    public function register(Request $request)
    {
        $email = $request->input('email');

        if (UserModel::where('email', $email)->exists()) {
            return response()->json(['error' => 'Email already in use'], 422);
        }

        $user = new UserModel;

        $user->email = $email;
        $user->Password = $request->input('Password');
        $user->FirstName = $request->input('FirstName');
        $user->LastName = $request->input('LastName');
        $user->gender = $request->input('gender');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->apartment = $request->input('apartment');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->zip_code = $request->input('zip_code');

        $user->save();

        return response()->json(['message' => 'Registration successful', 'user' => $user], 201);
    }




    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('Password');

        if (empty($email) || empty($password)) {
            return response()->json(['error' => 'Email and password are required.'], 400);
        }

        $user = UserModel::where('email', $email)->where('Password', $password)->first();

        if ($user) {
            $token = $user->createToken('YourAppToken')->accessToken;

            return response()->json(['message' => 'Login successful', 'user' => $user, 'token' => $token], 200);
        }

        return response()->json(['error' => 'Invalid email or password. Please try again.'], 401);
    }



    public function getUserById($id)
    {
        $user = UserModel::find($id);

        if ($user) {
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
    public function getAllUsers()
    {
        $users = UserModel::all();

        return response()->json(['users' => $users], 200);
    }


    public function updateUser(Request $request, $userId)
    {
        $user = UserModel::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->FirstName = $request->input('FirstName', $user->FirstName);
        $user->LastName = $request->input('LastName', $user->LastName);
        $user->gender = $request->input('gender', $user->gender);
        $user->phone_number = $request->input('phone_number', $user->phone_number);
        $user->address = $request->input('address', $user->address);
        $user->apartment = $request->input('apartment', $user->apartment);
        $user->country = $request->input('country', $user->country);
        $user->city = $request->input('city', $user->city);
        $user->zip_code = $request->input('zip_code', $user->zip_code);

        $user->save();

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user], 200);
    }



    public function deleteUser($id)
    {
        $user = UserModel::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'User Logout successfully'], 200);
    }

    public function sendResetLink(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        $email = $request->input('email');
        dd($email); // Debug to check the email value
        $user = UserModel::where('email', $request->input('email'))->first();

        if ($user) {
            $response = Password::sendResetLink($request->only('email'));

            if ($response === Password::RESET_LINK_SENT) {
                return response()->json(['message' => 'Password reset link sent']);
            } else {
                switch ($response) {
                    case Password::INVALID_USER:
                        return response()->json(['message' => 'User not found'], 404);
                    default:
                        return response()->json(['message' => 'Failed to send reset link'], 500);
                }
            }
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    // public function index()
    // {
    //     $testMailData = [
    //         'title' => 'test email from AllPHPTricks.com',
    //         'body' => 'this is the body of the test email',

    //     ];
    //     Mail::to('jihan.shamas@gmail.com')->send(new SendMail($testMailData));
    //     dd('email sent successfully');
    // }
    protected function sendPasswordResetLink($email, $token)
    {
        $mail = new PHPMailer(true);

        try {
            // Configure your SMTP server settings here
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
            $mail->SMTPAuth = true;
            $mail->Username = 'jihan.shamas@gmail.com'; // Replace with your username
            $mail->Password = 'ayajramhnpwvwldc'; // Replace with your password
            $mail->SMTPSecure = 'tls'; // or 'ssl'
            $mail->Port = 587; // Replace with the correct port
            $mail->setFrom('jihan.shamas@gmail.com', 'Cosmo');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Link';
            $mail->Body = 'Click the following link to reset your password: ' . url('/password/reset', ['token' => $token]);
            $mail->send();
        } catch (Exception $e) {
            // return response()->json(['message' => 'Email could not be sent'], 500);

            Log::error('Email sending error: ' . $e->getMessage());

            // Take appropriate action, such as informing the user about the error
        }
    }
}
