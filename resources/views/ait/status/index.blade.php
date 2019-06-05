@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <page-gridsearch 
        title="Situações da AIT"
        v-bind:columns="['#','Situação da AIT']"
        v-bind:items="{{ json_encode($statuses) }}"
        detail="/ait/ait-statuses/" edit="/ait/ait-statuses/" del="/ait/ait-statuses/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_aitStatus', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('ait-statuses.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="status">Status da AIT</label>
                    <input type="text" class="form-control" name="status" id="status" paceholder="Status da AIT" value="{{old('status')}}">
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('create_aitStatus', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/ait/ait-statuses/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="status">Status da AIT</label>
                    <input type="text" class="form-control" name="status" id="status" paceholder="Status da AIT" v-model="$store.state.item.status">
                </div>
            </div>
        </page-form>
        <span slot="btns">
            @can('update_aitStatus', User::class)
            <button form="formEdition" class="btn btn-info">Atualizar</button>
            @endcan
        </span>            
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-tags"></i></span>
            <div class="info-box-content">
                <div class="row">
                    <div class="col-sm-6 border-right">   
                        <span class="info-box-text">Situação da AIT</span>
                        <span class="info-box-number">@{{ $store.state.item.status }}</span>
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