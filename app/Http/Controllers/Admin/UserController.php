<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    private $user;
    private $title;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->title = 'Usuários';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user
                    ->select('users.id as id','users.name as name','users.email as email','roles.name as role')
                    ->selectraw("CASE WHEN active = 'A' THEN 'Ativo' ELSE 'Inativo' END as active")
                    ->leftJoin("role_users", "users.id","=","role_users.user_id")
                    ->leftJoin("roles", "role_users.role_id", "=", "roles.id")
                    ->get();
        $roles = Role::orderBy('name')->pluck('name','id');                    
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Admin','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('admin.user.index', compact('users','roles','title','list'));
    } 
    
    public function profile()
    {
        return view('admin.profile');
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();

        if($data['password']!= null)
            $data['password'] = bcrypt($data['password']);
        else
            unset($data['password']);

        $data['image'] = $user->image;
        
        if($request->hasFile('image') && $request->file('image')->isValid()){
        
            if($user->image)
                $name = substr($user->image, 0, strpos($user->image,'.'));
            else
                $name = $user->id.kebab_case($user->name);
            
            $extention = $request->image->extension();

            $nameFile = "{$name}.{$extention}";
            
            $data['image'] =  $nameFile;

            $upload = $request->image->storeAs('users', $nameFile);

            if(!$upload){
                alert()->html('Alerta','<h5>Erro ao fazer upload da imagem.<h5>'.$message, 'error')
                    ->showCancelButton('Fechar')
                    ->autoClose(8000);
                return redirect()->back();
            }
        }

        $update = $user->update($data);

        if($update){
            alert()->html('Alerta','<h5>Dados atualizados com sucesso.</h5>','success')
                    ->autoClose(8000)
                    ->toToast();    
            return redirect()->route('profile'); 
        }        
        alert()->html('Alerta','Falha ao atualizar o registro.','warning')
               ->autoClose(8000)
               ->toToast();
        return redirect()->back();
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
        $attributeNames = array(
            "name"      => "Nome",
            "email"     => "E-mail",
            "password"  => "Senha",
            "image"     => "Foto",
            "role"      => "Perfil"
        );
        $validation = Validator::make($data,[
            "name"      => "required|string|max:191",
            "email"     => ['required','string','max:191',Rule::unique('users')],
            "password"  => "required|string|max:191|min:6",
            "role"      => "required|exists:roles,id"
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

        // field password
        $data['password'] = bcrypt($data['password']);
        // field active
        if(!isset($data['active'])){
            $data['active'] = 'I';
        }

        $result = User::create([
            "name"      => $data['name'],
            "email"     => $data['email'],
            "password"  => $data['password'],
            "active"    => $data['active']
        ]);
        $result->roles()->attach($data['role']);

        if($result){
            alert()->html('Alerta','<h5>Registro criado com sucesso.</h5>','success')
                   ->autoClose(8000)
                   ->toToast();
            return redirect()->back();
        }
        alert()->html('Alerta','Falha ao criar o registro.','warning')
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
        return User::select("users.id as id","users.name as name","users.email as email","users.image as image", "roles.id as role")
                    ->selectraw("CASE WHEN users.active = 'A' THEN 'checked' ELSE '' END as active")
                    ->leftJoin("role_users", "users.id","=","role_users.user_id")
                    ->leftJoin("roles", "role_users.role_id", "=", "roles.id")
                    ->where("users.id","=",$id)
                    ->first();
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
        $attributeNames = array(
            "name"      => "Nome",
            "email"     => "E-mail",
            "password"  => "Senha",
            "image"     => "Foto",
            "role"      => "Perfil"
        );

        //field password
        if($data['password'] != null){
            $validation = Validator::make($data,[
                "name"      => "required|string|max:191",
                "email"     => ['required','string','max:191',Rule::unique('users')->ignore($id)],
                "password"  => "required|string|max:191|min:6",
                "role"      => "required|exists:roles,id"
            ]);
        }else{
            $validation = Validator::make($data,[
                "name" => "required|string|max:191",
                "email" => ['required','string','max:191',Rule::unique('users')->ignore($id)]
            ]);

        }
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
        
        // field password
        if($data['password'] != null)
            $data['password'] = bcrypt($data['password']);
        else
            unset($data['password']);
        
            // field active
        if(!isset($data['active'])){
            $data['active'] = 'I';
        }

        // field image
        if($request->hasFile('image') && $request->file('image')->isValid()){
        
            $name = $id.kebab_case($data['name']);
            $extention = $request->image->extension();
            $nameFile = "{$name}.{$extention}";
            $data['image'] =  $nameFile;

            $upload = $request->image->storeAs('users', $nameFile);

            if(!$upload){
                alert()->html('Alerta','<h5>Erro ao fazer upload da imagem.<h5>'.$message, 'error')
                    ->showCancelButton('Fechar')
                    ->autoClose(8000);
                return redirect()->back();
            }
        }

        // field role
        $result = User::find($id);
        $result->roles()->sync($data['role']);
        unset($data['role']);
        $result->update($data);
        

        if($result){
            alert()->html('Alerta','<h5>Registro alterado com sucesso.</h5>','success')
                   ->autoClose(8000)
                   ->toToast();
            return redirect()->back();
        }
        alert()->html('Alerta','Falha ao alterar o registro.','warning')
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
        if(Gate::denies('delete_user')){
            alert()->html('Alerta','<h5>Usuário sem acesso para desativar este registro.</h5>','warning')
            ->autoClose(8000);
            return redirect()->back();    
        }
        $result = User::find($id)->update(['active' => 'I']);
        if($result){
            alert()->html('Alerta','<h5>Registro desativado com sucesso.</h5>','success')
                   ->autoClose(8000)
                   ->toToast();
            return redirect()->back();
        }
        alert()->html('Alerta','<h5>Falha ao desativar o registro.</h5>','warning')
               ->autoClose(8000)
               ->toToast();
        return redirect()->back();
    }
}
