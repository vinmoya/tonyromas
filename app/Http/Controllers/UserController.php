<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\User;
use App\Restaurant;
use App\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $options = [
        'route' => 'users',
        'route-views' => 'modules.users.'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view($this->options['route-views']."profile")
                            ->with('options', $this->options)
                            ->with('row', User::find(\Auth::user()->id));
    }

    public function profileUpdate(UserProfileRequest $request, $id)
    {
        $user             = User::find($id);
        $user->name       = $request->input('name');
        $user->login      = $request->input('login');
        $user->password   = bcrypt($request->input('password'));

        if($user->save()) {

            Session::flash('update', 'Perfil actualizado!!');

            return view($this->options['route-views']."profile")
                            ->with('options', $this->options)
                            ->with('row', User::find(\Auth::user()->id));
            
        }
    }

    public function index()
    {
        $user = User::all();
        foreach ($user as $value) {
            //dd($value->roles);
        }
        return view($this->options['route-views']."index")
                            ->with('options', $this->options)
                            ->with('array', User::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant = Restaurant::all();
        $roles = Role::all();
        return view($this->options['route-views']."save")
                            ->with('roles', $roles)
                            ->with('file', $restaurant)
                            ->with('options', $this->options)
                            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $user             = new User;
        if ($request->role_id > 1) { $user->restaurant_id = $request->input('restaurant_id'); }        
        $user->name  = $request->input('name');
        $user->login      = $request->input('login');
        $user->password   = bcrypt($request->input('password'));
                
        if($user->save()) {
            $user->roles()->attach($request->role_id);
            Session::flash('save', 'Registro insertado!!');
            return redirect('dashboard/'.$this->options['route']);
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
        $restaurant = User::find($id)->restaurant;

        if ($restaurant == NULL) //SI regresa null, el usuario es admin 
        {
            $user = User::find($id);
            //$user->roles;
        } else { //Si no regresa NULL, el usuario es comun y corriente
            $user = $restaurant->user;
            //dd($restaurant);    
        }
        return view($this->options['route-views'].'save')
                            ->with('options', $this->options)
                            ->with('typeForm', 'update')
                            ->with('roles', Role::get())
                            ->with('file', Restaurant::get())
                            ->with('row', $user);   
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
        $user             = User::find($id);
        if (!empty($request->restaurant_id)) { $user->restaurant_id = $request->input('restaurant_id'); }
        $user->name  = $request->input('name');
        $user->login      = $request->input('login');
        $user->password   = bcrypt($request->input('password'));

        if($user->save()) {

            $user->roles()->detach($request->role_id);
            $user->roles()->attach($request->role_id);

           Session::flash('update', 'Registro actualizado!!');
            return redirect('dashboard/'.$this->options['route']);
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

        Session::flash('delete', 'Registro eliminado!!');
        return redirect('dashboard/'.$this->options['route']);
    }
}
