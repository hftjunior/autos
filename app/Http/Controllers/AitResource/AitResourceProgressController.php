<?php

namespace App\Http\Controllers\AitResource;

use Gate;
use App\Models\AitResourceProgress;
use App\Models\AitResource;
use App\Models\AitProgressMeans;
use App\Models\AitProgressOrigin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AitResourceProgressController extends Controller
{
    private $progress;
    private $title;
 
    public function __construct(AitResourceProgress $progress)
    {   
        $this->progress = $progress;
        $this->title = "Andamentos dos Recursos"; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $progresses = $this->progress
                    ->leftJoin('ait_resources','ait_resource_progresses.resource_id','=','ait_resources.id')
                    ->leftJoin('aits','ait_resources.ait_id','=','aits.id')
                    ->leftJoin('clients','aits.client_id','=','clients.id')
                    ->select('ait_resource_progresses.id as id','ait_resource_progresses.date as date',
                             'ait_resource_progresses.time as time','ait_resources.process as process',
                             'ait_resource_progresses.progress as progress')
                    ->get();
        $resources = AitResource::orderBy('process')->get();
        $devices = AitProgressMeans::orderBy('device')->get();
        $origins = AitProgressOrigin::orderBy('origin')->get();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Recursos','url'=>'#'],
            ['page'=>'Andamentos','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('ait.resource.progress.progress.index', compact('progresses','resources','devices','origins','title','list'));     
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
            "resource_id"   => "Recurso",
            "date"          => "Data",
            "time"          => "Hora",
            "origin_id"     => "Origem da Informação",
            "means_id"      => "Fonte da Informação",
            "progress"      => "Andamento"
        );
        $validation = Validator::make($data,[
            "resource_id"   => ['required','numeric'],
            "date"          => ['required','date'],
            "time"          => ['required','string'],
            "origin_id"     => ['required','numeric'],
            "means_id"      => ['required','numeric'],
            "progress"      => ['required','string']
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
            AitResourceProgress::create($data);
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
        return AitResourceProgress::leftJoin('ait_resources','ait_resource_progresses.resource_id','=','ait_resources.id')
                            ->leftJoin('ait_resource_statuses','ait_resources.status_id','=','ait_resource_statuses.id')
                            ->leftJoin('ait_progress_means','ait_resource_progresses.means_id','=','ait_progress_means.id')
                            ->leftJoin('ait_progress_origins','ait_resource_progresses.origin_id','=','ait_progress_origins.id')
                            ->select('ait_resource_progresses.*','ait_resources.process as process','ait_resource_statuses.status as status',
                                     'ait_progress_means.device as device','ait_progress_origins.origin as origin')
                            ->where('ait_resource_progresses.id','=', $id)
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
            "resource_id"   => "Recurso",
            "date"          => "Data",
            "time"          => "Hora",
            "origin_id"     => "Origem da Informação",
            "means_id"      => "Fonte da Informação",
            "progress"      => "Andamento"
        );
        $validation = Validator::make($data,[
            "resource_id"   => ['required','numeric'],
            "date"          => ['required','date'],
            "time"          => ['required','string'],
            "origin_id"     => ['required','numeric'],
            "means_id"      => ['required','numeric'],
            "progress"      => ['required','string']
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
            AitResourceProgress::find($id)->update($data);
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
        if(Gate::denies('delete_aitResourceProgress')){
            alert()->html('Alerta','<h5>Usuário sem acesso para apagar este registro.</h5>','warning')
            ->autoClose(8000);
            return redirect()->back();    
        }
        try{
            AitResourceProgress::find($id)->delete();
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
