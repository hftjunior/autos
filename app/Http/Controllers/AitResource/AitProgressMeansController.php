<?php

namespace App\Http\Controllers\AitResource;

use Gate;
use App\Models\AitProgressMeans;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AitProgressMeansController extends Controller
{
    private $device;
    private $title;
 
    public function __construct(AitProgressMeans $device)
    {   
        $this->device = $device;
        $this->title = "Fontes de Informações"; 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = $this->device
                    ->select('id','device')
                    ->get();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Recursos','url'=>'#'],
            ['page'=>'Andamentos','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('ait.resource.progress.means.index', compact('devices','title','list'));
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
            "device"     => "Fonte de Informação"
        );
        $validation = Validator::make($data,[
            "device"      => ['required','string','max:191',Rule::unique('ait_progress_means')]
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
            AitProgressMeans::create($data);
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
        return AitProgressMeans::find($id);
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
            "device"     => "Fonte de Informação"
        );
        $validation = Validator::make($data,[
            "device"      => ['required','string','max:191',Rule::unique('ait_progress_means')->ignore($id)]
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
            AitProgressMeans::find($id)->update($data);
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
            AitProgressMeans::find($id)->delete();
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
