@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <page-title title="{{ $title }}" v-bind:list="{{ $list }}"></page-title>    
@stop

@section('content')
<div class="row">
    <dashboard-box qtde="{{ $numClients }}" title="Clientes Cadastrados" url="/admin/clients" color="bg-aqua" icon="fa fa-users"></dashboard-box>
    <dashboard-box qtde="{{ $numVehicles }}" title="Veículos" url="vehicle/vehicles" color="bg-red" icon="fa fa-car"></dashboard-box>
    <dashboard-box qtde="{{ $numAits }}" title="AITs Registradas" url="/ait/aits" color="bg-green" icon="fa fa-tags"></dashboard-box>
    <dashboard-box qtde="{{ $numResources }}" title="Recursos" url="ait/resource/resources" color="bg-yellow" icon="fa fa-legal"></dashboard-box>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
            <h3 class="box-title">Clientes</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div id="gridstate" class="example1_wrapper form-inline dt-bootstrap">
                    <table id="gridlist" class="table table-bordered table-hover dataTable" role="grid">
                        <thead>
                            <tr role="row">
                                <th class="sorting" aria-sort="descending" style="width: 50px; text-align: center;">Perfil</th>
                                <th class="sorting" aria-sort="descending">Cliente</th>
                                <th class="sorting" aria-sort="descending">Nº AITs</th>
                                <th class="sorting" aria-sort="descending">Nº Recursos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $item)
                            <tr role="row">
                                <td style="text-align: center;"><a href="/admin/client-profile/{{$item->id}}"><i class="fa fa-gear"></i></a></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->numaits }}</td>
                                <td>{{ $item->numresources }}</td>
                            </tr>    
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@stop
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