<?php

namespace App\Http\Controllers\AitResource;

use Gate;
use App\Models\AitResource;
use App\Models\Ait;
use App\Models\Agency;
use App\Models\AitResourceStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AitResourceController extends Controller
{
    private $resource;
    private $title;
 
    public function __construct(AitResource $resource)
    {   
        $this->resource = $resource;
        $this->title = "Recursos"; 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = $this->resource
                    ->leftJoin('aits','ait_resources.ait_id','=','aits.id')
                    ->leftJoin('clients','aits.client_id','=','clients.id')
                    ->leftJoin('vehicles','aits.vehicle_id','=','vehicles.id')
                    ->leftJoin('ait_resource_statuses','ait_resources.status_id','=','ait_resource_statuses.id')
                    ->select('ait_resources.id as id','ait_resources.process as process',
                             'aits.number as number','clients.name as name','vehicles.placa as placa',
                             'ait_resources.date_resource as date_process', 'ait_resource_statuses.status as status') 
                    ->get();
        $agencies = Agency::orderBy('agency')->get();
        $aits = Ait::orderby('number')->get();
        $statuses = AitResourceStatus::orderBy('status')->get();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Recursos','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('ait.resource.resource.index', compact('resources','agencies','aits','statuses','title','list'));   
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
            "ait_id"        => "AIT",
            "agency_id"     => "Órgão Julgador",
            "instance"      => "Instância",
            "process"       => "Núm. do Processo",
            "protocol"      => "Protocolo",
            "date_resource" => "Data do Recurso",
            "date_judgment" => "Data do Julgamento",
            "status_id"     => "Situação do Recurso",
            "result"        => "Resultado"
        );
        $validation = Validator::make($data,[
            "ait_id"        => ['required','numeric'],
            "agency_id"     => ['required','numeric'],
            "process"       => ['required','string','max:191',Rule::unique('ait_resources')],
            "date_resource" => ['required','date'],
            "status_id"     => ['required','numeric']
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
            AitResource::create($data);
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
        return AitResource::leftJoin('ait_resource_statuses','ait_resources.status_id','=','ait_resource_statuses.id')
                            ->leftJoin('agencies','ait_resources.agency_id','=','agencies.id')
                            -> where ('ait_resources.id','=',$id)
                            -> select('ait_resources.*','ait_resource_statuses.status as status','agencies.agency as agency')
                            -> first();
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
            "ait_id"        => "AIT",
            "agency_id"     => "Órgão Julgador",
            "instance"      => "Instância",
            "process"       => "Núm. do Processo",
            "protocol"      => "Protocolo",
            "date_resource" => "Data do Recurso",
            "date_judgment" => "Data do Julgamento",
            "status_id"     => "Situação do Recurso",
            "result"        => "Resultado"
        );
        $validation = Validator::make($data,[
            "ait_id"        => ['required','numeric'],
            "agency_id"     => ['required','numeric'],
            "process"       => ['required','string','max:191',Rule::unique('ait_resources')->ignore($id)],
            "date_resource" => ['required','date'],
            "status_id"     => ['required','numeric']
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
            AitResource::find($id)->update($data);
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
        if(Gate::denies('delete_aitResource')){
            alert()->html('Alerta','<h5>Usuário sem acesso para apagar este registro.</h5>','warning')
            ->autoClose(8000);
            return redirect()->back();    
        }
        try{
            AitResource::find($id)->delete();
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
