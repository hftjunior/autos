<template>
    <div class="content-header">
        <h4>{{ title }}</h4>
        <ol class="breadcrumb">
            <li v-for="(item,index) in list" v-bind:key="index"> 
                <a v-if="item.page == 'Home'" v-bind:href="item.url">
                    <i class="fa fa-home"></i>{{ item.page }}
                </a>
                <a v-if="item.page != 'Home'" v-bind:href="item.url">{{ item.page }}</a>
            </li>            
        </ol>
    </div>
</template>

<script>
    export default {
        props:['title','list']
    }
</script>