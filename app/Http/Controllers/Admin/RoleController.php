<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    private $role;
    private $title;

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->title = 'Perfis';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role
                    ->select('id','name','slug')
                    ->get();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Admin','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('admin.role.index', compact('roles','title','list'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        /** field permissions */
        $permissions = array();
        for($i=0; $i<=count($data['permissions']); $i++){
            if(isset($data['permissions'][$i])){
                $permissions[$data['permissions'][$i]] = true;
            }
        }
        $data['permissions'] = $permissions;            
        
        $attributeNames = array(
            "name"          => "Perfil",
            "slug"          => "Slug",
            "permissions"   => "Permissões",
        );
        $validation = Validator::make($data,[
            "name"          => ['required','string','max:191',Rule::unique('roles')],
            "slug"          => ['required','string','max:191',Rule::unique('roles')],
            "permissions"   => "required|array"
        ]);
        $validation->setAttributeNames($attributeNames);

        if($validation->fails()){
            $error = $validation->messages();
            $message = "";
            foreach($error->messages() as $key => $value){
                $message .= "<li><strong>".$value[0]."</strong></li>";
            }
            alert()->html('Alerta','<h5>Problema no preenchimento dos campos.<h5>'.$message, 'error')
                   ->showCancelButton('Fechar')
                   ->autoClose(8000);
            return redirect()->back()->withInput();
        }
        
        /** database statment */        
        try{
            Role::create([
                "name"          => $data['name'],
                "slug"          => $data['slug'],
                "permissions"   => $data['permissions']
            ]);
        } catch (\Illuminate\Database\QueryException $e){
            alert()->html('Alerta','<h5>Falha ao criar o registro.</h5>','warning')
               ->autoClose(8000);            
            return redirect()->back();
        } catch (PDOException $e){
            alert()->html('Alerta','<h5>Falha ao acessar o banco de dados.</h5>','warning')
               ->autoClose(8000);               
            return redirect()->back();
        } 
        alert()->html('Alerta','<h5>Registro criado com sucesso.</h5>','success')
                   ->autoClose(8000)
                   ->toToast();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $data = array();
        $data['id'] = $role->id;
        $data['name'] = $role->name;
        $data['slug'] = $role->slug;
        foreach ($role->permissions as $key => $item) {
           $data[$key] = "checked";
        }        
        return $data;
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
        $data = $request->all();
        
        /** field permissions */
        $permissions = array();
        for($i=0; $i<=count($data['permissions']); $i++){
            if(isset($data['permissions'][$i])){
                $permissions[$data['permissions'][$i]] = true;
            }
        }
        $data['permissions'] = $permissions;            
        
        $attributeNames = array(
            "name"          => "Perfil",
            "slug"          => "Slug",
            "permissions"   => "Permissões",
        );
        $validation = Validator::make($data,[
            "name"          => ['required','string','max:191',Rule::unique('roles')->ignore($id)],
            "slug"          => ['required','string','max:191',Rule::unique('roles')->ignore($id)],
            "permissions"   => "required|array"
        ]);
        $validation->setAttributeNames($attributeNames);

        if($validation->fails()){
            $error = $validation->messages();
            $message = "";
            foreach($error->messages() as $key => $value){
                $message .= "<li><strong>".$value[0]."</strong></li>";
            }
            alert()->html('Alerta','<h5>Problema no preenchimento dos campos.<h5>'.$message, 'error')
                   ->showCancelButton('Fechar')
                   ->autoClose(8000);
            return redirect()->back()->withInput();
        }
        
        /** database statment */        
        try{
            Role::find($id)->update([
                "name"          => $data['name'],
                "slug"          => $data['slug'],
                "permissions"   => $data['permissions']
            ]);
        } catch (\Illuminate\Database\QueryException $e){
            alert()->html('Alerta','<h5>Falha ao alterar o registro.</h5>','warning')
               ->autoClose(8000);            
            return redirect()->back();
        } catch (PDOException $e){
            alert()->html('Alerta','<h5>Falha ao acessar o banco de dados.</h5>','warning')
               ->autoClose(8000);               
            return redirect()->back();
        } 
        alert()->html('Alerta','<h5>Registro alterado com sucesso.</h5>','success')
                   ->autoClose(8000)
                   ->toToast();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete_role')){
            alert()->html('Alerta','<h5>Usuário sem acesso para apagar este registro.</h5>','warning')
            ->autoClose(8000);
            return redirect()->back();    
        }
        try{
            Role::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $e){
            alert()->html('Alerta','<h5>Falha ao apagar o registro.</h5><h5>Existem relacionamentos que dependem desse registro.</h5>','warning')
               ->autoClose(8000);            
            return redirect()->back();
        } catch (PDOException $e){
            alert()->html('Alerta','<h5>Falha ao acessar o banco de dados.</h5>','warning')
               ->autoClose(8000);               
            return redirect()->back();
        } 
        alert()->html('Alerta','<h5>Registro apagado com sucesso.</h5>','success')
                   ->autoClose(8000)
                   ->toToast();
        return redirect()->back();  
            
    }
}
