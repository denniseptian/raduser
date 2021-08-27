<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radcheck;
use \RouterOS\Client;
use \RouterOS\Query;

class RadcheckController extends Controller
{

    public function __construct()
    {
        if (!app('App\Http\Controllers\AuthController')->index()) {
            return redirect('/login');
        }
    }

    public function index()
    {
        if (app('App\Http\Controllers\AuthController')->index()) {
            $raddatas = Radcheck::orderBy('id', 'DESC')->get();
            return view('radcheck.index', ['raddatas' => $raddatas]);
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (app('App\Http\Controllers\AuthController')->index()) {
            return view('radcheck.create');
        } else {
            return redirect('/login');
        }
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

        // $username = Radcheck::where('username', $request->username)->first();

        // print_r($username);

        if (!Radcheck::where('username', $request->username)->first()) {
            # code...
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

            return back()->with('success', ' Username baru berhasil dibuat. ' . $request->username . ' with password ' . implode($pass));
        } else {
            return back()->withErrors(' Gagal mendaftarakan username baru, Sudah terdapat username yang lama.');
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
        $response = false;
        $config = new \RouterOS\Config([
            'host' => '203.29.26.247',
            'user' => 'notanadmin',
            'pass' => 'Supern3t2019',
            'port' => 8728,
        ]);
        try {
            //code...
            $client = new \RouterOS\Client($config);

            $rad = Radcheck::findOrFail($id);
            $radDuo = Radcheck::where('username', $rad->username)->get();

            // $query = (new Query('/ip/address/print'));

            $mikrotikIdppp = $this->get_idppp($rad->username);

            if ($mikrotikIdppp != null) {
                $query = new \RouterOS\Query('/ppp/active/get');
                $query->where('.id', $mikrotikIdppp);
                $query->equal('.id', $mikrotikIdppp);

                $response = $client->query($query)->read();
            }

            // array_push($radDuo, reset($response));
            return view('radcheck.edit', [
                'raddata' => $radDuo,
                'mrResponse' => $response
            ]);
        } catch (\Throwable $th) {
            $rad = Radcheck::findOrFail($id);
            $radDuo = Radcheck::where('username', $rad->username)->get();

            return view('radcheck.edit', [
                'raddata' => $radDuo
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ifaceremove($username)
    {
        print_r($username);
    }

    // Subs of edit
    public function get_idppp($username)
    {
        $result = null;
        $config = new \RouterOS\Config([
            'host' => '203.29.26.247',
            'user' => 'notanadmin',
            'pass' => 'Supern3t2019',
            'port' => 8728,
        ]);
        $client = new \RouterOS\Client($config);

        // Create 'where' Query object for RouterOS
        $query = (new Query('/ppp/active/print'));
        // Send query and read response from RouterOS
        $responses = $client->query($query)->read();

        foreach ($responses as $response) {
            if ($response['name'] == $username)

                $result = $response['.id'];
        }

        return $result;
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
            'value' => 'required',
        ]);

        var_dump($request->value);

        $post = Radcheck::find($id)->update($request->all());

        return back()->with('success', ' Data telah diperbaharui!');
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
