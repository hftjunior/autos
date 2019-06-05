<template>
    <div class="btn-group pull-right">
        <button v-if="!type || (type != 'button' && type != 'link')"n v-for="(meta,index) in metadata" v-bind:key="index" type="button" v-bind:class="meta.css || 'btn btn-default'" data-toggle="modal" v-bind:data-target="'#'+meta.name">
                <i v-bind:class="meta.icon || 'fa fa-smile-o'"></i>&nbsp;{{ meta.title }}
        </button>
        <button v-if="type == 'button'" v-for="(meta,index) in metadata" v-bind:key="index" type="button" v-bind:class="meta.css || 'btn btn-default'" data-toggle="modal" v-bind:data-target="'#'+meta.name">
                <i v-bind:class="meta.icon || 'fa fa-smile-o'"></i>&nbsp;{{ meta.title }}
        </button>
        <a v-on:click="fillOutForm()" v-if="type == 'link'" href="#" v-for="(meta,index) in metadata" v-bind:key="index" v-bind:class="meta.css || ''" v-bind:style="meta.styles" data-toggle="modal" v-bind:data-target="'#'+meta.name">
                <i v-bind:class="meta.icon || 'fa fa-smile-o'"></i>{{ meta.title }}
        </a>&nbsp;
    </div>    
</template>

<script>
    export default {
        props:['type','item','url','metadata'],
        methods:{
            fillOutForm: function(){
                axios.get(this.url + this.item.id).then(response =>{
                    this.$store.commit('setItem',response.data)
                });
            }
        } 
    }
</script>