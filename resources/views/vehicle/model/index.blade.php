@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="{{ $title }}"
        v-bind:columns="['#','Marca','Modelo']"
        v-bind:items="{{ json_encode($models) }}"
        detail="/vehicle/models/" edit="/vehicle/models/" del="/vehicle/models/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_vehicleModel', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('models.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="manufacturer_id">Marca</label>
                    <select class="form-control" name="manufacturer_id" id="manufacturer_id">
                        <option value="{{old('manufacturer_id')}}"></option>
                        @foreach ($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}">{{$manufacturer->manufacturer}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="model">Modelo</label>
                    <input type="text" class="form-control" name="model" id="model" paceholder="Modelo" value="{{old('model')}}">
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('create_vehicleModel', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/vehicle/models/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="manufacturer_id">Marca</label>
                    <select class="form-control" name="manufacturer_id" id="manufacturer_id" v-model="$store.state.item.manufacturer_id">
                        <option value=""></option>
                        @foreach ($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}">{{$manufacturer->manufacturer}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="model">Modelo</label>
                    <input type="text" class="form-control" name="model" id="model" paceholder="Modelo" v-model="$store.state.item.model">
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('update_vehicleModel', User::class)
            <button form="formEdition" class="btn btn-info">Atualizar</button>
            @endcan
        </span>            
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-car"></i></span>

            <div class="info-box-content">
                <div class="row">
                    <div class="col-sm-4 border-right">   
                        <span class="info-box-text">Marca</span>
                        <span class="info-box-number">@{{ $store.state.item.manufacturer }}</span>
                    </div>
                    <div class="col-sm-4 border-right">   
                        <span class="info-box-text">Modelo</span>
                        <span class="info-box-number">@{{ $store.state.item.model }}</span>
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