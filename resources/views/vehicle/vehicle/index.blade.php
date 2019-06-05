@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="{{ $title }}"
        v-bind:columns="['#','Cliente','Placa','Renavam','Chassi','Marca','Modelo']"
        v-bind:items="{{ json_encode($vehicles) }}"
        detail="/vehicle/vehicles/" edit="/vehicle/vehicles/" del="/vehicle/vehicles/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_vehicle', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('vehicles.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Dados</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Especificações</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Observações</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="form-group">
                                <label for="client_id">Cliente</label>
                                <select class="form-control" name="client_id" id="client_id">
                                    <option value="{{old('client_id')}}"></option>
                                    @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="placa">Placa</label>
                                        <input type="text" class="form-control" name="placa" id="placa" paceholder="Placa" value="{{old('placa')}}">
                                    </div>
                                </div>
                                <div class="col-xs-4">
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
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="city_id">Cidade</label>
                                        <select class="form-control" name="city_id" id="city_id">
                                            <option value="{{old('city_id')}}"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="renavam">Renavam</label>
                                        <input type="number" class="form-control" name="renavam" id="renavam" paceholder="Renavam" value="{{old('renavam')}}">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="chassi">Chassi</label>
                                        <input type="text" class="form-control" name="chassi" id="chassi" paceholder="Chassi" value="{{old('chassi')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="manufacturer_id">Marca</label>
                                        <select class="form-control" name="manufacturer_id" id="manufacturer_id">
                                            <option value="{{old('manufacturer_id')}}"></option>
                                            @foreach ($manufacturers as $manufacturer)
                                            <option value="{{ $manufacturer->id }}">{{$manufacturer->manufacturer}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="model_id">Modelo</label>
                                        <select class="form-control" name="model_id" id="model_id">
                                            <option value="{{old('model_id')}}"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="specie_id">Espécie</label>
                                        <select class="form-control" name="specie_id" id="specie_id">
                                            <option value="{{old('specie_id')}}"></option>
                                            @foreach ($species as $specie)
                                            <option value="{{ $specie->id }}">{{$specie->specie}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="type_id">Tipo</label>
                                        <select class="form-control" name="type_id" id="type_id">
                                            <option value="{{old('type_id')}}"></option>
                                            @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{$type->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="category_id">Categoria</label>
                                        <select class="form-control" name="category_id" id="category_id">
                                            <option value="{{old('category_id')}}"></option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{$category->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="yearmanufacture">Ano de Fabricação</label>
                                        <input type="number" class="form-control" name="yearmanufacture" id="yearmanufacture" paceholder="Ano de Fabricação" value="{{old('yearmanufacture')}}">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="yearmodel">Ano do Modelo</label>
                                        <input type="number" class="form-control" name="yearmodel" id="yearmodel" paceholder="Ano do Modelo" value="{{old('yearmodel')}}">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="capacity">Capacidade</label>
                                        <input type="number" class="form-control" name="capacity" id="capacity" paceholder="Capacidade" value="{{old('capacity')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">    
                                    <div class="form-group">
                                        <label for="power">Potência (cv)</label>
                                        <input type="number" class="form-control" name="power" id="power" paceholder="Potência (cv)" step="any" pattern="^\d*(\.\d{0,2})?$" value="{{old('power')}}">
                                    </div>
                                </div>
                                <div class="col-xs-4"> 
                                    <div class="form-group">
                                        <label for="cylinder">Cilindradas (l)</label>
                                        <input type="number" class="form-control" name="cylinder" id="cylinder" paceholder="Cilindradas (l)" step="any" pattern="^\d*(\.\d{0,2})?$" value="{{old('cylinder')}}">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="fuel_id">Combustível</label>
                                        <select class="form-control" name="fuel_id" id="fuel_id">
                                            <option value="{{old('fuel_id')}}"></option>
                                            @foreach ($fuels as $fuel)
                                            <option value="{{ $fuel->id }}">{{$fuel->fuel}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="form-group">
                                <label for="note">Observações</label>
                                <textarea class="form-control" name="note" id="note" >{{old('capacity')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('create_vehicle', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/vehicle/vehicles/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_4" data-toggle="tab">Dados</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Especificações</a></li>
                        <li><a href="#tab_6" data-toggle="tab">Observações</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_4">
                            <div class="form-group">
                                <label for="client_id">Cliente</label>
                                <select class="form-control" name="client_id" id="client_id" v-model="$store.state.item.client_id">
                                    <option value=""></option>
                                    @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="placa">Placa</label>
                                        <input type="text" class="form-control" name="placa" id="placa" paceholder="Placa" v-model="$store.state.item.placa">
                                    </div>
                                </div>
                                <div class="col-xs-4">
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
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="city_id">Cidade</label>
                                        <select class="form-control" name="city_id" id="city_id" v-model="$store.state.item.city_id">
                                            <option value=""></option>
                                            @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="renavam">Renavam</label>
                                        <input type="number" class="form-control" name="renavam" id="renavam" paceholder="Renavam" v-model="$store.state.item.renavam">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="chassi">Chassi</label>
                                        <input type="text" class="form-control" name="chassi" id="chassi" paceholder="Chassi" v-model="$store.state.item.chassi">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="manufacturer_id">Marca</label>
                                        <select class="form-control" name="manufacturer_id" id="manufacturer_id" v-model="$store.state.item.manufacturer_id">
                                            <option value=""></option>
                                            @foreach ($manufacturers as $manufacturer)
                                            <option value="{{ $manufacturer->id }}">{{$manufacturer->manufacturer}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="model_id">Modelo</label>
                                        <select class="form-control" name="model_id" id="model_id" v-model="$store.state.item.model_id">
                                            <option value=""></option>
                                            @foreach ($models as $model)
                                            <option value="{{ $model->id }}">{{$model->model}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_5">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="specie_id">Espécie</label>
                                        <select class="form-control" name="specie_id" id="specie_id" v-model="$store.state.item.specie_id">
                                            <option value=""></option>
                                            @foreach ($species as $specie)
                                            <option value="{{ $specie->id }}">{{$specie->specie}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="type_id">Tipo</label>
                                        <select class="form-control" name="type_id" id="type_id" v-model="$store.state.item.type_id">
                                            <option value=""></option>
                                            @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{$type->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="category_id">Categoria</label>
                                        <select class="form-control" name="category_id" id="category_id" v-model="$store.state.item.category_id">
                                            <option value=""></option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{$category->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="yearmanufacture">Ano de Fabricação</label>
                                        <input type="number" class="form-control" name="yearmanufacture" id="yearmanufacture" paceholder="Ano de Fabricação" v-model="$store.state.item.yearmanufacture">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="yearmodel">Ano do Modelo</label>
                                        <input type="number" class="form-control" name="yearmodel" id="yearmodel" paceholder="Ano do Modelo" v-model="$store.state.item.yearmodel">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="capacity">Capacidade</label>
                                        <input type="number" class="form-control" name="capacity" id="capacity" paceholder="Capacidade" v-model="$store.state.item.capacity">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">    
                                    <div class="form-group">
                                        <label for="power">Potência (cv)</label>
                                        <input type="number" class="form-control" name="power" id="power" paceholder="Potência (cv)" step="any" pattern="^\d*(\.\d{0,2})?$" v-model="$store.state.item.power">
                                    </div>
                                </div>
                                <div class="col-xs-4"> 
                                    <div class="form-group">
                                        <label for="cylinder">Cilindradas (l)</label>
                                        <input type="number" class="form-control" name="cylinder" id="cylinder" paceholder="Cilindradas (l)" step="any" pattern="^\d*(\.\d{0,2})?$" v-model="$store.state.item.cylinder">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="fuel_id">Combustível</label>
                                        <select class="form-control" name="fuel_id" id="fuel_id" v-model="$store.state.item.fuel_id">
                                            <option value=""></option>
                                            @foreach ($fuels as $fuel)
                                            <option value="{{ $fuel->id }}">{{$fuel->fuel}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_6">
                            <div class="form-group">
                                <label for="note">Observações</label>
                                <textarea class="form-control" name="note" id="note" >@{{$store.state.item.note}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('update_vehicle', User::class)
            <button form="formEdition" class="btn btn-info">Atualizar</button>
            @endcan
        </span>            
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">
                    <img class="img-circle" src="/imgs/veiculos.png" alt="Veículos">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">@{{ $store.state.item.manufacturer }} @{{ $store.state.item.model }}</h3>
                <h5 class="widget-user-desc">@{{ $store.state.item.name }}</h5>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.placa }}</h5>
                            <span class="description-text">PLACA</span>
                        </div>
                    </div>
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.state }}</h5>
                            <span class="description-text">ESTADO</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.city }}</h5>
                            <span class="description-text">CIDADE</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.renavam }}</h5>
                            <span class="description-text">RENAVAM</span>
                        </div>
                    </div>
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.chassi }}</h5>
                            <span class="description-text">CHASSI</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <button type="button" class="btn btn-default btn-xs"><i class="fa fa-file-o"></i> Criado em: @{{ $store.state.item.created_at }}</button>
                <button type="button" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Alterado em: @{{ $store.state.item.updated_at }}</button>
                <span class="pull-right text-muted"></span>
            </div>
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

            $('select[name=state_id]').change(function () {
                var idState = $(this).val();
                $.get('/admin/cities-all/'+idState, function (cities) {
                    $('select[name=city_id]').empty();
                    $.each(cities, function (key, value) {
                        $('select[name=city_id]').append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                });
            });

            $('select[name=manufacturer_id]').change(function () {
                var id = $(this).val();
                $.get('/vehicle/models-rel/'+id, function (models) {
                    $('select[name=model_id]').empty();
                    $.each(models, function (key, value) {
                        $('select[name=model_id]').append('<option value=' + value.id + '>' + value.model + '</option>');
                    });
                });
            });
        });
    </script>
@stop