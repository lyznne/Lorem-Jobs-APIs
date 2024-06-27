<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{


    /**
     * Register user in the database.
     */
    public function register(RegisterRequest $request)
    {
        // dd($request->all());
        try {
            $user  = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // $user = User::create($user);

            if ($user) {
                return ResponseHelper::success(message: 'user has been registed successfully!', data: $user, statusCode: 201);
            }
            return ResponseHelper::error(message: 'Unable to register user. Please try again!', statusCode: 400);
        } catch (Exception $e) {
            Log::error('unable to register user' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to register user. Please try again!', statusCode: 400);
        }
    }

    /**
     * Login registered users 
     * @param LoginRegister 
     * @return 
     */
    public function login(LoginRequest $request)

    {
        $API_NAME = $request->tokenName;
        try {
            // validate user 
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return ResponseHelper::error(message: 'Unable to login user. Invalid Credentials!', statusCode: 400);
            }

            $user = Auth::user();

            // generate API token 
            $token = $user->createToken($API_NAME ?: 'MY_API_TOKEN')->plainTextToken;

            $authUser = [
                "token" => $token,
                "user" => $user
            ];

            return ResponseHelper::success(message: 'successfully logged in!', data: $authUser, statusCode: 200);
        } catch (Exception $e) {
            Log::error('unable to login the user' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to login the user. Please try again!' . $e->getMessage(), statusCode: 500);
        }
    }

    /**
     * Display the user profile specified resource.
     * @param NA
     * @return JSONResponse
     */
    public function userProfile()
    {
        try {
            $user = Auth::user();

            if ($user) {

                return ResponseHelper::success(message: 'user profile fetched successfully!', data: $user, statusCode: 200);
            }

            return ResponseHelper::error(message: 'Unable to fetch user profile. Invalid Token!', statusCode: 400);
        } catch (Exception $e) {
            Log::error('unable to fetch the user profile' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch the user profile. Please try again!' . $e->getMessage(), statusCode: 500);
        }
    }



    /**
     * Remove user API token  from storage.
     * @param NA
     * @return JSONResponse
     * 
     */
    public function destroy()
    {
        try {
            $user  = Auth::user();

            if ($user) {
                $user->currentAccessToken()->delete();
                return ResponseHelper::success(message: 'Token API Deleted successfully!', data: [], statusCode: 200);
            }
            return ResponseHelper::error(message: 'Unable to delete API Token !', statusCode: 400);
        } catch (Exception $e) {
            Log::error('Exception while deleting API Token' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return ResponseHelper::error(message: 'Exception while deleting API Token!' . $e->getMessage(), statusCode: 500);
        }
        //
    }
}
