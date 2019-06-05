<template>
    <div class="form-group">
        <label v-bind:for="field">{{ name }}</label>
        <select class="form-control" v-bind:name="field" v-bind:id="field" v-model="selected">
            <option v-for="(item, index) in options" v-bind:key="index" :value="item.value">{{ item.exib }}</option>
        </select>
    </div>    
</template>

<script>
    export default {
        mounted(){
            this.populate()   
        },
        props:['name','field','url'],
        data(){
            return {
                selected: null,
                options: [
                    { value: '', exib:''}
                ]
            }
        },
        methods:{
            populate(){
                axios.get(this.url).then(response =>{
                    let res = Object.values(response.data);
                    for (let i=0; i < res.length; i++){
                        this.options.push({value: res[i]['id'], exib: res[i]['name']});
                    }
                });
            }
        }
    }
</script>
