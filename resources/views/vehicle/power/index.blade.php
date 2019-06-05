@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Potência de Veículos"
        v-bind:columns="['#','Potência', 'Unidade']"
        v-bind:items="{{ json_encode($powers) }}"
        detail="/vehicle/powers/" edit="/vehicle/powers/" del="/vehicle/powers/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('powers.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="power">Potência</label>
                    <input type="number" class="form-control" name="power" id="power" paceholder="Potência" value="{{old('power')}}">
                </div>
                <div class="form-group">
                    <label for="unity">Unidade</label>
                    <select class="form-control" name="unity" id="unity" value="{{old('unity')}}">
                        <option value=""></option>
                        <option value="cv">cv</option>
                    </select>
                </div>
            </div>
        </page-form>
        <span slot="btns">
            <button form="formCreation" class="btn btn-info">Salvar</button>
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/vehicle/powers/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="power">Potência</label>
                    <input type="number" class="form-control" name="power" id="power" paceholder="Potência" v-model="$store.state.item.power">
                </div>
                <div class="form-group">
                    <label for="unity">Unidade</label>
                    <select class="form-control" name="unity" id="unity" v-model="$store.state.item.unity">
                        <option value=""></option>
                        <option value="cv">cv</option>
                    </select>
                </div>
            </div>
        </page-form>
        <span slot="btns">
            <button form="formEdition" class="btn btn-info">Atualizar</button>
        </span>            
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-car"></i></span>
            <div class="info-box-content">
                <div class="row">
                    <div class="col-sm-4 border-right">   
                        <span class="info-box-text">Potência</span>
                        <span class="info-box-number">@{{ $store.state.item.power }} @{{ $store.state.item.unity }}</span>
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
            $('[data-mask]').inputmask();
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