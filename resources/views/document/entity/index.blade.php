@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Tipos de Documentos"
        v-bind:columns="['#','Entidade','Tabela','Campo Identificador', 'Campo Nome']"
        v-bind:items="{{ json_encode($entities) }}"
        detail="/document/entities/" edit="/document/entities/" del="/document/entities/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_documentEntity', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('entities.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="entity">Entidade</label>
                    <input type="text" class="form-control" name="entity" id="entity" paceholder="Entidade" value="{{old('entity')}}">
                </div>
                <div class="form-group">
                    <label for="table">Tabela</label>
                    <input type="text" class="form-control" name="table" id="table" paceholder="Sigla" value="{{old('table')}}">
                </div>
                <div class="form-group">
                    <label for="identifier">Campo Identificador</label>
                    <input type="text" class="form-control" name="identifier" id="identifier" paceholder="Campo Identificador" value="{{old('identifier')}}">
                </div> 
                <div class="form-group">
                    <label for="name">Campo Nome:</label>
                    <input type="text" class="form-control" name="name" id="name" paceholder="Campo Nome" value="{{old('name')}}">
                </div>                
            </div>
        </page-form>
        <span slot="btns">
            @can('create_documentEntity', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/document/entities/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="entity">Entidade</label>
                    <input type="text" class="form-control" name="entity" id="entity" paceholder="Entidade" v-model="$store.state.item.entity">
                </div>
                <div class="form-group">
                    <label for="table">Tabela</label>
                    <input type="text" class="form-control" name="table" id="table" paceholder="Abreviação" v-model="$store.state.item.table">
                </div>  
                <div class="form-group">
                    <label for="identifier">Campo Identificador</label>
                    <input type="text" class="form-control" name="identifier" id="identifier" paceholder="campo Identificador" v-model="$store.state.item.identifier">
                </div>
                <div class="form-group">
                    <label for="name">Campo Nome:</label>
                    <input type="text" class="form-control" name="name" id="name" paceholder="Campo Nome" v-model="$store.state.item.name">
                </div>                            
            </div>
        </page-form>
        <span slot="btns">
            @can('update_documentEntity', User::class)
            <button form="formEdition" class="btn btn-info">Atualizar</button>
            @endcan
        </span>            
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
                <div class="row">
                    <div class="col-sm-9 border-right">   
                        <span class="info-box-text">Entidade</span>
                        <span class="info-box-number">@{{ $store.state.item.entity }} / @{{ $store.state.item.table }} / @{{ $store.state.item.identifier }}</span>
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