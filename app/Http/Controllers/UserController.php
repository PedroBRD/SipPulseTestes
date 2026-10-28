<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // Função para definir as permissões para cada função
    // https://www.itsolutionstuff.com/post/laravel-11-user-roles-and-permissions-tutorialexample.html
    public function __construct() {
        $this->middleware('permission:view')->only(['index', 'show']);
        $this->middleware('permission:create')->only(['create', 'store']);
        $this->middleware('permission:edit')->only(['edit', 'update']);
        $this->middleware('permission:delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view');
        $users = User::all();
        //dd($users);
        //dd('dentro da index');
        return view('Users/homeUsers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create');
        return view('Users/createUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create');
        $data = $request->all();
        //dd($data);

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        $user->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('view');
        //dd('dentro da show');
        $user = User::find($id);

        if(!isset($user) || is_null($user)) {
            dd('Usuário não existe');
        }
        //dd($user);
        return view('Users/showUsers', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('edit');
        $user = User::findOrFail($id);
        if(!isset($user) || is_null($user)) {
            dd('Usuário não existe');
        }
        return view('Users/editUsers', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('edit');
        $user = User::findOrFail($id);
        //dd($user->get('password'));
        //dd($user);
        //dd('dentro da update');

        $data = $request->all();
        //dd($request->password);

        //trata a senha, altera se for definada uma nova, ou ignora se não foi alterado
        if ($data['password'] !== null || !empty($data['password'])){
            //dd('aqui');
            $data['password'] = Hash::make($data['password']);
        } /*else {
            unset($data['password']);
        }*/
        //dd($data);

        $user->update($data);
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete');
        $user = User::find($id);
        if(!isset($user) || is_null($user)) {
            dd('Usuário não existe');
        } else {
            $user->delete();
            return redirect()->route('users.index');
        }
    }
}
