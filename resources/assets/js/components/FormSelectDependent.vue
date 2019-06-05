<template>
    <div>
    <div class="col-xs-4">
        <div class="form-group">
            <label v-bind:for="field1">{{ name1 }}</label>
            <select class="form-control" v-bind:name="field1" v-bind:id="field1" v-on:change="onChange()" v-model="selected">
                <option v-for="(item, index) in options1" v-bind:key="index" :value="item.value">{{ item.exib }}</option>
            </select>
        </div>
    </div>
    <div class="col-xs-4">    
        <div class="form-group">
            <label v-bind:for="field2">{{ name2 }}</label>
            <select class="form-control" v-bind:name="field2" v-bind:id="field2">
                <option v-for="(item, index) in options2" v-bind:key="index" :value="item.value">{{ item.exib }}</option>    
            </select>
        </div>
    </div>
    </div>   
</template>

<script>
    export default {
        props:['name1','field1','url1','name2','field2','url2'],
        mounted(){
            this.populate()   
        },
        data(){
            return {
                selected: null,
                options1: [
                    { value: '', exib:''}
                ],
                options2: [
                    { value: '', exib:''}
                ]
            }
        },
        methods:{
            populate(){
                axios.get(this.url1).then(response =>{
                    let res = Object.values(response.data);                    
                    for (let i=0; i < res.length; i++){
                        this.options1.push({value: res[i]['id'], exib: res[i]['name']});
                    }
                });
            },
            onChange(){
                $('select[name='+this.field2+']').empty();
                this.option2 = [{ value:'', exib:''}];
                axios.get(this.url2).then(response =>{
                    let res = Object.values(response.data);
                    console.log(res);                    
                    for (let i=0; i < res.length; i++){
                        if(res[i][this.field1] == this.selected){
                            this.options2.push({value: res[i]['id'], exib: res[i]['name']});
                        }
                    }
                });
            }
        }
    }
</script>
