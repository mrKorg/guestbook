<?php

namespace App\Http\Controllers;

use App\Message;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use DB;

class DefaultController extends Controller
{
    public function index(Request $request)
    {
        $alert = '';
        $tab = 1;
        
        // Set message
        if($request->isMethod('post')){

            // Validation
            $validator = Validator::make($request->all(), [
                'user_name' => 'required|max:255',
                'email' => 'required|max:150|email',
                'message' => 'required|max:3000',
//                'img' => 'mimes:jpeg,jpg,bmp,png',
                'captcha' => 'required|captcha'
            ]);

            if(!$validator->fails()){

//                if($request->hasFile('img')){
//                    $request->file('img')->move('upload', $request->file('img')->getClientOriginalName());
//                }

                // Check user
                $user = User::where('email', $request->email)->first();
                if(!$user){
                    // Create user
                    User::create([
                        'login' => $request['user_name'],
                        'email' => $request['email'],
                        'url' => $request['url']
                    ]);
                }

                // Get this user + client info
                $thisUser = User::where('email', $request->email)->first();
                $user_info = $this->get_user_info();

                // Create message
                Message::create([
                    'user_id' => $thisUser->id,
                    'message' => $request['message'],
                    'ip' => $user_info['ip'],
                    'client' => $user_info['client']
                ]);

                $alert = "Form send success";
            } else {
                $request->flash();
                $alert = $validator->errors()->all();
                $tab = 2;
            }
        }

        // Return
        $message_list = DB::table('messages')
            ->orderBy('messages.id', 'desc')
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->select('users.login','users.email','users.url','messages.message','messages.created_at')
            ->get();
        return view("default.index", ['alert' => $alert, 'message_list' => $message_list, 'tab' => $tab]);
    }

    // Client info
    function get_user_info()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        $client = $_SERVER['HTTP_USER_AGENT'];
        return ['ip'=>$ip, 'client'=>$client];
    }
}
