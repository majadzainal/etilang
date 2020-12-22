<?php

namespace App\Http\Controllers\Dashboard;

use Validator;
use App\Models\Logs;
use App\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Dashboard\PetugasController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $obj_petugas;
    public function __construct()
    {
        $this->obj_petugas = new PetugasController();
    }
    public function Logs(Request $request)
    {
        $q = $request->input('q');

        $active = 'logs';

        // $logs = Logs::when($q, function($query) use ($q) {
        //             return $query->where('user_id', 'like', '%'.$q.'%');
        //         })
        //         ->paginate(10);

        $logs = DB::table('logs')
                ->leftJoin('users', 'logs.user_id', '=', 'users.id')
                ->select('logs.id', 'logs.created_at', 'logs.description', 'users.username')
                ->where('users.user_level', 'petugas')
                ->orderBy('created_at', 'DESC')
                ->when($q, function($query) use ($q) {
                    return $query->where('users.username', 'like', '%'.$q.'%')
                                ->orWhere('logs.description', 'like', '%'.$q.'%')
                                ->where('users.user_level', 'petugas')
                                ->orderBy('created_at', 'DESC');
                })
                ->paginate(10);
        
        $request = $request->all();
        return view('dashboard.user.logs', compact('logs', 'active', 'request'));
    }

    public function index($notify = '', Request $request, User $users)
    {
        $q = $request->input('q');

        $active = 'users';
        $notif = $notify;

        $users = $users->when($q, function($query) use ($q) {
                    return $query->where('username', 'like', '%'.$q.'%')
                                    ->orWhere('email', 'like', '%'.$q.'%');
                })
                ->paginate(10);
        
        $request = $request->all();
        return view('dashboard.user.List', compact('users', 'active', 'request', 'notif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'users';
        $jenis_kelamin = $this->obj_petugas->JenisKelamin();
        $status_perkawinan = $this->obj_petugas->StatusPerkawinan();
        $levels = [
            [
                'user_level' => 'administrator'
            ],
            [
                'user_level' => 'petugas'
            ],
        ];

        return view('dashboard.user.create', compact('active', 'jenis_kelamin', 'status_perkawinan', 'levels'));
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
            'email'              => 'required|unique:users,email,',
            'username'           => 'required|string|max:255',
            'nik'                => 'required|unique:petugas,nik,',
            'user_level'         => 'required',
            'tempat_lahir'       => 'required',
            'tanggal_lahir'      => 'required',
            'jenis_kelamin'      => 'required',
            'alamat'             => 'required',
            'agama'              => 'required',
            'status_perkawinan'  => 'required',
            'password'           => 'required|min:8',
            'password-confirm'   => 'required_with:password|same:password|min:8',
        ]);
        
        DB::beginTransaction();
        try 
        {
            $user = User::create([
                    'username'      => $request->username,
                    'email'         => $request->email,
                    'user_level'    => $request->user_level,
                    'password'      => Hash::make($request->password),
                ]);
            $petugas = Petugas::create([
                    'user_id'           => $user->id,
                    'nik'               => $request->nik,
                    'name'              => $request->username,
                    'tempat_lahir'      => $request->tempat_lahir,
                    'tanggal_lahir'     => $request->tanggal_lahir,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'alamat'            => $request->alamat,
                    'agama'             => $request->agama,
                    'status_perkawinan' => $request->status_perkawinan,
                ]);
            
            if ($user && $petugas) { DB::commit(); } else { DB::rollBack(); }
        }
        catch (Exception $e) { DB::rollBack(); }

        return redirect('dashboard/users/action/addedsuccess');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $active = 'users';
        $user = User::find($id);
        $petugas = Petugas::where('user_id', $user->id)->first();
        $jenis_kelamin = $this->obj_petugas->JenisKelamin();
        $status_perkawinan = $this->obj_petugas->StatusPerkawinan();

        return view('dashboard.user.Form', compact('user', 'petugas', 'active', 'jenis_kelamin', 'status_perkawinan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $id_petugas)
    {
        $active = 'users';

        $validator = VALIDATOR::make($request->all(), [
            'email'              => 'required|unique:users,email,'.$id,
            'username'           => 'required',
            'email'              => 'required|unique:petugas,nik,'.$id_petugas,
            'nik'                => 'required',
            'tempat_lahir'       => 'required',
            'tanggal_lahir'      => 'required',
            'jenis_kelamin'      => 'required',
            'alamat'             => 'required',
            'agama'              => 'required',
            'status_perkawinan'  => 'required'
        ]);

        if($validator->fails()){
            return redirect('dashboard/user/edit/'. $id)
                    ->withErrors($validator)
                    ->withInput();
        }else{

            DB::beginTransaction();
            try 
            {
                $user = User::find($id);
                $petugas = Petugas::find($id_petugas);

                $user->username = $request->input('username');
                $user->email = $request->input('email');
                $user->save();

                $petugas->nik = $request->input('nik');
                $petugas->name = $request->input('username');
                $petugas->tempat_lahir = $request->input('tempat_lahir');
                $petugas->tanggal_lahir = $request->input('tanggal_lahir');
                $petugas->jenis_kelamin = $request->input('jenis_kelamin');
                $petugas->alamat = $request->input('alamat');
                $petugas->agama = $request->input('agama');
                $petugas->status_perkawinan = $request->input('status_perkawinan');
                $petugas->save();
                
                if ($user && $petugas) { DB::commit(); } else { DB::rollBack(); }
            }
            catch (Exception $e) { DB::rollBack(); }

            return redirect('dashboard/users/action/updatedsuccess');
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
        $user = User::find($id);
        $user->delete();
        
        return redirect('dashboard/users/action/deletedsuccess');
    }
}
