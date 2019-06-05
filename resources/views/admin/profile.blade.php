@extends('adminlte::page')

@section ('title', 'Meu Perfil')

@section('content_header')
    <h3>Perfil</h3>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="#">Administração</a></li>
        <li class="active"><a href="#">Perfil</a></li>
    </ol>
@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-check"></i>Alerta</h4>
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-ban"></i>Alerta</h4>
        {{ session('error') }}
    </div>
@endif
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Perfil</h3> <small>Edição</small>
        </div>
        <form role="form" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            <div class="box-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}" paceholder="Nome">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}" paceholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" name="password" id="password" paceholder="Senha">
                </div>
                <div class="form-group">
                    @if(auth()->user()->image != null)
                        <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ url('storage/users/'.auth()->user()->image) }}" class="img-cicle" alt="{{ auth()->user()->name }}">
                        </div>
                        </div>
                    @endif
                    <label for="image">Foto</label>
                    <input type="file" name="image" id="image">
                    <p class="help-block">Tamanho máximo do arquivo 500kb.<p>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Alterar</button>
            </div>
        </form>
    </div>
@stop