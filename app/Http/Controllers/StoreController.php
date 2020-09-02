<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Store;

class StoreController extends Controller
{
    // TODO switch back actions' method to post
    public function store()
    {

        // $pdo = \DB::connection('mysql')->select('select * from articles where id=1');
        // var_dump($pdo[0]->name);exit;

        // DB::getConnection()->statement('CREATE DATABASE :schema', array('schema' => 'mydatabasename'));

        // \DB::connection('mysql')->statement('CREATE DATABASE ?', ['dynamicDB']);

        \DB::connection('mysql')->statement('CREATE DATABASE `dynamicDB`');

        return response()->json(array(
            'msg' => 'test'
        ));
    }

    public function show($id)
    {
        $selected_store = Store::find($id);

        if ($selected_store)
        {
            return response()->json(array(
                'name' => $selected_store['name']
            ));
        } else
        {
            return response()->json(array(
                'error' => 'not found'
            ), 404);
        }
    }
}
