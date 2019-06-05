<?php

namespace App\Http\Controllers\Ait;

use Gate;
use App\Models\Ait;
use App\Models\Agency;
use App\Models\Client;
use App\Models\Vehicle;
use App\Models\AitStatus;
use App\Models\AitType;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AitController extends Controller
{
    private $ait;
    private $title;
 
    public function __construct(Ait $ait)
    {   
        $this->ait = $ait;
        $this->title = "Autos de Infração de Trânsito"; 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aits = $this->ait
                    ->leftJoin('vehicles','aits.vehicle_id','=','vehicles.id')
                    ->leftJoin('ait_types','aits.type_id','=','ait_types.id')
                    ->leftJoin('clients','aits.client_id','=','clients.id')
                    ->select('aits.id as id','aits.number as number', 'clients.name','ait_types.code as code',
                             'vehicles.placa as placa', 'aits.date as date', 
                             'aits.date_included as date_included','aits.deadline as deadline')
                    ->get();
        $agencies = Agency::orderBy('agency')->get();
        $clients = Client::orderBy('name')->get();
        $vehicles = Vehicle::orderBy('placa')->get();
        $statuses = AitStatus::orderBy('status')->get();
        $types = AitType::orderBy('code')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'AITs','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('ait.ait.index', compact('aits','agencies','clients','vehicles',
                                             'statuses','types','states','cities',
                                             'title','list'));    
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
            "agency_id"     => "Órgão",
            "client_id"     => "Condutor",
            "vehicle_id"    => "Veículo",
            "status_id"     => "Situação",
            "type_id"       => "Tipo de Infração",
            "date"          => "Data da Infração",
            "time"          => "Hora da Infração",
            "local"         => "Local da Infração",
            "state_id"      => "Estado",
            "city_id"       => "Cidade",
            "date_included" => "Data da Inclusão",
            "deadline"      => "Data Limite para Recurso",
            "number"        => "Número",
            "processing"    => "Processamento",
            "value"         => "Valor",
            "points"        => "Pontos",
        );
        $validation = Validator::make($data,[
            "agency_id"     => ['required','numeric'],
            "client_id"     => ['required','numeric'],
            "vehicle_id"    => ['required','numeric'],
            "status_id"     => ['required','numeric'],
            "type_id"       => ['required','numeric'],
            "date"          => ['required','date'],
            "time"          => ['required','string'],
            "local"         => ['required','string','max:191'],
            "state_id"      => ['required','numeric'],
            "city_id"       => ['required','numeric'],
            "date_included" => ['required','date'],
            "deadline"      => ['required','date'],
            "number"        => ['required','string','max:191',Rule::unique('aits')],
            "processing"    => ['required','numeric',Rule::unique('aits')],
            "value"         => ['required','numeric'],
            "points"        => ['required','numeric']
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
            Ait::create($data);
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
        return Ait::leftJoin('ait_types','aits.type_id','=','ait_types.id')
                    ->leftJoin('agencies','aits.agency_id','=','agencies.id')
                    ->leftJoin('clients','aits.client_id','=','clients.id')
                    ->leftJoin('vehicles','aits.vehicle_id','=','vehicles.id')
                    ->leftJoin('states','aits.state_id','=','states.id')
                    ->leftJoin('cities','aits.city_id','=','cities.id')
                    ->select('aits.*', 'ait_types.code as code','ait_types.description as description',
                             'agencies.agency as agency','clients.name as name','vehicles.placa as placa',
                             'states.initial as state','cities.name as city')
                    ->where('aits.id','=',$id)
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
            "agency_id"     => "Órgão",
            "client_id"     => "Condutor",
            "vehicle_id"    => "Veículo",
            "status_id"     => "Situação",
            "type_id"       => "Tipo de Infração",
            "date"          => "Data da Infração",
            "time"          => "Hora da Infração",
            "local"         => "Local da Infração",
            "state_id"      => "Estado",
            "city_id"       => "Cidade",
            "date_included" => "Data da Inclusão",
            "deadline"      => "Data Limite para Recurso",
            "number"        => "Número",
            "processing"    => "Processamento",
            "value"         => "Valor",
            "points"        => "Pontos",
        );
        $validation = Validator::make($data,[
            "agency_id"     => ['required','numeric'],
            "client_id"     => ['required','numeric'],
            "vehicle_id"    => ['required','numeric'],
            "status_id"     => ['required','numeric'],
            "type_id"       => ['required','numeric'],
            "date"          => ['required','date'],
            "time"          => ['required','string'],
            "local"         => ['required','string','max:191'],
            "state_id"      => ['required','numeric'],
            "city_id"       => ['required','numeric'],
            "date_included" => ['required','date'],
            "deadline"      => ['required','date'],
            "number"        => ['required','string','max:191',Rule::unique('aits')->ignore($id)],
            "processing"    => ['required','numeric',Rule::unique('aits')->ignore($id)],
            "value"         => ['required','numeric'],
            "points"        => ['required','numeric']
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
            Ait::find($id)->update($data);
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
        if(Gate::denies('delete_ait')){
            alert()->html('Alerta','<h5>Usuário sem acesso para apagar este registro.</h5>','warning')
            ->autoClose(8000);
            return redirect()->back();    
        }
        try{
            Ait::find($id)->delete();
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
