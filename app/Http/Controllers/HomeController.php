<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(view()->exists($request->path())){
            return view($request->path());
        }
        return view('pages-404');
    }

    public function userCreate(){

        $path = storage_path('data.json');
        $res = json_decode(file_get_contents($path)); 
        $users = $res->Data->Users;
        //dd($users);        
        return view('user_create', compact('users'));
    }

    public function userSave(Request $request)
    {
        $path = storage_path('data.json');
        $jsonString = file_get_contents($path);
        $data = json_decode($jsonString, true);
        //Then change the data :
        
        //count last index at ['Data']['Users']
        $lastIndex = count($data['Data']['Users']);// dd($lastIndex);
        //Add
        $data['Data']['Users'][$lastIndex]['UserId'] = $request->UserId;
        $data['Data']['Users'][$lastIndex]['Password'] = $request->Password;
        $data['Data']['Users'][$lastIndex]['FirstName'] = $request->FirstName;
        $data['Data']['Users'][$lastIndex]['LastName'] = $request->LastName;
        $data['Data']['Users'][$lastIndex]['Email'] = $request->Email;
        $data['Data']['Users'][$lastIndex]['IsActive'] = "true"; //default
        $data['Data']['Users'][$lastIndex]['RoleId'] = $request->RoleId;

        //Then re-encode it and save it back in the file:
        $newJsonString = json_encode($data);
        file_put_contents($path, $newJsonString);

        $notification = array(
            'message' => 'Successfully saved.',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function userList(){

        $path = storage_path('data.json');
        $res = json_decode(file_get_contents($path)); 
        $users = $res->Data->Users;  
        return view('user_list', compact('users'));
    }

    public function userEdit($id){
        $path = storage_path('data.json');
        $res = json_decode(file_get_contents($path)); 
        $user_info_arr = array(); 
        foreach ($res->Data->Users as $item) {
            if ($item->UserId == $id) {
                $user_info_arr = array(
                    "UserId" => $item->UserId,
                    "FirstName" => $item->FirstName,
                    "LastName" => $item->LastName,
                    "Email" => $item->Email,
                    "IsActive" => $item->IsActive,
                    "RoleId" => $item->RoleId
                );
            }
        }         
        return view('user_edit', compact('user_info_arr'));
    }

    public function userUpdate(Request $request){
        /////// UPDATING JSON
        $path = storage_path('data.json');
        $jsonString = file_get_contents($path);
        $data = json_decode($jsonString, true);

        foreach ($data['Data']['Users'] as $key => $item) {
           // dd($data['Data']['Users'][$key]['UserId']); 
            if ($data['Data']['Users'][$key]['UserId'] == $request->UserId) {                
                $data['Data']['Users'][$key]['FirstName'] = $request->FirstName;
                $data['Data']['Users'][$key]['LastName'] = $request->LastName;
                $data['Data']['Users'][$key]['Email'] = $request->Email;
                $data['Data']['Users'][$key]['IsActive'] = $request->IsActive;
                $data['Data']['Users'][$key]['RoleId'] = $request->RoleId;

                //update the session of current user if edited
                //dd(Session::get('user_info_sess'));
                // if (Session::get('user_info_sess')['UserId'] == $request->UserId){ // if the user currenltly login has change it account info.
                    
                //     //dd(Session::get('user_info_sess'));
                //     Session::put('user_info_sess',[
                //         'FirstName' => $item->FirstName,
                //         'LastName' => $item->LastName,
                //         'Email' => $item->Email,
                //         'IsActive' => $request->IsActive,
                //         'RoleId' => $item->RoleId
                //     ]);
                // }
            }
        }     

        //Then re-encode it and save it back in the file:        
        $newJsonString = json_encode($data);
        file_put_contents($path, $newJsonString);

        // //recheck
        // $path = storage_path('data.json');
        // $res = json_decode(file_get_contents($path), true); 
        // dd($res);
         /////// UPDATING JSON

        $notification = array(
            'message' => 'Successfully updated.',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function changePasswordField(){        
        return view('profile_password_change'); 
    }

    public function updatePasswordAction(Request $request){
        $id = Session::get('user_info_sess')['UserId'];  
        $oldPassword = Session::get('user_info_sess')['Password'];  

        if ($request->OldPassword != $oldPassword){ //old password validation
            $notification = array(
                'message' => 'Incorrect old password.',
                'alert-type' => 'warning'
            );
        } else if ($request->NewPassword != $request->RtNewPassword) {
            $notification = array(
                'message' => 'Your new and confirmation password must be the same.',
                'alert-type' => 'warning'
            );
        } else {
            $path = storage_path('data.json');
            $jsonString = file_get_contents($path);
            $data = json_decode($jsonString, true);    
            foreach ($data['Data']['Users'] as $key => $item) {
               // dd($data['Data']['Users'][$key]['UserId']); 
                if ($data['Data']['Users'][$key]['UserId'] == $id) {                
                    $data['Data']['Users'][$key]['Password'] = $request->NewPassword;
                }
            }         
            //Then re-encode it and save it back in the file:        
            $newJsonString = json_encode($data);
            file_put_contents($path, $newJsonString);

            $notification = array(
                'message' => 'Your password has been successfully changed.',
                'alert-type' => 'success'
            );
        }
        return Redirect()->back()->with($notification);
    }

    public function memberCreate(){

        $path = storage_path('data.json');
        $res = json_decode(file_get_contents($path)); 
        $members = $res->Data->Members;
        //dd($users);        
        return view('member_create', compact('members'));
    }

    public function memberSave(Request $request)
    {
        $path = storage_path('data.json');
        $jsonString = file_get_contents($path);
        $data = json_decode($jsonString, true);
        //Then change the data :
        
        //count last index at ['Data']['Users']
        $lastIndex = count($data['Data']['Members']);// dd($lastIndex);
        //Add
        $data['Data']['Members'][$lastIndex]['MemberId'] = $request->MemberId;
        $data['Data']['Members'][$lastIndex]['FirstName'] = $request->FirstName;
        $data['Data']['Members'][$lastIndex]['LastName'] = $request->LastName;
        $data['Data']['Members'][$lastIndex]['Birthdate'] = $request->Birthdate;
        $data['Data']['Members'][$lastIndex]['MemberCategoryId'] = $request->MemberCategoryId;

        //Then re-encode it and save it back in the file:
        $newJsonString = json_encode($data);
        file_put_contents($path, $newJsonString);

        //Re-Check
        // $path = storage_path('data.json');
        // $res = json_decode(file_get_contents($path), true); 
        // dd($res);

        $notification = array(
            'message' => 'Successfully saved.',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function memberList(){

        $path = storage_path('data.json');
        $res = json_decode(file_get_contents($path)); 
        $members = $res->Data->Members;  
        return view('member_list', compact('members'));
    }

    public function memberEdit($id){
        $path = storage_path('data.json');
        $res = json_decode(file_get_contents($path)); 
        $user_info_arr = array(); 
        foreach ($res->Data->Members as $item) {
            if ($item->MemberId == $id) {
                $user_info_arr = array(
                    "MemberId" => $item->MemberId,
                    "FirstName" => $item->FirstName,
                    "LastName" => $item->LastName,
                    "Birthdate" => $item->Birthdate,
                    "MemberCategoryId" => $item->MemberCategoryId
                );
            }
        }         
        return view('member_edit', compact('user_info_arr'));
    }

    public function memberUpdate(Request $request){
        /////// UPDATING JSON
        $path = storage_path('data.json');
        $jsonString = file_get_contents($path);
        $data = json_decode($jsonString, true);

        foreach ($data['Data']['Members'] as $key => $item) {
           // dd($data['Data']['Users'][$key]['UserId']); 
            if ($data['Data']['Members'][$key]['MemberId'] == $request->MemberId) {                
                $data['Data']['Members'][$key]['FirstName'] = $request->FirstName;
                $data['Data']['Members'][$key]['LastName'] = $request->LastName;
                $data['Data']['Members'][$key]['Birthdate'] = $request->Birthdate;
                $data['Data']['Members'][$key]['MemberCategoryId'] = $request->MemberCategoryId;
            } 
        }     

        //Then re-encode it and save it back in the file:        
        $newJsonString = json_encode($data);
        file_put_contents($path, $newJsonString);

        $notification = array(
            'message' => 'Successfully updated.',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }
  
}
