<?php

namespace App\Http\Controllers;

use App\Models\Resto;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resto = Resto::orderBy('time','DESC')->get();
        $response = [
            'message' => 'List data transaction order by time',
            'data' => $resto
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'address' => ['required'],
            // 'image' => ['mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:2000'],
            'contact' => ['require','numeric']
            // 'category' => ['required', 'in:food,beverage']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $resto = Resto::create($request->all());
            $response = [
                'message' => 'Data created',
                'data' => $resto
            ];
            return response()->json($response,Response::HTTP_CREATED);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed '. $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resto = Resto::findOrFail($id);
        $response = [
            'message' => 'Detail of resto',
            'data' => $resto
        ];
        return response()->json($response,Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resto = Resto::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'contact' => ['required','numeric'],
            // 'category' => ['required', 'in:food,beverage,both']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $resto->update($request->all());
            $response = [
                'message' => 'Data updated',
                'data' => $resto
            ];
            return response()->json($response,Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed '. $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
