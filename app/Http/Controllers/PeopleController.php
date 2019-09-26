<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;
use App\Http\Resources\PeopleCollection;
use Illuminate\Support\Facades\Hash;

class PeopleController extends Controller
{
    public function index()
    {
        $peoples = People::all();
        return $peoples;
    }

    public function store(Request $request)
    {
        $messages = [
      
            'provider.max' => 'Maximo 20 caracteres',
            
        ];


        return People::create([
        'rut'=> $request['name'],
        'ncliente'=> $request['provider'],
        'sector'=> $request['start_contract'],
        'nombre'=> $request['period'],
        'comuna'=> $request['storage'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $peoples = People::findOrFail($id);
        $peoples->update($request->all());
    }

    public function destroy($id)
    {
        $peoples = People::findOrFail($id);
        $peoples->delete();
    }

}
