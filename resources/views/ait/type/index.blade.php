@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Tipos de Infração"
        v-bind:columns="['#','Código','Infração','Pontos','Valor (R$)']"
        v-bind:items="{{ json_encode($types) }}"
        detail="/ait/ait-types/" edit="/ait/ait-types/" del="/ait/ait-types/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_aitType', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('ait-types.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="code">Código</label>
                    <input type="text" class="form-control" name="code" id="code" paceholder="Código" value="{{old('code')}}">
                </div>
                <div class="form-group">
                    <label for="description">Infração</label>
                    <textarea class="form-control" name="description" id="description">{{old('code')}}</textarea>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="legal">Amparo Legal</label>
                            <input type="text" class="form-control" name="legal" id="legal" paceholder="Amparo Legal" value="{{old('legal')}}">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="points">Pontos</label>
                            <input type="number" class="form-control" name="points" id="points" paceholder="Pontos" min="0" max="7" value="{{old('points')}}">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="value">Valor (R$)</label>
                            <input type="number" class="form-control" name="value" id="Value" paceholder="Valor (R$)" step="any" pattern="^\d*(\.\d{0,2})?$" value="{{old('value')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="gravity_id">Gravidade</label>
                            <select class="form-control" name="gravity_id" id="gravity_id">
                                <option value="{{old('gravity_id')}}"></option>
                                @foreach ($gravities as $gravity)
                                <option value="{{ $gravity->id }}">{{$gravity->gravity}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="measure_id">Medidas Administrativas</label>
                            <select class="form-control" name="measure_id" id="measure_id">
                                <option value="{{old('measure_id')}}"></option>
                                @foreach ($measures as $measure)
                                <option value="{{ $measure->id }}">{{$measure->measure}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('create_aitType', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/ait/ait-types/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="code">Código</label>
                    <input type="text" class="form-control" name="code" id="code" paceholder="Código" v-model="$store.state.item.code">
                </div>
                <div class="form-group">
                    <label for="description">Infração</label>
                    <textarea class="form-control" name="description" id="description">@{{$store.state.item.description}}</textarea>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="legal">Amparo Legal</label>
                            <input type="text" class="form-control" name="legal" id="legal" paceholder="Amparo Legal" v-model="$store.state.item.legal">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="points">Pontos</label>
                            <input type="number" class="form-control" name="points" id="points" paceholder="Pontos" min="0" max="7" v-model="$store.state.item.points">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="value">Valor (R$)</label>
                            <input type="number" class="form-control" name="value" id="Value" paceholder="Valor (R$)" step="any" pattern="^\d*(\.\d{0,2})?$" v-model="$store.state.item.value">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="gravity_id">Gravidade</label>
                            <select class="form-control" name="gravity_id" id="gravity_id" v-model="$store.state.item.gravity_id">
                                <option value=""></option>
                                @foreach ($gravities as $gravity)
                                <option value="{{ $gravity->id }}">{{$gravity->gravity}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="measure_id">Medidas Administrativas</label>
                            <select class="form-control" name="measure_id" id="measure_id" v-model="$store.state.item.measure_id">
                                <option value=""></option>
                                @foreach ($measures as $measure)
                                <option value="{{ $measure->id }}">{{$measure->measure}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('update_aitType', User::class)
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
                <h3 class="widget-user-username">@{{ $store.state.item.code }}</h3>
                <h5 class="widget-user-desc">@{{ $store.state.item.description }}</h5>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.legal }}</h5>
                            <span class="description-text">AMPARO LEGAL</span>
                        </div>
                    </div>
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.points }}</h5>
                            <span class="description-text">PONTOS</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.value }}</h5>
                            <span class="description-text">VALOR</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.gravity }}</h5>
                            <span class="description-text">GRAVIDADE</span>
                        </div>
                    </div>
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.measure }}</h5>
                            <span class="description-text">MEDIDAS ADM.</span>
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