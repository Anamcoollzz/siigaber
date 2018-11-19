<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;

class AkunController extends Controller
{

    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\HanyaOperator::class)->except('index');
    }

    private function listRole()
    {
        return [
            ['text'=>'Operator','value'=>'Operator'],
            ['text'=>'Gudang','value'=>'Gudang'],
            ['text'=>'Manajer','value'=>'Manajer'],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = User::all();
        return view('akun.index', [
            'data'      => $data,
            'title'     => 'Akun',
            'active'    => 'akun.index',
            'createLink'=>$r->user()->role == 'Operator' ? route('akun.create') : false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.tambah', [
            'title'         => 'Tambah Akun',
            'modul_link'    => route('akun.index'),
            'modul'         => 'Akun',
            'action'        => route('akun.store'),
            'active'        => 'akun.create',
            'listRole'=>$this->listRole(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required|min:3', 
            'username'=>'required|unique:users', 
            'password'=>'required|confirmed|min:5', 
            'password_confirmation'=>'required|min:3', 
            'role'=>'required',
        ]);
        if(User::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            User::truncate();
        }
        $akun = User::create([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'role'=>$request->role,
        ]);
        return redirect()->back()->with('success_msg', 'Akun berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(User $akun)
    {
        return view('akun.ubah', [
            'd'             => $akun,
            'title'         => 'Ubah Akun',
            'modul_link'    => route('akun.index'),
            'modul'         => 'Akun',
            'action'        => route('akun.update', $akun->id),
            'active'        => 'akun.edit',
            'listRole'=>$this->listRole(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $akun)
    {
        $request->validate([
            'nama'=>'required|min:3', 
            'username'=>'required|unique:users,username,'.$akun->id, 
            'password'=>'nullable|confirmed|min:5', 
            'password_confirmation'=>'nullable|min:3', 
            'role'=>'required',
        ]);
        $data = [
            'nama'=>$request->nama,
            'username'=>$request->username,
            'role'=>$request->role,
        ];
        if($request->password){
            $data['password']=bcrypt($request->password);
        }
        $akun->update($data);
        return redirect()->back()->with('success_msg', 'Akun berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $akun)
    {
        $akun->delete();
        return redirect()->back()->with('success_msg', 'Akun berhasil dihapus');
    }
}
