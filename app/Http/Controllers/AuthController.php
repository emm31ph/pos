<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
   /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }

    public function index(Request $request)
    {
        
        $data = "";
        switch ($request->trnmode) {
            case 'updateProfile':
                $data = $this->update($request);
                break;
            
            default:
                # code...
                break;
        }

        return response()->json($data);  
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    { 
        // $credentials = request(['email', 'password']); 
        
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = (array($fieldType => $request->email, 'password' => $request->password));

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);  
        }
        return $this->respondWithToken($token);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    { 
        $data = ''; 
        
        config()->set('database.connections.mysql.strict', false);
        \DB::reconnect();

        // $data = User::with('branch') 
        // ->where('id',auth()->user()->id)->first(); 
        $data =  new AuthResource(User::with('branch')->where('id',auth()->user()->id)->first());
        
        config()->set('database.connections.mysql.strict', true);
        \DB::reconnect();

       
        return response()->json($data);
    }

    private function update($request)
    {
        $user = auth()->user();
          $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id, 
        ]);


         $user->name = $request->name;
         $user->email = $request->email;
        //  $user->username = $request->username;
       
        if(!$request->password==""){
             $user->password = bcrypt($request->password); 
        }
        
        $user->save(); 
        return $user;
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
 
        $cookie = Cookie::forget('jwt');
        
        return response()->json(['message' => 'Successfully logged out'])->withCookie($cookie);
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {

         $cookie = cookie('jwt', $token, 60*24);


        return response()->json([
            'token' =>  'toktok',
             'cookie' => Config::get('session.lifetime'),
            // 'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
            // 'expires_in' => auth('api')->factory()->getTTL() * 60 *24
        ])->withCookie($cookie);
    }

    /**
     * Register new user
     *
     * @param  string $name, $email, $password, password_confirmation
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
    	
    	$validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'username' => 'required|string|min:6',
            ]);
    		
    	if($validator->fails()){
                return response()->json([
                	'status' => 'error',
                	'success' => false,
                    'error' =>
                    $validator->errors()->toArray()
                ], 400);
            }
    		
    	$user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'username' => $request->input('username'),
            ]);
    		
    	return response()->json([
	    'message' => 'User created.',
            'user' => $user
        ]);	
    }
}