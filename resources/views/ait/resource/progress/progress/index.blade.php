@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Origem das Informações"
        v-bind:columns="['#','Data','Hora','Recurso','Andamento']"
        v-bind:items="{{ json_encode($progresses) }}"
        detail="/ait/resource/progress/progresses/" edit="/ait/resource/progress/progresses/" del="/ait/resource/progress/progresses/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_aitResourceProgress', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('progresses.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="resource_id">Recurso</label>
                            <select class="form-control" name="resource_id" id="resource_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="{{old('resource_id')}}"></option>
                                @foreach ($resources as $resource)
                                <option value="{{ $resource->id }}">{{$resource->process}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="date">Data</label>
                            <input type="date" class="form-control" name="date" id="date" paceholder="Data" value="{{old('date')}}">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="time">Hora</label>
                            <input type="time" class="form-control" name="time" id="time" paceholder="Hora" value="{{old('time')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="origin_id">Origem da Informação</label>
                            <select class="form-control" name="origin_id" id="origin_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="{{old('origin_id')}}"></option>
                                @foreach ($origins as $origin)
                                <option value="{{ $origin->id }}">{{$origin->origin}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="means_id">Fonte da Informação</label>
                            <select class="form-control" name="means_id" id="means_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="{{old('means_id')}}"></option>
                                @foreach ($devices as $device)
                                <option value="{{ $device->id }}">{{$device->device}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="progress">Andamento</label>
                            <textarea class="form-control" name="progress" id="progress">{{old('progress')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('create_aitResourceProgress', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/ait/resource/progress/progresses/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="resource_id">Recurso</label>
                            <select class="form-control" name="resource_id" id="resource_id" style="width: 100%;" tabindex="-1" aria-hidden="true" v-model="$store.state.item.resource_id">
                                <option value=""></option>
                                @foreach ($resources as $resource)
                                <option value="{{ $resource->id }}">{{$resource->process}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="date">Data</label>
                            <input type="date" class="form-control" name="date" id="date" paceholder="Data" v-model="$store.state.item.date">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="time">Hora</label>
                            <input type="time" class="form-control" name="time" id="time" paceholder="Hora" v-model="$store.state.item.time">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="origin_id">Origem da Informação</label>
                            <select class="form-control" name="origin_id" id="origin_id" style="width: 100%;" tabindex="-1" aria-hidden="true" v-model="$store.state.item.origin_id">
                                <option value=""></option>
                                @foreach ($origins as $origin)
                                <option value="{{ $origin->id }}">{{$origin->origin}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="means_id">Fonte da Informação</label>
                            <select class="form-control" name="means_id" id="means_id" style="width: 100%;" tabindex="-1" aria-hidden="true" v-model="$store.state.item.means_id">
                                <option value=""></option>
                                @foreach ($devices as $device)
                                <option value="{{ $device->id }}">{{$device->device}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="progress">Andamento</label>
                            <textarea class="form-control" name="progress" id="progress">@{{$store.state.item.progress}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('update_aitResourceProgress', User::class)
            <button form="formEdition" class="btn btn-info">Atualizar</button>
            @endcan
        </span>            
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">
                    <img class="img-circle" src="/imgs/recursos.png" alt="Recursos">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">RECURSO: @{{ $store.state.item.process }}</h3>
                <h5 class="widget-user-desc">SITUAÇÃO: @{{ $store.state.item.status }}</h5>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.device }}</h5>
                            <span class="description-text">FONTE DA INFORMAÇÃO</span>
                        </div>
                    </div>
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.origin }}</h5>
                            <span class="description-text">ORIGEM DA INFORMAÇÃO</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.date | moment('DD/MM/YYYY') }}</h5>
                            <span class="description-text">DATA</span>
                        </div>
                    </div>
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.time }}</h5>
                            <span class="description-text">HORA</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.progress }}</h5>
                            <span class="description-text">ANDAMENTO</span>
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