@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Perfis"
        v-bind:columns="['#','Nome','Slug']"
        v-bind:items="{{ json_encode($roles) }}"
        detail="/admin/roles/"    
        edit="/admin/roles/"    
        del="/admin/roles/"    
        token="{{ csrf_token() }}" 
        modal="1">
    <span slot="btns">
        @can('create_role', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">    
                        <div class="form-group">
                            <label for="name">Perfil</label>
                            <input type="text" class="form-control" name="name" id="name" paceholder="Nome" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" paceholder="Slug" value="{{old('slug')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Cadastros</a></li>
                            <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-car"></i> Veículos</a></li>
                            <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-tags"></i> AITs</a></li>
                            <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-legal"></i> Recursos</a></li>
                            <li><a href="#tab_5" data-toggle="tab"><i class="fa fa-file-text-o"></i> Documentos</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label>:: Perfis</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_role" value="view_role">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_role" value="create_role">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_role" value="update_role">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_role" value="delete_role">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Usuários</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_user" value="view_user">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_user" value="create_user">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_user" value="update_user">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_user" value="update_user">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Estados</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_state" value="view_state">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_state" value="create_state">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_state" value="update_state">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_state" value="delete_state">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">    
                                    <div class="form-group">
                                        <label>:: Cidades</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_city" value="view_city">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_city" value="create_city">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_city" value="update_city">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_city" value="delete_city">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Clientes</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_client" value="view_client">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_client" value="create_client">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_client" value="update_client">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_client" value="delete_client">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="tab-pane" id="tab_2">
                            <div class="row">
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label>:: Categorias</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_vehicleCategory" value="view_vehicleCategory">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_vehicleCategory" value="create_vehicleCategory">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_vehicleCategory" value="update_vehicleCategory">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_vehicleCategory" value="delete_vehicleCategory">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Tipos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_vehicleType" value="view_vehicleType">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_vehicleType" value="create_vehicleType">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_vehicleType" value="update_vehicleType">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_vehicleType" value="delete_vehicleType">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Espécies</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_vehicleSpecies" value="view_vehicleSpecies">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_vehicleSpecies" value="create_vehicleSpecies">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_vehicleSpecies" value="update_vehicleSpecies">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_vehicleSpecies" value="delete_vehicleSpecies">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">    
                                    <div class="form-group">
                                        <label>:: Combustíveis</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_fuel" value="view_fuel">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_fuel" value="create_fuel">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_fuel" value="update_fuel">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_fuel" value="delete_fuel">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Marcas</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_manufacturer" value="view_manufacturer">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_manufacturer" value="create_manufacturer">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_manufacturer" value="update_manufacturer">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_manufacturer" value="delete_manufacturer">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Modelos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_vehicleModel" value="view_vehicleModel">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_vehicleModel" value="create_vehicleModel">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_vehicleModel" value="update_vehicleModel">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_vehicleModel" value="delete_vehicleModel">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">    
                                    <div class="form-group">
                                        <label>:: Veículos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_vehicle" value="view_vehicle">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_vehicle" value="create_vehicle">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_vehicle" value="update_vehicle">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_vehicle" value="delete_vehicle">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="row">
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label>:: Órgãos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_agency" value="view_agency">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_agency" value="create_agency">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_agency" value="update_agency">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_agency" value="delete_agency">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Gravidades</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitGravity" value="view_aitGravity">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitGravity" value="create_aitGravity">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitGravity" value="update_aitGravity">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitGravity" value="delete_aitGravity">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Medidas Administrativas</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitMeasure" value="view_aitMeasure">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitMeasure" value="create_aitMeasure">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitMeasure" value="update_aitMeasure">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitMeasure" value="delete_aitMeasure">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">    
                                    <div class="form-group">
                                        <label>:: Situações</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitStatus" value="view_aitStatus">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitStatus" value="create_aitStatus">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitStatus" value="update_aitStatus">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitStatus" value="delete_aitStatus">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Tipos de Infrações</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitType" value="view_aitType">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitType" value="create_aitType">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitType" value="update_aitType">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitType" value="delete_aitType">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: AITs</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_ait" value="view_ait">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_ait" value="create_ait">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_ait" value="update_ait">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_ait" value="delete_ait">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="tab-pane" id="tab_4">
                            <div class="row">
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label>:: Situações</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitResourceStatus" value="view_aitResourceStatus">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitResourceStatus" value="create_aitResourceStatus">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitResourceStatus" value="update_aitResourceStatus">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitResourceStatus" value="delete_aitResourceStatus">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Recursos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitResource" value="view_aitResource">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitResource" value="create_aitResource">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitResource" value="update_aitResource">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitResource" value="delete_aitResource">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Origens da Informação</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitProgressOrigin" value="view_aitProgressOrigin">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitProgressOrigin" value="create_aitProgressOrigin">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitProgressOrigin" value="update_aitProgressOrigin">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitProgressOrigin" value="delete_aitProgressOrigin">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">    
                                    <div class="form-group">
                                        <label>:: Fontes da Informação</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitProgressMeans" value="view_aitProgressMeans">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitProgressMeans" value="create_aitProgressMeans">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitProgressMeans" value="update_aitProgressMeans">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitProgressMeans" value="delete_aitProgressMeans">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Andamentos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitResourceProgress" value="view_aitResourceProgress">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitResourceProgress" value="create_aitResourceProgress">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitResourceProgress" value="update_aitResourceProgress">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitResourceProgress" value="delete_aitResourceProgress">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="tab-pane" id="tab_5">
                            <div class="row">
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label>:: Tipos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_documentType" value="view_documentType">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_documentType" value="create_documentType">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_documentType" value="update_documentType">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_documentType" value="delete_documentType">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group"> 
                                        <label>:: Entidades</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_documentEntity" value="view_documentEntity">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_documentEntity" value="create_documentEntity">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_documentEntity" value="update_documentEntity">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_documentEntity" value="delete_documentEntity">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Documentos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_document" value="view_document">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_document" value="create_document">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_document" value="update_document">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_document" value="delete_document">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>                
            </div>
        </page-form>
        <span slot="btns">
            <button form="formCreation" class="btn btn-info">Salvar</button>
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/admin/roles/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">    
                        <div class="form-group">
                            <label for="name">Perfil</label>
                            <input type="text" class="form-control" name="name" id="name" paceholder="Nome" v-model="$store.state.item.name">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" paceholder="Slug" v-model="$store.state.item.slug">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_6" data-toggle="tab"><i class="fa fa-book"></i> Cadastros</a></li>
                            <li><a href="#tab_7" data-toggle="tab"><i class="fa fa-car"></i> Veículos</a></li>
                            <li><a href="#tab_8" data-toggle="tab"><i class="fa fa-tags"></i> AITs</a></li>
                            <li><a href="#tab_9" data-toggle="tab"><i class="fa fa-legal"></i> Recursos</a></li>
                            <li><a href="#tab_10" data-toggle="tab"><i class="fa fa-file-text-o"></i> Documentos</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_6">
                            <div class="row">
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label>:: Perfis</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_role" value="view_role" v-model="$store.state.item.view_role">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_role" value="create_role" v-model="$store.state.item.create_role">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_role" value="update_role" v-model="$store.state.item.update_role">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_role" value="delete_role" v-model="$store.state.item.delete_role">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Usuários</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_user" value="view_user" v-model="$store.state.item.view_user">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_user" value="create_user" v-model="$store.state.item.create_user">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_user" value="update_user" v-model="$store.state.item.update_user">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_user" value="delete_user" v-model="$store.state.item.delete_user">Apagar</label>
                                        </div><hr/> 
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Estados</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_state" value="view_state" v-model="$store.state.item.view_state">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_state" value="create_state" v-model="$store.state.item.create_state">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_state" value="update_state" v-model="$store.state.item.update_state">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_state" value="delete_state" v-model="$store.state.item.delete_state">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">    
                                    <div class="form-group">
                                        <label>:: Cidades</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_city" value="view_city" v-model="$store.state.item.view_city">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_city" value="create_city" v-model="$store.state.item.create_city">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_city" value="update_city" v-model="$store.state.item.update_city">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_city" value="delete_city" v-model="$store.state.item.delete_city">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Clientes</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_client" value="view_client" v-model="$store.state.item.view_client">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_client" value="create_client" v-model="$store.state.item.create_client">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_client" value="update_client" v-model="$store.state.item.update_client">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_client" value="delete_client" v-model="$store.state.item.delete_client">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="tab-pane" id="tab_7">
                            <div class="row">
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label>:: Categorias</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_vehicleCategory" value="view_vehicleCategory" v-model="$store.state.item.view_vehicleCategory">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_vehicleCategory" value="create_vehicleCategory" v-model="$store.state.item.create_vehicleCategory">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_vehicleCategory" value="update_vehicleCategory" v-model="$store.state.item.update_vehicleCategory">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_vehicleCategory" value="delete_vehicleCategory" v-model="$store.state.item.delete_vehicleCategory">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Tipos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_vehicleType" value="view_vehicleType" v-model="$store.state.item.view_vehicleType">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_vehicleType" value="create_vehicleType" v-model="$store.state.item.create_vehicleType">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_vehicleType" value="update_vehicleType" v-model="$store.state.item.update_vehicleType">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_vehicleType" value="delete_vehicleType" v-model="$store.state.item.delete_vehicleType">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Espécies</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_vehicleSpecies" value="view_vehicleSpecies" v-model="$store.state.item.view_vehicleSpecies">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_vehicleSpecies" value="create_vehicleSpecies" v-model="$store.state.item.create_vehicleSpecies">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_vehicleSpecies" value="update_vehicleSpecies" v-model="$store.state.item.update_vehicleSpecies">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_vehicleSpecies" value="delete_vehicleSpecies" v-model="$store.state.item.delete_vehicleSpecies">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">    
                                    <div class="form-group">
                                        <label>:: Combustíveis</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_fuel" value="view_fuel" v-model="$store.state.item.view_fuel">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_fuel" value="create_fuel" v-model="$store.state.item.create_fuel">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_fuel" value="update_fuel" v-model="$store.state.item.update_fuel">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_fuel" value="delete_fuel" v-model="$store.state.item.delete_fuel">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Marcas</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_manufacturer" value="view_manufacturer" v-model="$store.state.item.view_manufacturer">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_manufacturer" value="create_manufacturer" v-model="$store.state.item.create_manufacturer">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_manufacturer" value="update_manufacturer" v-model="$store.state.item.update_manufacturer">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_manufacturer" value="delete_manufacturer" v-model="$store.state.item.delete_manufacturer">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Modelos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_vehicleModel" value="view_vehicleModel" v-model="$store.state.item.view_vehicleModel">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_vehicleModel" value="create_vehicleModel" v-model="$store.state.item.create_vehicleModel">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_vehicleModel" value="update_vehicleModel" v-model="$store.state.item.update_vehicleModel">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_vehicleModel" value="delete_vehicleModel" v-model="$store.state.item.delete_vehicleModel">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">    
                                    <div class="form-group">
                                        <label>:: Veículos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_vehicle" value="view_vehicle" v-model="$store.state.item.view_vehicle">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_vehicle" value="create_vehicle" v-model="$store.state.item.create_vehicle">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_vehicle" value="update_vehicle" v-model="$store.state.item.update_vehicle">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_vehicle" value="delete_vehicle" v-model="$store.state.item.delete_vehicle">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="tab-pane" id="tab_8">
                            <div class="row">
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label>:: Órgãos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_agency" value="view_agency" v-model="$store.state.item.view_agency">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_agency" value="create_agency" v-model="$store.state.item.create_agency">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_agency" value="update_agency" v-model="$store.state.item.update_agency">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_agency" value="delete_agency" v-model="$store.state.item.delete_agency">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Gravidades</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitGravity" value="view_aitGravity" v-model="$store.state.item.view_aitGravity">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitGravity" value="create_aitGravity" v-model="$store.state.item.create_aitGravity">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitGravity" value="update_aitGravity" v-model="$store.state.item.update_aitGravity">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitGravity" value="delete_aitGravity" v-model="$store.state.item.delete_aitGravity">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Medidas Administrativas</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitMeasure" value="view_aitMeasure" v-model="$store.state.item.view_aitMeasure">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitMeasure" value="create_aitMeasure" v-model="$store.state.item.create_aitMeasure">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitMeasure" value="update_aitMeasure" v-model="$store.state.item.update_aitMeasure">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitMeasure" value="delete_aitMeasure" v-model="$store.state.item.delete_aitMeasure">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">    
                                    <div class="form-group">
                                        <label>:: Situações</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitStatus" value="view_aitStatus" v-model="$store.state.item.view_aitStatus">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitStatus" value="create_aitStatus" v-model="$store.state.item.create_aitStatus">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitStatus" value="update_aitStatus" v-model="$store.state.item.update_aitStatus">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitStatus" value="delete_aitStatus" v-model="$store.state.item.delete_aitStatus">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Tipos de Infrações</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitType" value="view_aitType" v-model="$store.state.item.view_aitType">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitType" value="create_aitType" v-model="$store.state.item.create_aitType">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitType" value="update_aitType" v-model="$store.state.item.update_aitType">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitType" value="delete_aitType" v-model="$store.state.item.delete_aitType">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: AITs</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_ait" value="view_ait" v-model="$store.state.item.view_ait">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_ait" value="create_ait" v-model="$store.state.item.create_ait">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_ait" value="update_ait" v-model="$store.state.item.update_ait">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_ait" value="delete_ait" v-model="$store.state.item.delete_ait">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="tab-pane" id="tab_9">
                            <div class="row">
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label>:: Situações</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitResourceStatus" value="view_aitResourceStatus" v-model="$store.state.item.view_aitResourceStatus">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitResourceStatus" value="create_aitResourceStatus" v-model="$store.state.item.create_aitResourceStatus">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitResourceStatus" value="update_aitResourceStatus" v-model="$store.state.item.update_aitResourceStatus">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitResourceStatus" value="delete_aitResourceStatus" v-model="$store.state.item.delete_aitResourceStatus">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Recursos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitResource" value="view_aitResource" v-model="$store.state.item.view_aitResource">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitResource" value="create_aitResource" v-model="$store.state.item.create_aitResource">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitResource" value="update_aitResource" v-model="$store.state.item.update_aitResource">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitResource" value="delete_aitResource" v-model="$store.state.item.delete_aitResource">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Origens da Informação</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitProgressOrigin" value="view_aitProgressOrigin" v-model="$store.state.item.view_aitProgressOrigin">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitProgressOrigin" value="create_aitProgressOrigin" v-model="$store.state.item.create_aitProgressOrigin">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitProgressOrigin" value="update_aitProgressOrigin" v-model="$store.state.item.update_aitProgressOrigin">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitProgressOrigin" value="delete_aitProgressOrigin" v-model="$store.state.item.delete_aitProgressOrigin">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">    
                                    <div class="form-group">
                                        <label>:: Fontes da Informação</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitProgressMeans" value="view_aitProgressMeans" v-model="$store.state.item.view_aitProgressMeans">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitProgressMeans" value="create_aitProgressMeans" v-model="$store.state.item.create_aitProgressMeans">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitProgressMeans" value="update_aitProgressMeans" v-model="$store.state.item.update_aitProgressMeans">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitProgressMeans" value="delete_aitProgressMeans" v-model="$store.state.item.delete_aitProgressMeans">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Andamentos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_aitResourceProgress" value="view_aitResourceProgress" v-model="$store.state.item.view_aitResourceProgress">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_aitResourceProgress" value="create_aitResourceProgress" v-model="$store.state.item.create_aitResourceProgress">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_aitResourceProgress" value="update_aitResourceProgress" v-model="$store.state.item.update_aitResourceProgress">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_aitResourceProgress" value="delete_aitResourceProgress" v-model="$store.state.item.delete_aitResourceProgress">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="tab-pane" id="tab_10">
                            <div class="row">
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label>:: Tipos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_documentType" value="view_documentType" v-model="$store.state.item.view_documentType">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_documentType" value="create_documentType" v-model="$store.state.item.create_documentType">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_documentType" value="update_documentType" v-model="$store.state.item.update_documentType">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_documentType" value="delete_documentType" v-model="$store.state.item.delete_documentType">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Entidades</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_documentEntity" value="view_documentEntity" v-model="$store.state.item.view_documentEntity">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_documentEntity" value="create_documentEntity" v-model="$store.state.item.create_documentEntity">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_documentEntity" value="update_documentEntity" v-model="$store.state.item.update_documentEntity">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_documentEntity" value="delete_documentEntity" v-model="$store.state.item.delete_documentEntity">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div> 
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>:: Documentos</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permissions[]" id="view_document" value="view_document" v-model="$store.state.item.view_document">Visualizar</label>
                                            <label><input type="checkbox" name="permissions[]" id="create_document" value="create_document" v-model="$store.state.item.create_document">Criar</label>
                                            <label><input type="checkbox" name="permissions[]" id="update_document" value="update_document" v-model="$store.state.item.update_document">Editar</label>
                                            <label><input type="checkbox" name="permissions[]" id="delete_document" value="delete_document" v-model="$store.state.item.delete_document">Apagar</label>
                                        </div><hr/>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>                
            </div>
        </page-form>
        <span slot="btns">
            @can('update_user', User::class)
            <button form="formEdition" class="btn btn-info">Atualizar</button>
            @endcan
        </span>            
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
                <div class="row">
                    <div class="col-sm-4 border-right">   
                        <span class="info-box-text">Perfil</span>
                        <span class="info-box-number">@{{ $store.state.item.name }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-file-o"></i> Criado em: @{{ $store.state.item.created_at }}</button>
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Alterado em: @{{ $store.state.item.updated_at }}</button>
            <span class="pull-right text-muted"></span>
        </div>          
    </modal>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#gridlist').dataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                'language'    : {
                    'url'         : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                }
            });
        });
    </script>
@stop