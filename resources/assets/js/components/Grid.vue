<template>
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Cadastro de {{ title }}</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="search" name="search" class="form-control pull-right" placeholder="Pesquisa" v-model="search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table table-condensed">
                <tbody>
                <tr>
                    <th style="cursor:pointer" v-on:click="sorted(index)" v-for="(column,index) in columns" v-bind:key="index">{{ column }}<i class="fa fa-sort pull-right"></i></th>
                </tr>
                <tr v-for="(item,index) in list" v-bind:key="index">
                    <td v-for="(dt,index) in item" v-bind:key="index">{{ dt }}</td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <slot></slot> 
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
</template>

<script>
    export default {
        props:['title','columns','items','ord','ordcol'],
        data: function(){
            return {
                search:'',
                ordAux: this.ord || 'asc',
                ordcolAux: this.ordcol || 0
            }
        },
        methods:{
            sorted: function(col){
                this.ordcolAux = col;
                if(this.ordAux.toLowerCase() == 'asc'){
                    this.ordAux = 'desc';
                }else{
                    this.ordAux = 'asc';
                }
            }
        },
        computed:{
            list: function(){
                /**
                 * order data
                 */
                let ord = this.ordAux.toLowerCase();
                let ordcol = parseInt(this.ordcolAux);
                let dt = this.items.data;

                if(ord == 'asc'){
                    dt.sort(function(a,b){
                        if(Object.values(a)[ordcol] > Object.values(b)[ordcol]) { return 1;  }
                        if(Object.values(a)[ordcol] < Object.values(b)[ordcol]) { return -1; }
                        return 0;
                    });
                }else{
                    dt.sort(function(a,b){
                        if(Object.values(a)[ordcol] < Object.values(b)[ordcol]) { return 1;  }
                        if(Object.values(a)[ordcol] > Object.values(b)[ordcol]) { return -1; }
                        return 0;
                    });
                }

                /**
                 * data search
                 */
                if(this.search){
                    return dt.filter(response =>{
                        response = Object.values(response);
                        for(let k=0; k < response.length; k++){
                            if((response[k] + "").toLowerCase().indexOf(this.search.toLowerCase()) >=0){
                                return true;
                            }
                        }
                        return false;
                    });
                }
                return dt;
            }            
        }

    }
</script>