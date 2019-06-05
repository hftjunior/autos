@extends('adminlte::page')

@section ('title', $title)

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="/imgs/client.png" alt="User profile picture">

                <h3 class="profile-username text-center">{{ $client->name }}</h3>

                <p class="text-muted text-center">{{ date('d/m/Y', strtotime($client->dtbirth)) }}</p>

                <ul class="list-group list-group-unbordered">
                    @isset($client->tel_home)
                    <li class="list-group-item">
                        <i class="fa fa-home margin-r-5"></i><b> Casa</b>
                        <a class="pull-right">{{ $client->tel_home}}</a>
                    </li>
                    @endisset
                    @isset($client->tel_work)
                    <li class="list-group-item">
                        <i class="fa fa-phone margin-r-5"></i><b> Trabalho</b>
                        <a class="pull-right">{{ $client->tel_work}}</a>
                    </li>
                    @endisset
                    @isset($client->cell)
                    <li class="list-group-item">
                        <i class="fa fa-mobile margin-r-5"></i><b> Celular</b>
                        <a class="pull-right">{{ $client->cell}}</a>
                    </li>
                    @endisset
                    @isset($client->email)
                    <li class="list-group-item">
                        <i class="fa fa-envelope-o margin-r-5"></i><b> E-mail</b>
                        <a class="pull-right" href="mailto:{{$client->email}}">{{ $client->email}}</a>
                    </li>
                    @endisset
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Informações</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-map-marker margin-r-5"></i> Endereço</strong>
                <p class="text-muted">
                    {{$client->type_street}} 
                    @isset($client->street)
                    {{$client->street}}
                    @endisset
                    @isset($client->number)
                    , {{$client->number}}
                    @endisset
                    @isset($client->compement)
                    - {{$client->compement}}
                    @endisset
                    <br>{{$client->neighborhood}}
                    <br>{{$client->cep}} 
                    @isset($client->city_id)
                    {{$client->city->name}}
                    @endisset
                    @isset($client->state_id)
                        / {{$client->state->initial}}
                    @endisset
                </p>

                <hr>

                <strong><i class="fa fa-pencil margin-r-5"></i> Documentos</strong>

                <p>
                    @isset($client->cpf)
                    <span class="label label-success">CPF:</span> {{$client->cpf}}
                    @foreach ($clientDocs as $doc)
                        @if ($doc->initial == 'CPF')
                        <a class="pull-right" href="/storage/{{$doc->document}}" target="_blank"><span class="label label-primary"><i class="fa fa-file-text-o"></i> {{$doc->initial}}</span></a>
                        @endif
                    @endforeach
                    @endisset
                    @isset($client->identity)
                    <br><span class="label label-success">ID :</span> {{$client->identity}}
                    @foreach ($clientDocs as $doc)
                        @if ($doc->initial == 'ID')
                        <a class="pull-right" href="/storage/{{$doc->document}}" target="_blank"><span class="label label-primary"><i class="fa fa-file-text-o"></i> {{$doc->initial}}</span></a>
                        @endif
                    @endforeach
                    @endisset
                    @isset($client->cnh)
                    <br><span class="label label-success">CNH:</span> {{$client->cnh}}
                    @foreach ($clientDocs as $doc)
                        @if ($doc->initial == 'CNH')
                        <a class="pull-right" href="/storage/{{$doc->document}}" target="_blank"><span class="label label-primary"><i class="fa fa-file-text-o"></i> {{$doc->initial}}</span></a>
                        @endif
                    @endforeach
                    @endisset
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Observações</strong>

                <p>{{$client->note}}</p>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">AITs</a></li>                
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        @foreach ($clientAits->sortByDesc('number') as $ait)
                        <!-- Post -->
                        <div class="box box-widget">
                        <div class="box-header with-border">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="/imgs/ait.png" alt="AIT">
                                <span class="username">
                                    <a>{{ $ait->number }}</a>
                                    @if (count($ait->resources) > 0)
                                    <span class="badge bg-green">{{count($ait->resources)}} <i class="fa fa-legal"></i></i></span>
                                    @else
                                    <span class="badge bg-yellow">{{count($ait->resources)}}  <i class="fa fa-legal"></i></span>    
                                    @endif
                                    @foreach ($aitDocs as $doc)
                                        @if ($doc->identify == $ait->id)
                                        <a class="" href="/storage/{{$doc->document}}" target="_blank"><span class="label label-primary"><i class="fa fa-file-text-o"></i> {{$doc->initial}}</span></a>
                                        @endif
                                    @endforeach                                       
                                </span>
                                <span class="description">{{ date('d/m/Y', strtotime($ait->date)) }}</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            <p>
                                <b>Veículo:  </b>{{$ait->vehicle->placa}} - {{$ait->vehicle->manufacturer->manufacturer}} {{$ait->vehicle->model->model}} {{$ait->vehicle->cylinder}}
                                @foreach ($vehicleDocs as $doc)
                                    @if ($doc->identify == $ait->vehicle->id)
                                    <a class="" href="/storage/{{$doc->document}}" target="_blank"><span class="label label-primary"><i class="fa fa-file-text-o"></i> {{$doc->initial}}</span></a>
                                    @endif
                                @endforeach 
                                <br/>
                                <b>Motivo :  </b>{{$ait->type->code}} - {{$ait->type->description}}<br/>
                                <b>Local  :  </b>{{$ait->local}}<br/>
                                <b>Pontos :  </b>{{$ait->points}} <b>Valor: </b>R${{$ait->value}}<br/>
                                <b>Data   :  </b>{{date('d/m/Y', strtotime($ait->date))}} <b>Data Inclusão: </b>{{date('d/m/Y', strtotime($ait->date_included))}} <b>Data Limite Recurso: </b>{{date('d/m/Y', strtotime($ait->deadline))}}
                            </p>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                @foreach ($ait->resources as $resource)
                                    <li class="active"><a href="#{{$resource->id}}" data-toggle="tab"><i class="fa fa-legal"></i> {{$resource->process}}</a></li>
                                @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach ($ait->resources as $resource)
                                    <div class="active tab-pane" id="{{$resource->id}}">
                                        <p>
                                            <b>Documentos: </b>
                                            @foreach ($resourceDocs as $doc)
                                                @if ($doc->identify == $resource->id)
                                                <a class="" href="/storage/{{$doc->document}}" target="_blank"><span class="label label-primary"><i class="fa fa-file-text-o"></i> {{$doc->initial}}</span></a>
                                                @endif
                                            @endforeach
                                            <br/>
                                            <b>Órgão Julgador: </b>{{$resource->agency->agency}} <b>Instância: </b>{{$resource->instance}} <b>Protocolo: </b>{{$resource->protocol}}<br/>
                                            <b>Data do Recurso: </b>{{date('d/m/Y', strtotime($resource->date_resource))}} <b>Data Julgamento: </b>{{date('d/m/Y', strtotime($resource->date_judgment))}}<br/>
                                            <b>Situação: </b>{{$resource->status->status}}<br/>
                                            <b>Resultado: </b>{{$resource->result}}
                                        </p>
                                        <div class="box box-primary collapsed-box box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Andamentos</h3>
                                                <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                </button>
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body" style="">
                                                <ul class="timeline">
                                                    @foreach ($resource->progresses->sortByDesc('date') as $progress)
                                                    <!-- timeline time label -->
                                                    <li class="time-label">
                                                            <span class="bg-red">
                                                                {{date('d/m/Y', strtotime($progress->date))}}
                                                            </span>
                                                        </li>
                                                        <!-- /.timeline-label -->
                                                    
                                                        <!-- timeline item -->
                                                        <li>
                                                            <!-- timeline icon -->
                                                            <i class="fa fa-envelope bg-blue"></i>
                                                            <div class="timeline-item">
                                                                <span class="time"><i class="fa fa-clock-o"></i> {{$progress->time}}</span>
                                                    
                                                                <h3 class="timeline-header"><a href="#">{{$progress->origin->origin}}</a> ...</h3>
                                                    
                                                                <div class="timeline-body">
                                                                    {{$progress->progress}}
                                                                </div>                                                                
                                                            </div>
                                                        </li>
                                                        <!-- END timeline item -->
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    @endforeach        
                                </div>
                            </div>
                        </div>
                        </div
                        <!-- /.post -->
                        @endforeach
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop