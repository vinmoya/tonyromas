<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RestaurantRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Restaurant;
use Session;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $options = [
        'route' => 'restaurants',
        'route-views' => 'modules.restaurant.'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->options['route-views']."index")
                            ->with('options', $this->options)
                            ->with('array', Restaurant::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->options['route-views']."save")
                            ->with('options', $this->options)
                            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantRequest $request)
    {
        $restaurant            = new Restaurant;
        $restaurant->name      = $request->input('name');
        $restaurant->address   = $request->input('address');
            
        if($restaurant->save()) {
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
        $restaurant = Restaurant::find($id);
        return view($this->options['route-views'].'save')
                            ->with('options', $this->options)
                            ->with('typeForm', 'update')
                            ->with('row', $restaurant);
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
        $restaurant             = Restaurant::find($id);
        $restaurant->name       = $request->input('name');
        $restaurant->address    = $request->input('address');

        if($restaurant->save()) {
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
        $restaurant = Restaurant::find($id);
        if($restaurant->delete()){
            Session::flash('delete', 'Registro eliminado!!');
            return redirect('dashboard/'.$this->options['route']);
        }
    }
}
