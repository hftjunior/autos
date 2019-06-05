@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Recursos"
        v-bind:columns="['#','Nº Recurso','Nº AIT','Condutor','Veículo (Placa)','Data do Recurso','Situação Recurso']"
        v-bind:items="{{ json_encode($resources) }}"
        detail="/ait/resource/resources/" edit="/ait/resource/resources/" del="/ait/resource/resources/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_aitResource', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('resources.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="ait_id">Ait</label>
                            <select class="form-control" name="ait_id" id="ait_id_i" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="{{old('ait_id')}}"></option>
                                @foreach ($aits as $ait)
                                <option value="{{ $ait->id }}">{{$ait->number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="agency_id">Órgão Julgador</label>
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
                            <label for="instance">Instância</label>
                            <input type="text" class="form-control" name="instance" id="instance_i" paceholder="Instância" value="{{old('instance')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="process">Nº. Processo</label>
                            <input type="text" class="form-control" name="process" id="process_i" paceholder="Nº do Processo" value="{{old('process')}}">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="protocol">Nº. Protocolo</label>
                            <input type="text" class="form-control" name="protocol" id="protocol_i" paceholder="Nº do Protocolo" value="{{old('protocol')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="date_resource">Data do Recurso</label>
                            <input type="date" class="form-control" name="date_resource" id="date_resource_i" paceholder="Data do Recurso" value="{{old('date_resource')}}">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="date_judgment">Data do Julgamento</label>
                            <input type="date" class="form-control" name="date_judgment" id="date_judgment_i" paceholder="Data do Julgamento" value="{{old('date_judgment')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="status">Situação do Recurso</label>
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
                            <label for="result">Resultado</label>
                            <textarea class="form-control" name="result" id="result_i">{{old('result')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('create_aitResource', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/ait/resource/resources/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="ait_id">Ait</label>
                            <select class="form-control" name="ait_id" id="ait_id" style="width: 100%;" tabindex="-1" aria-hidden="true" v-model="$store.state.item.ait_id">
                                <option value=""></option>
                                @foreach ($aits as $ait)
                                <option value="{{ $ait->id }}">{{$ait->number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="agency_id">Órgão Julgador</label>
                            <select class="form-control" name="agency_id" id="agency_id" v-model="$store.state.item.agency_id">
                                <option value=""></option>
                                @foreach ($agencies as $agency)
                                <option value="{{ $agency->id }}">{{$agency->agency}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="instance">Instância</label>
                            <input type="text" class="form-control" name="instance" id="instance" paceholder="Instância" v-model="$store.state.item.instance">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="process">Nº. Processo</label>
                            <input type="text" class="form-control" name="process" id="process" paceholder="Nº do Processo" v-model="$store.state.item.process">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="protocol">Protocolo</label>
                            <input type="text" class="form-control" name="protocol" id="protocol" paceholder="Protocolo" v-model="$store.state.item.protocol">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="date_resource">Data do Recurso</label>
                            <input type="date" class="form-control" name="date_resource" id="date_resource" paceholder="Data do Recurso" v-model="$store.state.item.date_resource">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="date_judgment">Data do Julgamento</label>
                            <input type="date" class="form-control" name="date_judgment" id="date_judgment" paceholder="Data do Julgamento" v-model="$store.state.item.date_judgment">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="status_id">Situação do Recurso</label>
                            <select class="form-control" name="status_id" id="status_id" v-model="$store.state.item.status_id">
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
                            <label for="result">Resultado</label>
                            <textarea class="form-control" name="result" id="result">@{{$store.state.item.result}}</textarea>
                        </div>
                    </div>
                </div>        
            </div>
        </page-form>
        <span slot="btns">
            @can('update_aitResource', User::class)
            <button form="formEdition" class="btn btn-info">Atualizar</button>
            @endcan
        </span>            
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">
                    <img class="img-circle" src="/imgs/recursos.png" alt="Veículos">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">RECURSO: @{{ $store.state.item.process }}</h3>
                <h5 class="widget-user-desc">SITUAÇÃO: @{{ $store.state.item.status }}</h5>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.agency }}</h5>
                            <span class="description-text">ÓRGÃO JULGADOR</span>
                        </div>
                    </div>
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.instance }}</h5>
                            <span class="description-text">INSTÂNCIA</span>
                        </div>
                    </div>
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.protocol }}</h5>
                            <span class="description-text">Nº PROTOCOLO</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.date_resource | moment("DD/MM/YYYY")}}</h5>
                            <span class="description-text">DATA RECURSO</span>
                        </div>
                    </div>
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.date_judgment | moment("DD/MM/YYYY") }}</h5>
                            <span class="description-text">DATA JULGAMENTO</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.result }}</h5>
                            <span class="description-text">RESULTADO</span>
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
        });
    </script>
@stop