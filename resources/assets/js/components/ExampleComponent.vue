<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Meu componente
                    </div>
                    <div class="panel-body">
                        <button class="btn btn-primary" @click="makeAnAlert()">Clique aqui!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted(){
            console.log('Componente montado.');
        },
        methods:{
            makeAnAlert: function(){
                swal('Ola Mundo!');
            }    
        }
    }
</script>
