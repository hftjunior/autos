<?php

namespace App\Http\Controllers\Vehicle;

use Gate;
use App\Models\Vehicle;
use App\Models\Client;
use App\Models\State;
use App\Models\City;
use App\Models\VehicleSpecies;
use App\Models\VehicleType;
use App\Models\Manufacturer;
use App\Models\VehicleModel;
use App\Models\VehiclePower;
use App\Models\VehicleCylinder;
use App\Models\VehicleCategory;
use App\Models\Fuel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    private $vehicle;
    private $title;

    public function __construct(Vehicle $vehicle)
    {   
        $this->vehicle = $vehicle;
        $this->title = "Veículos";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = $this->vehicle
                    ->select('vehicles.id as id','clients.name as name', 'vehicles.placa as placa',
                             'vehicles.renavam as renavam','vehicles.chassi as chassi','manufacturers.manufacturer as manufacturer',
                             'vehicle_models.model')
                    ->join('clients','vehicles.client_id','=','clients.id')
                    ->join('manufacturers','vehicles.manufacturer_id','=','manufacturers.id')
                    ->join('vehicle_models','vehicles.model_id','=','vehicle_models.id')
                    ->orderBy('name')
                    ->get();
        $clients = Client::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $species = VehicleSpecies::orderBy('specie')->get();
        $types = VehicleType::orderBy('type')->get();
        $manufacturers = Manufacturer::orderBy('manufacturer')->get();
        $models = VehicleModel::orderBy('model')->get();
        $categories = VehicleCategory::orderBy('category')->get();
        $fuels = Fuel::orderBy('fuel')->get();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Veículos','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('vehicle.vehicle.index', compact('vehicles','clients','states','cities',
                                                     'species','types','manufacturers','models',
                                                     'categories','fuels',
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
            "renavam"           => "Renavam",
            "client_id"         => "Cliente",
            "placa"             => "Placa",
            "state_id"          => "Estado",
            "city_id"           => "Cidade",
            "chassi"            => "Chassi",
            "specie_id"         => "Espécie",
            "type_id"           => "Tipo",
            "manufacturer_id"   => "Marca",
            "model_id"          => "Modelo",
            "yearmanufacture"   => "Ano de Fabricação",
            "yearmodel"         => "Ano do Modelo",
            "capacity"          => "Capacidade",
            "power"             => "Potência",
            "cylinder"          => "Cilindradas",
            "category_id"       => "Categoria",
            "fuel_id"           => "Combustível",
            "note"              => "Observações"
        );
        $validation = Validator::make($data,[
            "renavam"           => ['required','numeric',Rule::unique('vehicles')],
            "client_id"         => ['required','numeric'],
            "placa"             => ['required','string','max:191',Rule::unique('vehicles')],
            "state_id"          => ['required','numeric'],
            "city_id"           => ['required','numeric'],
            "manufacturer_id"   => ['required','numeric'],
            "model_id"          => ['required','numeric'],
            "cylinder"          => ['required','numeric'],
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
            Vehicle::create($data);
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
        return Vehicle::select('vehicles.*','manufacturers.manufacturer as manufacturer',
                               'vehicle_models.model as model', 'clients.name as name',
                               'states.name as state', 'cities.name as city')
                        ->join ('manufacturers','vehicles.manufacturer_id','=','manufacturers.id')
                        ->join ('vehicle_models','vehicles.model_id','=','vehicle_models.id')
                        ->join ('states','vehicles.state_id','=','states.id')
                        ->join ('clients','client_id','=','clients.id')
                        ->join ('cities','vehicles.city_id','=','cities.id')
                        ->where('vehicles.id','=',$id)
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
            "renavam"           => "Renavam",
            "client_id"         => "Cliente",
            "placa"             => "Placa",
            "state_id"          => "Estado",
            "city_id"           => "Cidade",
            "chassi"            => "Chassi",
            "specie_id"         => "Espécie",
            "type_id"           => "Tipo",
            "manufacturer_id"   => "Marca",
            "model_id"          => "Modelo",
            "yearmanufacture"   => "Ano de Fabricação",
            "yearmodel"         => "Ano do Modelo",
            "capacity"          => "Capacidade",
            "power"             => "Potência",
            "cylinder"          => "Cilindradas",
            "category_id"       => "Categoria",
            "fuel_id"           => "Combustível",
            "note"              => "Observações"
        );
        $validation = Validator::make($data,[
            "renavam"           => ['required','numeric',Rule::unique('vehicles')->ignore($id)],
            "client_id"         => ['required','numeric'],
            "placa"             => ['required','string','max:191',Rule::unique('vehicles')->ignore($id)],
            "state_id"          => ['required','numeric'],
            "city_id"           => ['required','numeric'],
            "manufacturer_id"   => ['required','numeric'],
            "model_id"          => ['required','numeric'],
            "cylinder"          => ['required','numeric'],
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
            Vehicle::find($id)->update($data);
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
        if(Gate::denies('delete_vehicle')){
            alert()->html('Alerta','<h5>Usuário sem acesso para apagar este registro.</h5>','warning')
            ->autoClose(8000);
            return redirect()->back();    
        }
        try{
            Vehicle::find($id)->delete();
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
