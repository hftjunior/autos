<template>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Cadastro de {{ title }}</h3>
        <slot name="btns"></slot>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div id="gridstate" class="example1_wrapper form-inline dt-bootstrap">
            <table id="gridlist" class="table table-bordered table-hover dataTable" role="grid">
                <thead>
                    <tr role="row">
                        <th v-for="(column,index) in columns" v-bind:key="index" class="sorting" aria-sort="descending">{{ column }}</th>
                        <th f-if="detail || edit || del" class="sorting" style="width: 50px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr role="row" v-for="(item,index) in items" v-bind:key="index">
                        <td v-for="(i,index) in item" v-bind:key="index">{{ i | dateFormat }}</td>
                        <td f-if="detail || edit || del">
                            <form v-bind:id="index" v-if="del && token" v-bind:action="del + item.id" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" v-bind:value="token">
                                
                                <a v-if="detail && !modal" v-bind:href="detail" data-toggle="tooltip" data-placement="bottom" title="Detalhes"><span class="glyphicon glyphicon-align-justify" style="color: green"></span></a>&nbsp; 
                                <modal-link v-if="detail && modal" type="link" v-bind:item="item" v-bind:url="edit" v-bind:metadata="[{'name':'detailsForm','title':'','css':'','icon':'glyphicon glyphicon-align-justify','styles':'color:green'}]"></modal-link>

                                <a v-if="edit && !modal" v-bind:href="edit" data-toggle="tooltip" data-placement="bottom" title="Editar"><span class="glyphicon glyphicon-pencil" style="color: blue" ></span></a>&nbsp;
                                <modal-link v-if="edit && modal" type="link" v-bind:item="item" v-bind:url="edit" v-bind:metadata="[{'name':'editionForm','title':'','css':'','icon':'glyphicon glyphicon-pencil','styles':'color:blue'}]"></modal-link>

                                <a v-if="del" href="#" v-on:click="submitForm(index)" data-toggle="tooltip" data-placement="bottom" title="Excluir"><span class="glyphicon glyphicon-trash" style="color: red"></span></a>&nbsp;
                            </form>
                            <span v-if="!del">
                                <a v-if="detail && !modal" v-bind:href="detail" data-toggle="tooltip" data-placement="bottom" title="Detalhes"><span class="glyphicon glyphicon-align-justify" style="color: green"></span></a>&nbsp; 
                                <modal-link v-if="detail && modal" type="link" v-bind:metadata="[{'name':'detailsForm','title':'','css':'','icon':'glyphicon glyphicon-align-justify','styles':'color:green'}]"></modal-link>
                                
                                <a v-if="edit && !modal" v-bind:href="edit" data-toggle="tooltip" data-placement="bottom" title="Editar"><span class="glyphicon glyphicon-pencil" style="color: blue" ></span></a>&nbsp;   
                                <modal-link v-if="edit && modal" type="link" v-bind:metadata="[{'name':'editionForm','title':'','css':'','icon':'glyphicon glyphicon-pencil','styles':'color:blue'}]"></modal-link>

                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- /.box-body -->
</div>    
</template>

<script>
    export default {
        props:['title','columns','items','detail','edit','del','token','modal'],
        methods:{
            submitForm: function(index){
                swal({
                    title: 'Confirmação',
                    html: '<h5>Gostaria de apagar o registro?</h5>',
                    type: 'info',
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonText: 'Sim, apagar o registro.'
                }).then((result) => {
                    if(result.value){
                        document.getElementById(index).submit();
                    }
                });
            }
        },
        filters:{
            dateFormat: function(val){
                if(!val) return '';
                val = val.toString();
                if(val.split('-').length == 3){
                    val = val.split('-');
                    return val[2] + '/' + val[1] + '/' + val[0];
                }
                return val;
            }
        },
    }
</script>