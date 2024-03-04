<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

                /**
                 * Login username to be used by the controller.
                 *
                 * @var string
                 */
                protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
                $this->username = $this->findUsername();
                
    }

        public function showLoginForm()
        {
            return view('auth.login');
        }

        public function authenticate(Request $request)
        {   //dd($request);
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);

            $path = storage_path('data.json');// ie: /var/www/laravel/app/storage/app/filename.json
            $res = json_decode(file_get_contents($path)); 
            //dd($res);
            // dd($res->Data);
            //dd($res->Views);
            $isCorrect = false;  //"20210003" && $item->Password == "GHI123"
            $RoleId = "";
            $RoleName = "";

            foreach ($res->Data->Users as $item) {
                if ($item->UserId == $request->username && $item->Password == $request->password ){
                    $isCorrect = true; //authentication successful
                    Session::forget('user_info_sess');//Clear session
                    //Get User Infos, store in sessions
                    Session::put('user_info_sess',[
                        'UserId' => $item->UserId,
                        'Password' => $item->Password,
                        'FirstName' => $item->FirstName,
                        'LastName' => $item->LastName,
                        'Email' => $item->Email,
                        'IsActive' => $item->IsActive,
                        'RoleId' => $item->RoleId
                    ]);

                            foreach ($res->Data->UserRoles as $uritem) {
                                if ($item->RoleId == "R1" && $uritem->RoleId == "Role#1"){
                                    $RoleId = $uritem->RoleId;
                                    $RoleName = $uritem->RoleName;
                                } elseif ($item->RoleId == "R2" && $uritem->RoleId == "Role#2") {
                                    $RoleId = $uritem->RoleId;
                                    $RoleName = $uritem->RoleName;
                                } elseif ($item->RoleId == "R3" && $uritem->RoleId == "Role#3") {
                                    $RoleId = $uritem->RoleId;
                                    $RoleName = $uritem->RoleName;
                                }     
                            }
                            //Set user role info
                            Session::forget('user_role_sess');//Clear session
                            Session::put('user_role_sess',[
                                'RoleId' => $RoleId,
                                'RoleName' => $RoleName
                            ]);
                }
            } 

            //dd(session()->all());
            if ($isCorrect) { 
                return redirect('index');
            } else {
                $notification = array(
                    'message' => 'Invalid username or password.',
                    'alert-type' => 'warning'
                );
            }
            return Redirect()->back()->with($notification);
        }


                /**
                 * Get the login username to be used by the controller.
                 *
                 * @return string
                 */
                public function findUsername()
                {
                    $login = request()->input('login');
            
                    $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            
                    request()->merge([$fieldType => $login]);
                    
                    return $fieldType;
                }
            
                /**
                 * Get username property.
                 *
                 * @return string
                 */
                public function username()
                {
                    return $this->username;
                }

                /**
                 * Get the failed login response instance.
                 *
                 * @param  \Illuminate\Http\Request  $request
                 * @return \Symfony\Component\HttpFoundation\Response
                 *
                 * @throws \Illuminate\Validation\ValidationException
                 */
                protected function sendFailedLoginResponse(Request $request)
                {
                    $isDeactivatedByUsernameOrEmail = DB::table('users')
                            ->whereUsernameOrEmail($request->login, $request->login)
                            //->whereNotNull('deleted_at')
                            ->first();

                    if ($isDeactivatedByUsernameOrEmail && $isDeactivatedByUsernameOrEmail->deleted_at != null){ //account has soft deleted                        
                        throw ValidationException::withMessages([
                            $this->username() => [trans('auth.soft_deleted')],
                        ]);
                    } else {
                        throw ValidationException::withMessages([
                            $this->username() => [trans('auth.failed')],
                        ]);
                    }
                }

}
