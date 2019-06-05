@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
@if($errors->all())
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $key => $value)
            <li><strong>{{$value}}</strong>
        @endforeach
    </div>    
@endif  
    <page-gridsearch 
        title="{{ $title }}"
        v-bind:columns="['#','Nome','CPF','Telefone','Celular','E-mail']"
        v-bind:items="{{ json_encode($clients) }}"
        detail="/admin/clients/" edit="/admin/clients/" del="/admin/clients/" token="{{ csrf_token() }}" modal="1">
    <span slot="btns">
        @can('create_client', User::class)
        <modal-link type="button" v-bind:metadata="[{'name':'creationForm','title':'Novo','css':'btn btn-default','icon':'fa fa-file-o'}]"></modal-link>
        @endcan
    </span>
    </page-gridsearch>
    <!-- add -->
    <modal name="creationForm" title="{{ $title }}">
        <page-form id="formCreation" css="" action="{{ route('clients.store') }}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Dados</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Contatos</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Endereço</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Observações</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name" id="name" paceholder="Nome" value="{{old('name')}}">
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" name="cpf" id="cpf" paceholder="CPF" value="{{old('cpf')}}" data-inputmask='"mask":"999.999.999-99"' data-mask>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="identity">Identidade</label>
                                    <input type="text" class="form-control" name="identity" id="identity" paceholder="Identidade" value="{{old('identity')}}">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="dtbirth">Data de Nascimento:</label>
                                    <input type="date" class="form-control" name="dtbirth" id="dtbirth" paceholder="Data de Nascimento" value="{{old('dtbirth')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="cnh">CNH</label>
                                    <input type="text" class="form-control" name="cnh" id="cnh" paceholder="CNH" value="{{old('cnh')}}">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                        <label for="dtcnh">Data da CNH:</label>
                                        <input type="date" class="form-control" name="dtcnh" id="dtcnh" paceholder="Data da CNH" value="{{old('dtcnh')}}">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="dtcnhdue">Vencimento da CNH:</label>
                                    <input type="date" class="form-control" name="dtcnhdue" id="dtcnhdue" paceholder="Vencimento" value="{{old('dtcnhdue')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="tel_home">Tel. Residencial</label>
                                    <input type="text" class="form-control" name="tel_home" id="tel_home" paceholder="Tel. Residencial" value="{{old('tel_home')}}" data-inputmask='"mask":"(99) 9999-9999"' data-mask>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="tel_work">Tel. Comercial</label>
                                    <input type="text" class="form-control" name="tel_work" id="tel_work" paceholder="Tel. Comercial" value="{{old('tel_work')}}" data-inputmask="'mask':['(99) 9999-9999','(99) 9 9999-9999']" data-mask>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="cell">Celular</label>
                                    <input type="text" class="form-control" name="cell" id="cell" paceholder="Celular" value="{{old('cell')}}" data-inputmask='"mask":"(99) 9 9999-9999"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" paceholder="E-mail" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_3">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="type_street">Tipo Logradouro</label>
                                    <select class="form-control" name="type_street" id="type_street" value="{{old('type_street')}}">
                                        <option value=""></option>
                                        <option value="Av.">Avenida</option>
                                        <option value="Rua">Rua</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="form-group">
                                    <label for="street">Logradouro:</label>
                                    <input type="text" class="form-control" name="street" id="street" paceholder="identidade" value="{{old('street')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="number">Número</label>
                                    <input type="text" class="form-control" name="number" id="number" paceholder="Número" value="{{old('number')}}">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="complement">Complemento</label>
                                    <input type="text" class="form-control" name="complement" id="complement" paceholder="Complemento" value="{{old('complement')}}">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="neighborhood">Bairro</label>
                                    <input type="text" class="form-control" name="neighborhood" id="neighborhood" paceholder="Bairro" value="{{old('neighborhood')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="state_id">Estado</label>
                                    <select class="form-control" name="state_id" id="state_id" value="{{old('state_id')}}">
                                        <option value=""></option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="city_id">Cidade</label>
                                    <select class="form-control" name="city_id" id="city_id" value="{{old('city_id')}}">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control" name="cep" id="cep" paceholder="Cep" value="{{old('cep')}}" data-inputmask='"mask":"99999-999"' data-mask>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="tab-pane" id="tab_4">
                        <div class="form-group">
                            <label for="note">Observação</label>
                            <textarea class="form-control" name="note" id="note">{{old('note')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>          
        </page-form>
        <span slot="btns">
            @can('create_client', User::class)
            <button form="formCreation" class="btn btn-info">Salvar</button>
            @endcan
        </span>            
    </modal>
    <!-- edit -->
    <modal name="editionForm" title="{{ $title }}">
        <page-form id="formEdition" css="" v-bind:action="'/admin/clients/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_5" data-toggle="tab">Dados</a></li>
                        <li><a href="#tab_6" data-toggle="tab">Contatos</a></li>
                        <li><a href="#tab_7" data-toggle="tab">Endereço</a></li>
                        <li><a href="#tab_8" data-toggle="tab">Observações</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_5">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name" id="name" paceholder="Nome" v-model="$store.state.item.name">
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" name="cpf" id="cpf" paceholder="CPF" v-model="$store.state.item.cpf" data-inputmask="'mask':'999.999.999-99'" data-mask>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="identity">Identidade</label>
                                    <input type="text" class="form-control" name="identity" id="identity" paceholder="Identidade" v-model="$store.state.item.identity">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="dtbirth">Data de Nascimento:</label>
                                    <input type="date" class="form-control" name="dtbirth" id="dtbirth" paceholder="Data de Nascimento" v-model="$store.state.item.dtbirth">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="cnh">CNH</label>
                                    <input type="text" class="form-control" name="cnh" id="cnh" paceholder="CNH" v-model="$store.state.item.cnh">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="dtcnh">Data da CNH:</label>
                                    <input type="date" class="form-control" name="dtcnh" id="dtcnh" paceholder="Data da CNH" v-model="$store.state.item.dtcnh">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="dtcnhdue">Vencimento da CNH:</label>
                                    <input type="date" class="form-control" name="dtcnhdue" id="dtcnhdue" paceholder="Vencimento" v-model="$store.state.item.dtcnhdue">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_6">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="tel_home">Tel. Residencial</label>
                                    <input type="text" class="form-control" name="tel_home" id="tel_home" paceholder="Tel. Residencial" v-model="$store.state.item.tel_home" data-inputmask="'mask':'(99) 9999-9999'" data-mask>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="tel_work">Tel. Comercial</label>
                                    <input type="text" class="form-control" name="tel_work" id="tel_work" paceholder="Tel. Comercial" v-model="$store.state.item.tel_work" data-inputmask="'mask':['(99) 9999-9999','(99) 9 9999-9999']" data-mask>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="cell">Celular</label>
                                    <input type="text" class="form-control" name="cell" id="cell" paceholder="Celular" v-model="$store.state.item.cell" data-inputmask="'mask':'(99) 9 9999-9999'" data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" paceholder="E-mail" v-model="$store.state.item.email">
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_7">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="type_street">Tipo Logradouro</label>
                                    <select class="form-control" name="type_street" id="type_street" v-model="$store.state.item.type_street">
                                        <option value=""></option>
                                        <option value="Av.">Avenida</option>
                                        <option value="Rua">Rua</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="form-group">
                                    <label for="street">Logradouro:</label>
                                    <input type="text" class="form-control" name="street" id="street" paceholder="identidade" v-model="$store.state.item.street">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="number">Número</label>
                                    <input type="text" class="form-control" name="number" id="number" paceholder="Número" v-model="$store.state.item.number">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="complement">Complemento</label>
                                    <input type="text" class="form-control" name="complement" id="complement" paceholder="Complemento" v-model="$store.state.item.complement">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="neighborhood">Bairro</label>
                                    <input type="text" class="form-control" name="neighborhood" id="neighborhood" paceholder="Bairro" v-model="$store.state.item.neighborhood">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="state_id">Estado</label>
                                    <select class="form-control" name="state_id" id="state_id" v-model="$store.state.item.state_id">
                                        <option value=""></option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="city_id">Cidade</label>
                                    <select class="form-control" name="city_id" id="city_id" v-model="$store.state.item.city_id">
                                        <option value=""></option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control" name="cep" id="cep" paceholder="Bairro" v-model="$store.state.item.cep" data-inputmask="'mask':'99999-999'" data-mask>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="tab-pane" id="tab_8">
                        <div class="form-group">
                            <label for="note">Observação</label>
                            <textarea class="form-control" name="note" id="note">@{{$store.state.item.note}}</textarea>
                        </div>
                    </div>
                </div>                
            </div>    
        </page-form>
        <span slot="btns">
            @can('update_client', User::class)
            <button form="formEdition" class="btn btn-info">Atualizar</button>
            @endcan
        </span>            
    </modal>
    <!-- details -->
    <modal name="detailsForm" title="{{ $title }}">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-blue">
                <div class="widget-user-image">
                    <img class="img-circle" src="/imgs/clientes.png" alt="Clientes">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">@{{ $store.state.item.name }}</h3>
                <h5 class="widget-user-desc">@{{ $store.state.item.cpf }} - @{{ $store.state.item.dtbirth | moment('DD/MM/YYYY') }} </h5>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.identity }}</h5>
                            <span class="description-text">IDENTIDADE</span>
                        </div>
                    </div>
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.cnh }}</h5>
                            <span class="description-text">CNH</span>
                        </div>
                    </div>
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.dtcnh | moment('DD/MM/YYYY') }}</h5>
                            <span class="description-text">Data da CNH</span>
                        </div>
                    </div>
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.dtcnhdue | moment('DD/MM/YYYY') }}</h5>
                            <span class="description-text">Data Venc. CNH</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.tel_home }}</h5>
                            <span class="description-text">TEL. RESID.</span>
                        </div>
                    </div>
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.tel_work }}</h5>
                            <span class="description-text">TEL. COM.</span>
                        </div>
                    </div>
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.cell }}</h5>
                            <span class="description-text">TEL. CEL.</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 border-right">
                        <div class="description-block">
                            <h5 class="description-header">@{{ $store.state.item.email }}</h5>
                            <span class="description-text">E-MAIL</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-sm-12 border-right">
                            <div class="description-block">
                                <h5 class="description-header">
                                    @{{ $store.state.item.type_street }} @{{ $store.state.item.street }}, @{{ $store.state.item.number }} @{{ $store.state.item.complement }}</br>
                                    @{{ $store.state.item.neighborhood }}</br>
                                    @{{ $store.state.item.cep }} @{{ $store.state.item.city }} / @{{ $store.state.item.state }}
                                </h5>
                                <span class="description-text">ENDEREÇO</span>
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
                'processing'  : true,
                'language'    : {
                    'url'         : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                }
            });
            
            $('[data-mask]').inputmask();
            
            $('select[name=state_id]').change(function () {
                var idState = $(this).val();
                $.get('/admin/cities-all/'+idState, function (cities) {
                    $('select[name=city_id]').empty();
                    $.each(cities, function (key, value) {
                        $('select[name=city_id]').append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                });
            });

        });
    </script>
@stop