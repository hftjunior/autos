@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
@if($errors->all())
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $key => $value)
            <li><strong>{{$value}}</strong>
        @endforeach
    </div>    
    @endif  
    <page-gridsearch 
        title="{{ $title }}"
        v-bind:columns="['#','Nome','Sigla','Estado']"
        v-bind:items="{{ json_encode($cities) }}"
        detail="/admin/cities/" edit="/admin/cities/" del="/admin/cities/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_city', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('cities.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" paceholder="Nome" value="{{old('name')}}">
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="initial">Sigla</label>
                            <input type="text" class="form-control" name="initial" id="initial" paceholder="Sigla" value="{{old('inital')}}">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="state_id">Estado</label>
                            <select class="form-control" name="state_id" id="state_id">
                                <option value="{{old('state_id')}}"></option>
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>                
            </div>
        </page-form>
        <span slot="btns">
            @can('create_city', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/admin/cities/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" paceholder="Nome" v-model="$store.state.item.name">
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="initial">Sigla</label>
                            <input type="text" class="form-control" name="initial" id="initial" paceholder="Sigla" v-model="$store.state.item.initial">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="state_id">Estado</label>
                            <select class="form-control" name="state_id" id="state_id" v-model="$store.state.item.state_id">
                                <option value=""></option>
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>                
            </div>
        </page-form>
        <span slot="btns">
            @can('update_city', User::class)
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
                        <span class="info-box-text">Estado</span>
                        <span class="info-box-number">@{{ $store.state.item.state_name }}</span>
                    </div>
                    <div class="col-sm-4 border-right">   
                        <span class="info-box-text">Cidade</span>
                        <span class="info-box-number">@{{ $store.state.item.name }}</span>
                    </div>
                    <div class="col-sm-4 border-right">   
                        <span class="info-box-text">Sigla</span>
                        <span class="info-box-number">@{{ $store.state.item.initial }}</span>
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