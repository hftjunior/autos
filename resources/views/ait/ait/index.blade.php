@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Autos de Infração de Trânsito"
        v-bind:columns="['#','Número da AIT','Condutor','Infração','Placa','Data Infração','Data Inclusão', 'Data Limite Recurso']"
        v-bind:items="{{ json_encode($aits) }}"
        detail="/ait/aits/" edit="/ait/aits/" del="/ait/aits/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_ait', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('aits.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="agency_id">Órgão</label>
                            <select class="form-control" name="agency_id" id="agency_id_i">
                                <option value="{{old('agency_id')}}"></option>
                                @foreach ($agencies as $agency)
                                <option value="{{ $agency->id }}">{{$agency->agency}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="vehicle_id">Veículo (Placa)</label>
                            <select class="form-control" name="vehicle_id" id="vehicle_id_i" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="{{old('vehicle_id')}}"></option>
                                @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{$vehicle->placa}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="status_id">Situação</label>
                            <select class="form-control" name="status_id" id="status_id_i">
                                <option value="{{old('status_id')}}"></option>
                                @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{$status->status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="client_id">Condutor</label>
                            <select class="form-control" name="client_id" id="client_id_i" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="{{old('client_id')}}"></option>
                                @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">  
                        <div class="form-group">
                            <label for="type_id">Infração</label>
                            <select class="form-control" name="type_id" id="type_id_i" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="{{old('type_id')}}"></option>
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{$type->code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="date">Data da Infração</label>
                            <input type="date" class="form-control" name="date" id="date_i" paceholder="Data da Infração" value="{{old('date')}}">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="time">Hora da Infração</label>
                            <input type="time" class="form-control" name="time" id="time_i" paceholder="Hora da Infração" value="{{old('time')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="local">Local da Infração</label>
                            <input type="text" class="form-control" name="local" id="local_i" paceholder="Local da Infração" value="{{old('local')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="state_id">Estado</label>
                            <select class="form-control" name="state_id" id="state_id_i">
                                <option value="{{old('state_id')}}"></option>
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="city_id">Cidade</label>
                            <select class="form-control" name="city_id" id="city_id_i">
                                <option value="{{old('city_id')}}"></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="date_included">Data da inclusão:</label>
                            <input type="date" class="form-control" name="date_included" id="date_included_i" paceholder="Data da Inclusão" value="{{old('date_included')}}">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="deadline">Data Limite para Recurso:</label>
                            <input type="date" class="form-control" name="deadline" id="deadline_i" paceholder="Data Limite para Recurso" value="{{old('deadline')}}">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="number">Número da AIT</label>
                            <input type="text" class="form-control" name="number" id="number_i" paceholder="Número da ATI" value="{{old('number')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="processing">Processamento</label>
                            <input type="number" class="form-control" name="processing" id="processing_i" paceholder="Processamento" step="any" pattern="^\d*(\.\d{0,2})?$" value="{{old('processing')}}">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="value">Valor (R$)</label>
                            <input type="number" class="form-control" name="value" id="value_i" paceholder="Valor (R$)" step="any" pattern="^\d*(\.\d{0,2})?$" value="{{old('value')}}">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="points">Pontos</label>
                            <input type="number" class="form-control" name="points" id="points_i" paceholder="Pontos" min="0" max="7" value="{{old('points')}}">
                        </div>
                    </div>
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('create_ait', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/ait/aits/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="agency_id">Órgão</label>
                            <select class="form-control" name="agency_id" id="agency_id_e" v-model="$store.state.item.agency_id">
                                <option value=""></option>
                                @foreach ($agencies as $agency)
                                <option value="{{ $agency->id }}">{{$agency->agency}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="vehicle_id">Veículo (Placa)</label>
                            <select class="form-control" name="vehicle_id" id="vehicle_id_e" style="width: 100%;" tabindex="-1" aria-hidden="true" :value="$store.state.item.vehicle_id">
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{$vehicle->placa}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="status_id">Situação</label>
                            <select class="form-control" name="status_id" id="status_id_e" v-model="$store.state.item.status_id">
                                <option value=""></option>
                                @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{$status->status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="client_id">Condutor</label>
                            <select class="form-control" name="client_id" id="client_id_e" style="width: 100%;" tabindex="-1" aria-hidden="true" v-model="$store.state.item.client_id">
                                <option value=""></option>
                                @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">  
                        <div class="form-group">
                            <label for="type_id">Infração</label>
                            <select class="form-control" name="type_id" id="type_id_e" style="width: 100%;" tabindex="-1" aria-hidden="true" :value="$store.state.item.type_id">
                            <option value=""></option>
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{$type->code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="date">Data da Infração</label>
                            <input type="date" class="form-control" name="date" id="date_e" paceholder="Data da Infração" v-model="$store.state.item.date">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="time">Hora da Infração</label>
                            <input type="time" class="form-control" name="time" id="time_e" paceholder="Hora da Infração" v-model="$store.state.item.time">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="local">Local da Infração</label>
                            <input type="text" class="form-control" name="local" id="local_e" paceholder="Local da Infração" v-model="$store.state.item.local">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="state_id">Estado</label>
                            <select class="form-control" name="state_id" id="state_id_e" v-model="$store.state.item.state_id">
                                <option value=""></option>
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="city_id">Cidade</label>
                            <select class="form-control" name="city_id" id="city_id_e" v-model="$store.state.item.city_id">
                                <option value=""></option>
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="date_included">Data da inclusão:</label>
                            <input type="date" class="form-control" name="date_included" id="date_included_e" paceholder="Data da Inclusão" v-model="$store.state.item.date_included">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="deadline">Data Limite para Recurso:</label>
                            <input type="date" class="form-control" name="deadline" id="deadline_e" paceholder="Data Limite para Recurso" v-model="$store.state.item.deadline">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="number">Número da AIT</label>
                            <input type="text" class="form-control" name="number" id="number_e" paceholder="Número da ATI" v-model="$store.state.item.number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="processing">Processamento</label>
                            <input type="number" class="form-control" name="processing" id="processing_e" paceholder="Processamento" step="any" pattern="^\d*(\.\d{0,2})?$" v-model.number="$store.state.item.processing">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="value">Valor (R$)</label>
                            <input type="number" class="form-control" name="value" id="value_e" paceholder="Valor (R$)" step="any" pattern="^\d*(\.\d{0,2})?$" v-model.number="$store.state.item.value">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="points">Pontos</label>
                            <input type="number" class="form-control" name="points" id="points_e" paceholder="Pontos" min="0" max="7" v-model.number="$store.state.item.points">
                        </div>
                    </div>
                </div>    
            </div>
        </page-form>
        <span slot="btns">
            @can('update_ait', User::class)
            <button form="formEdition" class="btn btn-info">Atualizar</button>
            @endcan
        </span>            
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">
                    <img class="img-circle" src="/imgs/ait.png" alt="Veículos">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">@{{ $store.state.item.number }}</h3>
                <h5 class="widget-user-desc">@{{ $store.state.item.code }} - @{{ $store.state.item.description }}</h5>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.agency }}</h5>
                            <span class="description-text">ÓRGÃO</span>
                        </div>
                    </div>
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.processing }}</h5>
                            <span class="description-text">PROCESSAMENTO</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.value }}</h5>
                            <span class="description-text">VALOR</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.points }}</h5>
                            <span class="description-text">PONTOS</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.placa }}</h5>
                            <span class="description-text">VEÍCULO</span>
                        </div>
                    </div>
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.name }}</h5>
                            <span class="description-text">CONDUTOR</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.local }}</h5>
                            <span class="description-text">LOCAL</span>
                        </div>
                    </div>
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.city }}/@{{ $store.state.item.state }}</h5>
                            <span class="description-text">CIDADE/ESTADO</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.date | moment('DD/MM/YYYY') }}</h5>
                            <span class="description-text">DT INFRAÇÂO</span>
                        </div>
                    </div>
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.time }}</h5>
                            <span class="description-text">HR INFRAÇÃO</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.date_included | moment('DD/MM/YYYY') }}</h5>
                            <span class="description-text">DT INCLUSÃO</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.deadline | moment('DD/MM/YYYY') }}</h5>
                            <span class="description-text">DT RECURSO</span>
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

            $('select[id=state_id_i]').change(function () {
                var idState = $(this).val();
                $.get('/admin/cities-all/'+idState, function (cities) {
                    $('select[id=city_id_i]').empty();
                    $.each(cities, function (key, value) {
                        $('select[id=city_id_i]').append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                });
            });

            $('select[id=state_id_e]').change(function () {
                var idState = $(this).val();
                $.get('/admin/cities-all/'+idState, function (cities) {
                    $('select[id=city_id_e]').empty();
                    $.each(cities, function (key, value) {
                        $('select[id=city_id_e]').append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                });
            });

            $('select[id=type_id_i]').change(function () {
                var idType = $(this).val();
                $.get('/ait/types/'+idType, function (types) {
                    console.log(parseInt(types.value));
                    document.getElementById('points_i').value = parseInt(types.points);
                    document.getElementById('value_i').value = parseFloat(types.value);
                    //$('number[name=points').value = parseInt(types.points);
                });
            });

            $('select[id=type_id_e]').change(function () {
                var idType = $(this).val();
                $.get('/ait/types/'+idType, function (types) {
                    console.log(parseInt(types.value));
                    document.getElementById('points_e').value = parseInt(types.points);
                    document.getElementById('value_e').value = parseFloat(types.value);
                    //$('number[name=points').value = parseInt(types.points);
                });
            });
        });
    </script>
@stop