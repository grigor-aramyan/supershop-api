<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class HomeController extends Controller
{
    public function index($id = null)
    {
        session(['name' => 'john']);

        if ($id)
        {
            return response()->json(array(
                'sended id' => $id
            ));
        } else
        {
            // return Response::json(array(
            //     'error' => 'no id specified'
            // ));
            return response()->json(array(
                'error' => 'no id specified'
            ));
        }
    }

    public function show()
    {

        $session_data = session('name', '');
        
        if ($session_data)
        {
            return response()->json(array(
                'session data' => $session_data
            ));
        } else
        {
            return response()->json(array(
                'session data' => 'no data stored'
            ));
        }
    }

    

    public function account($account)
    {
        $u = User::where('name', $account)->first();

        if (isset($u['id']))
        {
            $current_user = User::find($u['id']);
            return response()->json(array(
                'email' => $current_user['email']
            ), 200);
        } else
        {
            return response()->json(array(
                'error' => 'not found'
            ), 404);
        }

    }

}
