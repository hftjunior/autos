@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Usuarios"
        v-bind:columns="['#','Nome','E-mail','Perfil','Status']"
        v-bind:items="{{ json_encode($users) }}"
        detail="/admin/users/"    
        edit="/admin/users/"    
        del="/admin/users/"    
        token="{{ csrf_token() }}" 
        modal="1">
    <span slot="btns">
        @can('create_user', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" paceholder="Nome" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" paceholder="E-mail" value="{{old('email')}}">
                </div> 
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" name="password" id="password" paceholder="Senha" value="{{old('password')}}">
                </div>
                <div class="form-group">
                    <label for="email">Perfil</label>
                    <select id="role" class="form-control" name="role" id="password" value="{{old('role')}}">
                        <option value=""></option>
                        @foreach($roles as $id => $role)
                        <option value="{{$id}}">{{$role}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="active" id="active" value="A" checked>Ativo
                        </label>
                    </div>
                </div>                
            </div>
        </page-form>
        <span slot="btns">
            @can('create_user', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/admin/users/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" paceholder="Nome" v-model="$store.state.item.name">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" paceholder="E-mail" v-model="$store.state.item.email">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label> 
                    <input type="password" class="form-control" name="password" id="password" paceholder="Senha">
                </div>
                <div class="form-group">
                        <label for="email">Perfil</label>
                        <select id="role" class="form-control" name="role" id="password" v-model="$store.state.item.role">
                            <option value=""></option>
                            @foreach($roles as $id => $role)
                            <option value="{{$id}}">{{$role}}</option>
                            @endforeach
                        </select>
                    </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="active" id="active" value="A" v-model="$store.state.item.active">Ativo
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="user-panel">
                        <div class="pull-left image">
                        <img :src="'../storage/users/' + $store.state.item.image" class="img-cicle">                        
                        </div>
                    </div>
                    <label for="image">Foto</label>
                    <input type="file" name="image" id="image">                    
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
                        <span class="info-box-text">Usuário</span>
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