<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radcheck;

class RadcheckController extends Controller
{
    public function index()
    {
        //
        $raddatas = Radcheck::orderBy('id', 'DESC')->get(); 
        
        return view('radcheck.index', ['raddatas' => $raddatas]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('radcheck.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        
        //
        $request->validate([
            'username' => 'required|min:9'
          ]);
          
          $request->request->add(['attribute' => 'Cleartext-Password']); //add att
          $request->request->add(['op' => ':=']); //add op
          $request->request->add(['value' => implode($pass)]); //add att

          $input = $request->all();
          $post = Radcheck::create($input);


          $profile = new Radcheck();
          $profile->username = $request->username;
          $profile->attribute = 'User-Profile';
          $profile->op = ':=';
          $profile->value = 'active';
          $profile->save();
         
          return back()->with('success',' Username baru berhasil dibuat. '.$request->username.' with password '.implode($pass));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rad = Radcheck::findOrFail($id);
   
        return view('radcheck.edit', [
                'raddata' => $rad
        ]);
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
        $request->validate([
            'username' => 'required|min:8',
         ]);
               
         $post = Radcheck::find($id)->update($request->all()); 
                
         return back()->with('success',' Data telah diperbaharui!');
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
