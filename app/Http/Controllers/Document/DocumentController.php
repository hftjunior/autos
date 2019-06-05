<?php

namespace App\Http\Controllers\Document;

use Gate;
use App\Models\Document;
use App\Models\DocumentEntity;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    private $document;
    private $title;

    public function __construct(Document $document)
    {
        $this->document = $document;
        $this->title = 'Documentos';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = $this->document
                    ->leftJoin('document_entities', 'documents.entity_id', '=', 'document_entities.id')
                    ->leftJoin('document_types', 'documents.type_id', '=', 'document_types.id')
                    ->select('documents.id as id','document_entities.entity as entity','document_types.type as type',
                             'documents.dtdocument as dtdocument','documents.expiration as expiration', 'documents.document as document',
                             'documents.entity_id','documents.identify')
                    ->get();
        $data = array();
        foreach ($documents as $document) {
            $entity = DocumentEntity::where('id', '=', $document->entity_id)->first();
            $table = $entity['table'];
            $fieldID = $entity['identifier'];
            $fieldName = $entity['name'];            
            $result = DB::table($table)
                        ->select($fieldID.' as id',$fieldName.' as name')
                        ->where ($fieldID, '=', $document->identify)
                        ->get();
            array_push($data, [ "id"        => $document->id,
                                "entity"    => $document->entity,
                                "name"      => $result[0]->name,
                                "type"      => $document->type,
                                "dtdocument"=> $document->dtdocument,
                                "expiration"=> $document->expiration
                                ]);
        }
        //dd(json_encode($data, ENT_COMPAT));
        $entities = DocumentEntity::orderBY('entity')->get();
        $types = DocumentType::orderBY('type')->get();
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')],
            ['page'=>'Documentos','url'=>'#'],
            ['page'=> $title,'url'=>'']
        ]);

        return view('document.document.index', compact('data','entities','types','title','list'));    
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
            "entity_id"     => "Entidade",
            "identify"      => "Identificador",
            "type_id"       => "Tipo",
            "document"      => "Documento",
            "dtdocument"    => "Data do Documento",
            "expiration"    => "Data de validade"
        );
        $messages = array(
            'unique' => "Documento já cadastrado"
        );
        $validation = Validator::make($data,[
            "entity_id"     => ['required','numeric'],
            "identify"      => ['required','string','max:191'],
            "type_id"       => ['required','numeric',Rule::unique('documents')->where('entity_id', $data['entity_id'])->where('identify', $data['identify'])],
            "document"      => ['required','file','mimes:pdf'],
            "dtdocument"    => ['required','date'],
            "expiration"    => ['nullable','date']
        ],$messages);
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

        /* ** Name of file **/
        $trans = array(
            "á" => "a", "à" => "a", "ã"	=> "a", "â" => "a",
            "é" => "e", "è" => "e", "ê" => "e", "ë" => "e",
            "í" => "i", "ì" => "i", "ï" => "i",
            "ó" => "o", "ò" => "o", "ô" => "o", "õ" => "o", "ö" => "o",
            "ú" => "u", "ù" => "u", "ü" => "u", "ç" => "c",
            "!" => "", "@" => "", "#" => "", "$" => "", "%" => "",
            "¨" => "", "&" => "", "*" => "", "(" => "", ")" => "",
            "+" => "", "=" => "", "§" => "", "[" => "", "]" => "",
            "{" => "", "}" => "", "´" => "", "`" => "", "^" => "",
            "~" => "", ":" => "", ";" => "", "?" => "", "<" => "",
            ">" => "", "," => "", "ª" => "", "º" => "", "°" => "",
            "¹" => "", "²" => "", "³" => "", "£" => "", "¢" => "",
            "¬" => "", "|" => ""
        );
        $entity = DocumentEntity::where('id','=',$data['entity_id'])->first();
        $entityName = kebab_case(strtolower($entity['entity']));
        $type = DocumentType::where('id','=', $data['type_id'])->first();
        $typeName = strtr(kebab_case(strtolower($type['initial'])),$trans);
        $pathFile = "documentos/".$entityName."/".$data['identify']."/".$typeName;
        $nameFile = strtr(kebab_case(strtolower($request->document->getClientOriginalName())),$trans);
        $upload = $request->document->storeAs($pathFile, $nameFile);
        if(!$upload){
            alert()->html('Alerta','<h5>Erro ao fazer upload da imagem.<h5>'.$message, 'error')
                ->showCancelButton('Fechar')
                ->autoClose(8000);
            return redirect()->back();
        }

        $data['document'] = $pathFile."/".$nameFile;

        /** database statment */        
        try{
            Document::create($data);
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
        return Document::find($id);
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
            "entity_id"     => "Entidade",
            "identify"      => "Identificador",
            "type_id"       => "Tipo",
            "document"      => "Documento",
            "dtdocument"    => "Data do Documento",
            "expiration"    => "Data de validade"
        );
        $validation = Validator::make($data,[
            "entity_id"     => ['required','numeric'],
            "identify"      => ['required','string','max:191'],
            "type_id"       => ['required','numeric'],
            "document"      => ['required','string','max:191'],
            "dtdocument"    => ['required','date'],
            "expiration"    => ['required','date']
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
            Document::find($id)->update($data);
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
        if(Gate::denies('delete_document')){
            alert()->html('Alerta','<h5>Usuário sem acesso para apagar este registro.</h5>','warning')
            ->autoClose(8000);
            return redirect()->back();    
        }
        $result = Document::find($id);
        if(file_exists(public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.$result->document)){
            if(@unlink(public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.$result->document) !== true){
                alert()->html('Alerta','Falha ao apagar o arquivo.','warning')
                ->autoClose(8000)
                ->toToast();
                return redirect()->back(); 
            }
        }    
        try{
            $result->delete();
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
