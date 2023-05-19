<?php
namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $user = Auth::user();
    
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $values = [];
    
        if (!empty($user->value1)) {
            $values['value1'] = $user->value1;
        }
    
        if (!empty($user->value2)) {
            $values['value2'] = $user->value2;
        }
    
        // Return the user name along with other details in the response
        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'message' => 'Hi ' . $user->name . ', welcome to home',
            'name' => $user->name,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
        return response()->json($response);
    }
    
    


    
    //check if Auth::user is !empty
    public function authuser(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            // User is not authenticated, return error response
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $values = [];
    
        if (!empty($user->value1)) {
            $values['value1'] = $user->value1;
        }
    
        if (!empty($user->value2)) {
            $values['value2'] = $user->value2;
        }
    
        // Dump the user and values variables to the console
        dd($user, $values);
    
        // This code will not be reached because the dd() function stops script execution
    }
    
    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();
    
        return redirect('/');
    }
}
?>