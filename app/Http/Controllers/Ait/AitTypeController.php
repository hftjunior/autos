<?php

namespace App\Http\Controllers\Ait;

use Gate;
use App\Models\AitType;
use App\Models\AitGravity;
use App\Models\AitMeasure;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AitTypeController extends Controller
{
    private $type;
    private $title;
 
    public function __construct(AitType $type)
    {   
        $this->type = $type;
        $this->title = "Tipos de Infrações"; 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = $this->type
                    ->select('id','code','description','points','value')
                    ->get();
        $gravities = AitGravity::orderBy('gravity')->get();
        $measures = AitMeasure::orderBy('measure')->get();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'AITs','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('ait.type.index', compact('types','gravities','measures','title','list'));   
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
            "code"          => "Código",
            "description"   => "Infração",
            "legal"         => "Amparo Legal",
            "points"        => "Pontos",
            "value"         => "Valor",
            "gravity_id"    => "Gravidade",
            "measure_id"    => "Medidas Administrativas"
        );
        $validation = Validator::make($data,[
            "code"          => ['required','string','max:191',Rule::unique('ait_types')],
            "description"   => ['required','string'],
            "legal"         => ['required','string'],
            "points"        => ['required','numeric'],
            "value"         => ['required','numeric']
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
            AitType::create($data);
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
        return AitType::leftJoin('ait_gravities','ait_types.gravity_id','=','ait_gravities.id')
                        ->leftJoin('ait_measures','ait_types.measure_id','=','ait_measures.id')
                        ->select('ait_types.*','ait_gravities.gravity as gravity', 'ait_measures.measure as measure')
                        ->where('ait_types.id','=',$id)
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
            "code"          => "Código",
            "description"   => "Infração",
            "legal"         => "Amparo Legal",
            "points"        => "Pontos",
            "value"         => "Valor",
            "gravity_id"    => "Gravidade",
            "measure_id"    => "Medidas Administrativas"
        );
        $validation = Validator::make($data,[
            "code"          => ['required','string','max:191',Rule::unique('ait_types')->ignore($id)],
            "description"   => ['required','string'],
            "legal"         => ['required','string'],
            "points"        => ['required','numeric'],
            "value"         => ['required','numeric']
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
            AitType::find($id)->update($data);
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
        if(Gate::denies('delete_aitType')){
            alert()->html('Alerta','<h5>Usuário sem acesso para apagar este registro.</h5>','warning')
            ->autoClose(8000);
            return redirect()->back();    
        }
        try{
            AitType::find($id)->delete();
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
