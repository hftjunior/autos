<?php

namespace App\Http\Controllers\Vehicle;

use Gate;
use App\Models\VehicleModel;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class VehicleModelController extends Controller
{
    private $model;
    private $title;

    public function __construct(VehicleModel $model)
    {   
        $this->model = $model;
        $this->title = "Modelos de Veículos";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->model
                    ->join('manufacturers','vehicle_models.manufacturer_id','manufacturers.id')
                    ->select('vehicle_models.id as id','manufacturers.manufacturer','vehicle_models.model as model')
                    ->get();
        $manufacturers = Manufacturer::all();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Veículos','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('vehicle.model.index', compact('models','manufacturers','title','list'));
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
            "model"             => "Modelo",
            "manufacturer_id"   => "Marca"
        );
        $validation = Validator::make($data,[
            "model"             => ['required','string','max:191',Rule::unique('vehicle_models')],
            "manufacturer_id"   => ['required','numeric']
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
            VehicleModel::create($data);
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
        return VehicleModel::join('manufacturers','vehicle_models.manufacturer_id','manufacturers.id')
                    ->where('vehicle_models.id','=',$id)
                    ->select('vehicle_models.*','manufacturers.manufacturer as manufacturer')
                    ->first();
        //return VehicleModel::find($id);        
    }

    public function showRelManufacturer($manufacturer_id){
        return VehicleModel::where('manufacturer_id','=',$manufacturer_id)
                ->select('id','model')
                ->orderBy('model')
                ->get();
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
            "model"             => "Modelo",
            "manufacturer_id"   => "Marca"
        );
        $validation = Validator::make($data,[
            "model"             => ['required','string','max:191'],
            "manufacturer_id"   => ['required','numeric']
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
            VehicleModel::find($id)->update($data);
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
        if(Gate::denies('delete_vehicleCategory')){
            alert()->html('Alerta','<h5>Usuário sem acesso para apagar este registro.</h5>','warning')
            ->autoClose(8000);
            return redirect()->back();    
        }
        try{
            VehicleModel::find($id)->delete();
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
