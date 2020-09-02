<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PageSchema;

class BuilderController extends Controller
{
    /**
     * Create a new BuilderController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['store']]);
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $schema_name = $request->schema;
        
        $header_data = $request->header;
        $mains_data = $request->mains;
        $footer_data = $request->footer;

        if (!isset($schema_name) || !isset($header_data) || !isset($mains_data)
            || !isset($footer_data))
        {
            return response()->json(array(
                'error' => 'missing data'
            ), 400);
        }

        $current_user = auth()->user();
        $current_store = $current_user->store;

        if ($current_store)
        {
            $selected_schema_raw = PageSchema::where('name', $schema_name)->take(1)->get();

            if (count($selected_schema_raw) == 0)
            {
                return response()->json(array(
                    'error' => 'no schema with supplied name found'
                ), 400);
            } else
            {
                $selected_schema = PageSchema::find($selected_schema_raw[0]['id']);

                if (!$selected_schema)
                {
                    return response()->json(array(
                        'error' => 'some weird error. try a bit later, please'
                    ), 500);
                } else
                {
                    $current_store->page_schemas()->save($selected_schema);
                }
            }
        } else
        {
            return response()->json(array(
                'error' => 'store not found for identified user'
            ), 400);
        }

    }

}
