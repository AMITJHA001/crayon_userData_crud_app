<?php

namespace App\Http\Controllers;

use App\userData;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('index')->with('userArray',userData::all());
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
    $user = new userData;
    $request->validate([
            'address'=>'required',
            'name'=>'required',
            'phone'=>'required|digits_between:10,10|numeric',
            'email'=>'required|regex:/(.+)@(.+)\.(.+)/i |unique:user_data,email'
    ]);

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->address = $request->input('address');
    $user->save();

    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\userData  $userData
     * @return \Illuminate\Http\Response
     */
    public function show(userData $userData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\userData  $userData
     * @return \Illuminate\Http\Response
     */
    public function edit(userData $userData,$id)
    {
        $user = userData::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\userData  $userData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $user =  userData::find($request->input('user_id'));
        $request->validate([
            'address'=>'required',
            'name'=>'required',
            'phone'=>'required|digits_between:10,10|numeric',
            'email'=>'required|regex:/(.+)@(.+)\.(.+)/i |unique:user_data,email,'.$request->input('user_id'),
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->save();

     return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\userData  $userData
     * @return \Illuminate\Http\Response
     */
    public function destroy(userData $userData)
    {
        //
    }
}
