<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Client;
use App\Models\State;
use App\Models\City;
use App\Models\Ait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ClientController extends Controller
{
    private $client;
    private $title;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->title = 'Clientes';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->client
                    ->select('id','name','cpf','tel_home','cell','email')
                    ->get();
        $cities = City::all();
        $states = State::all();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Cadastros','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('admin.client.index', compact('clients','title','list','cities','states'));
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
        $attributeNames = array(
            "name"          => "Nome",
            "dtbirth"       => "Data de Nascimento",
            "cpf"           => "CPF",
            "identity"      => "Identidade",
            "cnh"           => "CNH",
            "dtcnh"         => "Data da CNH",
            "type_street"   => "Tipo de Logradouro",
            "street"        => "Logradouro",
            "number"        => "Número",
            "complement"    => "Complemento",
            "neighborhood"  => "Bairro",
            "city_id"       => "Cidade",
            "state_id"      => "Estado",
            "cep"           => "CEP",
            "tel_home"      => "Tel. Residencial",
            "tel_work"      => "Tel. Comercial",
            "cell"          => "Celular",
            "email"         => "E-mail",
            "note"          => "Observação"
        );
        $validation = Validator::make($data,[
            "name"          => "required|string|max:256",
            "cpf"           => ['required','string','max:14',Rule::unique('clients')],
            "identity"      => ['string','max:32',Rule::unique('clients')],
            "cnh"           => ['required','string','max:32',Rule::unique('clients')],
            "dtcnh"         => "required|date"

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
            Client::create($data);
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
        return Client::leftJoin('states', 'clients.state_id','=','states.id')
                    ->leftJoin('cities','clients.city_id','=','cities.id')
                    ->select('clients.*','states.initial as state', 'cities.name as city')
                    ->where('clients.id','=',$id)
                    ->first();
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
        $attributeNames = array(
            "name"          => "Nome",
            "dtbirth"       => "Data de Nascimento",
            "cpf"           => "CPF",
            "identity"      => "Identidade",
            "cnh"           => "CNH",
            "dtcnh"         => "Data da CNH",
            "type_street"   => "Tipo de Logradouro",
            "street"        => "Logradouro",
            "number"        => "Número",
            "complement"    => "Complemento",
            "neighborhood"  => "Bairro",
            "city_id"       => "Cidade",
            "state_id"      => "Estado",
            "cep"           => "CEP",
            "tel_home"      => "Tel. Residencial",
            "tel_work"      => "Tel. Comercial",
            "cell"          => "Celular",
            "email"         => "E-mail",
            "note"          => "Observação"
        );
        $validation = Validator::make($data,[
            "name"          => "required|string|max:256",
            "cpf"           => ['required','string','max:14',Rule::unique('clients')->ignore($id)],
            "identity"      => ['string','max:32',Rule::unique('clients')->ignore($id)],
            "cnh"           => ['required','string','max:32',Rule::unique('clients')->ignore($id)],
            "dtcnh"         => "required|date"

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
            Client::find($id)->update($data);
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
        if(Gate::denies('delete_client')){
            alert()->html('Alerta','<h5>Usuário sem acesso para apagar este registro.</h5>','warning')
            ->autoClose(8000); 
            return redirect()->back();    
        }
        try{
            Client::find($id)->delete();
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

    /**
     * Page of profile client
     */
    public function profile($id)
    {
        $title = 'Perfil';
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Clientes','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);
        /** Clients and documents */    
        $client = Client::find($id);
        $clientDocs = DB::table('documents')
                        ->leftJoin('document_entities','documents.entity_id','=','document_entities.id')
                        ->leftJoin('document_types','documents.type_id','=','document_types.id')
                        ->where('document_entities.table','=','clients')
                        ->where('documents.identify','=',$id)
                        ->get();
        
        /** AITs and documents */                
        $clientAits = Ait::where('client_id','=',$id)->get();
        $aitIDs = array();
        foreach ($clientAits as $ait) {
            array_push($aitIDs, [$ait->id]);
        }
        $aitDocs = DB::table('documents')
                ->leftJoin('document_entities','documents.entity_id','=','document_entities.id')
                ->leftJoin('document_types','documents.type_id','=','document_types.id')
                ->where('document_entities.table','=','aits')
                ->whereIn('documents.identify',$aitIDs)
                ->get();
        
        /** Vehicles and documents */        
        $vehicleIDs = array();
        foreach ($client->vehicles as $vehicle) {
            array_push($vehicleIDs, [$vehicle->id]); 
        }
        $vehicleDocs = DB::table('documents')
                ->leftJoin('document_entities','documents.entity_id','=','document_entities.id')
                ->leftJoin('document_types','documents.type_id','=','document_types.id')
                ->where('document_entities.table','=','vehicles')
                ->whereIn('documents.identify',$vehicleIDs)
                ->get();
        
        /** Resources and documents */                
        $resourceIDs = array();
        foreach ($clientAits as $ait) {
            if($ait->resources){
                foreach ($ait->resources as $resource) {
                    array_push($resourceIDs, [$resource->id]);    
                }
            }            
        }
        $resourceDocs = DB::table('documents')
                ->leftJoin('document_entities','documents.entity_id','=','document_entities.id')
                ->leftJoin('document_types','documents.type_id','=','document_types.id')
                ->where('document_entities.table','=','ait_resources')
                ->whereIn('documents.identify',$resourceIDs)
                ->get();
        //dd($resourceDocs);
        return view('admin.client.profile', compact('title','list','client','clientDocs','clientAits','aitDocs','vehicleDocs','resourceDocs'));
    }
}
