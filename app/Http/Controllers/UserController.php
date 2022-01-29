<?php

namespace App\Http\Controllers;

use \App\Http\Requests\StoreRequest;
use \App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['pageTitle'] = 'User';
        $this->param['pageIcon'] = 'feather icon-users';
        $this->param['parentMenu'] = 'user';
        $this->param['current'] = 'User';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnText'] = 'Tambah User';
        $this->param['btnLink'] = route('user.create');

        try {
            $keyword = $request->get('keyword');
            // $getUsers = User::with('golongan', 'jabatan')->orderBy('name', 'ASC');
            $getUsers = User::orderBy('id');

            if ($keyword) {
                $getUsers->where('name', 'LIKE', "%{$keyword}%")->orWhere('email', 'LIKE', "%{$keyword}%");
            }

            $this->param['user'] = $getUsers->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }
        catch (Exception $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }

        return \view('user.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnText'] = 'List User';
        $this->param['btnLink'] = route('user.index');

        return \view('user.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        try {
            $user = new User;
            $user->nama = $validated['name'];
            $user->email = $validated['email'];
            $user->username = $validated['username'];
            $user->password = Hash::make('password');
            $user->jenis_pegawai = $request->get('jenis_pegawai');
            $user->jenis_kelamin = $request->get('jenis_kelamin');
            $user->nip = $request->get('nip');
            $user->level = $request->get('level');
            $user->save();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.' . $e->getMessage());
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan.' . $e->getMessage());
        }

        return redirect()->route('user.index')->withStatus('Data berhasil disimpan.');
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
        //
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
