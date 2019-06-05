<?php

namespace App\Http\Controllers\Vehicle;

use App\Models\VehicleCylinder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class VehicleCylinderController extends Controller
{
    private $cylinder;
    private $title;

    public function __construct(VehicleCylinder $cylinder)
    {   
        $this->cylinder = $cylinder;
        $this->title = "Cilindradas de Veículos";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cylinders = $this->cylinder
                    ->select('id','cylinder','unity')
                    ->get();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Veículos','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('vehicle.cylinder.index', compact('cylinders','title','list'));
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
            "cylinder"  => "Cilindradas",
            "unity"     => "Unidade"
        );
        $validation = Validator::make($data,[
            "cylinder"   => ['required','string','max:191',Rule::unique('vehicle_cylinders')],
            "unity"      => ['required','string','max:191']
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

        $result = VehicleCylinder::create($data);
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
        return VehicleCylinder::find($id);
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
            "cylinder"  => "Cilindradas",
            "unity"     => "Unidade"
        );
        $validation = Validator::make($data,[
            "cylinder"   => ['required','string','max:191',Rule::unique('vehicle_cylinders')->ignore($id)],
            "unity"      => ['required','string','max:191']
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
        $result = VehicleCylinder::find($id)->update($data);
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
        $result = VehicleCylinder::find($id)->delete();
        if($result){
            alert()->html('Alerta','<h5>Registro apagado com sucesso.</h5>','success')
                   ->autoClose(8000)
                   ->toToast();
            return redirect()->back();
        }
        alert()->html('Alerta','Falha ao apagar o registro.','warning')
               ->autoClose(8000)
               ->toToast();
        return redirect()->back();
    }
}
