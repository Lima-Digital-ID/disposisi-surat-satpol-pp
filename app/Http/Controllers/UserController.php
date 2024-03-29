<?php

namespace App\Http\Controllers;

use \App\Http\Requests\StoreRequest;
use \App\Models\User;
use \App\Models\Golongan;
use \App\Models\Jabatan;
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
            $getUsers = User::with('golongan', 'jabatan')->orderBy('id', 'ASC');

            if ($keyword) {
                $getUsers->where('nama', 'LIKE', "%{$keyword}%")->orWhere('email', 'LIKE', "%{$keyword}%");
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
        $this->param['allGol'] = Golongan::get();
        $this->param['allJab'] = Jabatan::get();

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
            $user->id_golongan = $request->get('id_golongan');
            $user->id_jabatan = $request->get('id_jabatan');
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
        $this->param['data'] = User::find($id);
        $this->param['allGol'] = Golongan::get();
        $this->param['allJab'] = Jabatan::get();
        $this->param['btnText'] = 'List User';
        $this->param['btnLink'] = route('user.index');
        // ddd( $this->param['data']->nip);
        return view('user.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        try{
            $user = User::find($id);
            $isEmailUnique = $request->get('email') != null && $request->get('email') != $user->email ? '|unique:users,email' : '';
            $isUsernameUnique = $request->get('username') != null && $request->get('username') != $user->username ? '|unique:users,username' : '';

            $requestValid = $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required|email'.$isEmailUnique,
                    'username' => 'required'.$isUsernameUnique,
                ],
                [
                    'name.required' => 'Nama harus diisi.',
                    'email.required' => 'Email harus diisi.',
                    'username.required' => 'Username harus diisi.',
                    'email.unique' => 'Email telah digunakan.',
                    'username.unique' => 'Username telah digunakan.',
                ]
            );
            $validated = $requestValid;

            $user->nama = $validated['name'];
            $user->email = $validated['email'];
            $user->username = $validated['username'];
            $user->id_golongan = $request->get('id_golongan');
            $user->id_jabatan = $request->get('id_jabatan');
            $user->jenis_pegawai = $request->get('jenis_pegawai');
            $user->jenis_kelamin = $request->get('jenis_kelamin');
            $user->nip = $request->get('nip');
            $user->level = $request->get('level');
            $user->save();
        }catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.' . $e->getMessage());
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan Database.' . $e->getMessage());
        }
        return redirect()->route('user.index')->withStatus('Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('user.index')->withStatus('Data berhasil dihapus.');
    }

        public function changePassword()
    {
        $this->param['pageTitle'] = 'Edit Password';
        $this->param['user'] = User::find(auth()->user()->id);
        return view('user.change-password', $this->param);
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);;
        $old = $request->old_pass;
        $new = $request->password;

        if(!Hash::check($old, $user->password))
            return back()->withError('Password lama tidak cocok.');

        if(Hash::check($new, $user->password))
            return back()->withError('Password baru tidak boleh sama dengan password lama.');

        $validatedData = $request->validate(
            [
                'old_pass' => 'required',
                'password' => 'required',
                'confirmation' => 'required|same:password'
            ],
            [
                'required' => ':attribute harus diisi.',
                'password.unique' => 'Password baru tidak boleh sama dengan password lama.',
                'same' => 'Konfirmasi password harus sesuai.'
            ],
            [
                'old_pass' => 'Password lama',
                'password' => 'Password baru',
                'confirmation' => 'Konfirmasi password baru',
            ]
        );

        try {
            $user->password = Hash::make($request->get('password'));
            $user->save();


        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan.');
        }

        return back()->withStatus('Password berhasil diperbarui.');
    }
}
