<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Carbon\Carbon;

class UserController extends Controller
{
   
    public function index()
    {
        $this->authorize('index',User::class);
        //Uso DataTables para la grilla con Ajax
        if(request()->ajax()) {
            return datatables()->of(User::select([
                'id','name' , 'lastname', 'documento','email','telefono','birthday'//Busco las columnas que deseo traerme 
            ]))
            ->addIndexColumn()//Agrego una columna para los botones que haran las acciones 
            ->addColumn('action', function($user){              
                   $btn='<a href="javascript:void(0);" data-toggle="modal" data-target="#viewUserModal" data-id="'.$user->id.'" data-name="'.$user->name.'" data-lastname="'.$user->lastname.'" data-documento="'.$user->documento.'" data-email="'.$user->email.'" data-telefono="'.$user->telefono.'"data-action="view" class="btn btn-info btn-sm"> Ver </a>';
                   $btn = $btn.' <a href="javascript:void(0);" data-toggle="modal" data-target="#addUserModal" data-id="'.$user->id.'" data-name="'.$user->name.'" data-lastname="'.$user->lastname.'" data-documento="'.$user->documento.'" data-email="'.$user->email.'" data-telefono="'.$user->telefono.'" data-action="edit" class="btn btn-success btn-sm"> Editar </a>';
                   $btn = $btn. '<a href="javascript:void(0);" onClick="deleteUser('.$user->id.')" class="btn btn-danger btn-sm"> Borrar </a>'; 
                   
                return $btn;
            })
            ->addColumn('Edad', function($user){//Genero la columna de la edad  
                return Carbon::parse($user->birthday)->diff(Carbon::now())->format('%y');
            })
            ->rawColumns(['action'])//Agrego la columna de los botones
            ->removeColumn('birthday')//Elimino la columna del dia de nacimiento porque ya no es necesaria 
            ->make(true);
        }

        return view('users.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)//Hago uso de validador de Request que se encuentra en la direccion \Http\Requests\
    {
        $this->authorize('create',User::class);
        $user=$request->validated();//Valido la peticion 
        $user['password'] = Hash::make($request->password);
        $user=User::create($user);

        if(!is_null($user)) {
            return response()->json(["status" => "success", "message" => "Success! usuario created.", "data" => $user]);//Envio el resultado 
       }

       else {
           return response()->json(["status" => "failed", "message" => "Usuario! post not created"]);
       }   
 
    }
    public function update(StoreUserRequest $request)
    {
        $this->authorize('update',User::class);
        $user_id=$request->id;
        $user=$request->validated();//Valido de igual forma como en la creacion 
        $user= User::where("id", $user_id)->update($request->all()); // actualizo los valores
        if($user == 1) {
            return response()->json(["status" => "success", "message" => "Success! Usuario updated"]);
        }

        else {
            return response()->json(["status" => "failed", "message" => "Alert! Usuario not updated"]);
        }



    }
    public function show($user)
    {
        $user=User::findOrFail($user);
        $this->authorize('view',$user);
        return view('users.show',compact('user'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id) {
        $this->authorize('delete',User::class);

        $user = User::where("id", $user_id)->delete();//Busco y destruyo
        if($user == 1) {
            return response()->json(["status" => "success", "message" => "Success! Usuario deleted"]);
        }
        else {
            return response()->json(["status" => "failed", "message" => "Alert! Usuario not deleted"]);
        }
    }
}
