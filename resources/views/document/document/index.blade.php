@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Documentos"
        v-bind:columns="['#','Entidade','Nome','Tipo de Documento','Data Documento', 'Data Validade']"
        v-bind:items="{{ json_encode($data, ENT_COMPAT) }}"
        detail="" edit="/document/documents/" del="/document/documents/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_document', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="entity_id">Entidade</label>
                            <select class="form-control" name="entity_id" id="entity_id">
                                <option value="{{old('entity_id')}}"></option>
                                @foreach ($entities as $entity)
                                <option value="{{ $entity->id }}">{{$entity->entity}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="type_id">Tipo de Documento</label>
                            <select class="form-control" name="type_id" id="type_id">
                                <option value="{{old('type_id')}}"></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="dtdocument">Data do Documento:</label>
                            <input type="date" class="form-control" name="dtdocument" id="dtdocument" paceholder="Data do Documento" value="{{old('dtdocument')}}">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="expiration">Data de Vencimento:</label>
                            <input type="date" class="form-control" name="expiration" id="expiration" paceholder="Data de Vencimento" value="{{old('expiration')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="identify">Identificador</label>
                            <select class="form-control" name="identify" id="identify" value="{{old('expiration')}}">
                                <option value=""></option>                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="document">Documento</label>
                            <input type="file" name="document" id="document">
                        </div>
                    </div>
                </div>               
            </div>
        </page-form>
        <span slot="btns">
            @can('create_document', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/document/entities/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <object type="application/pdf" :data="'../storage/' + $store.state.item.document" width="100%" height="500"></object>
            </div>
        </page-form>
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
                <div class="row">
                    <div class="col-sm-9 border-right">   
                        <span class="info-box-text">Documento</span>
                        <span class="info-box-number">@{{ $store.state.item.document }}</span>
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

            $('select[id=entity_id]').change(function () {
                var idEntity = $(this).val();
                $.get('/document/entity-id/'+idEntity, function (entries) {
                    $('select[id=identify]').empty();
                    $.each(entries, function (key, value) {
                        $('select[id=identify]').append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                });
                $.get('/document/entity-type/'+idEntity, function (types) {
                    $('select[id=type_id]').empty();
                    $.each(types, function (key, value) {
                        $('select[id=type_id]').append('<option value=' + value.id + '>' + value.type + '</option>');
                    });
                });
            });
        });
    </script>
@stop