<template>
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div :class="'small-box ' + color">
        <div class="inner">
          <h3>{{ qtde }}</h3>
          <p>{{ title }}</p>
        </div>
        <div class="icon">
          <i :class="icon"></i>
        </div>
        <a :href="url" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
</template>

<script>
    export default {
        props:['qtde','title', 'url','color','icon']
    }
</script>
