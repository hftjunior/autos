@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Tipos de Documentos"
        v-bind:columns="['#','Tipo','Abreviação','Entidade']"
        v-bind:items="{{ json_encode($types) }}"
        detail="/document/doc-types/" edit="/document/doc-types/" del="/document/doc-types/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_documentType', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('doc-types.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="entity_id">Entidade</label>
                    <select class="form-control" name="entity_id" id="entity_id" value="{{old('entity_id')}}">
                        <option value=""></option>
                        @foreach ($entities as $entity)
                        <option value="{{ $entity->id }}">{{$entity->entity}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <input type="text" class="form-control" name="type" id="type" paceholder="Tipo" value="{{old('type')}}">
                </div>
                <div class="form-group">
                    <label for="initial">Abreviação</label>
                    <input type="text" class="form-control" name="initial" id="initial" paceholder="Sigla" value="{{old('inital')}}">
                </div>                
            </div>
        </page-form>
        <span slot="btns">
            @can('create_documentType', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/document/doc-types/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="entity_id">Entidade</label>
                    <select class="form-control" name="entity_id" id="entity_id" v-model="$store.state.item.entity_id">
                        <option value=""></option>
                        @foreach ($entities as $entity)
                        <option value="{{ $entity->id }}">{{$entity->entity}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <input type="text" class="form-control" name="type" id="type" paceholder="Tipo" v-model="$store.state.item.type">
                </div>
                <div class="form-group">
                    <label for="initial">Abreviação</label>
                    <input type="text" class="form-control" name="initial" id="initial" paceholder="Abreviação" v-model="$store.state.item.initial">
                </div>                
            </div>
        </page-form>
        <span slot="btns">
            @can('update_documentType', User::class)
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
                        <span class="info-box-text">Tipo de Documento</span>
                        <span class="info-box-number">@{{ $store.state.item.type }} / @{{ $store.state.item.initial }}</span>
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