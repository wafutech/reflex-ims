<template>
<div>
<!--Tabs-->
  <ul class="nav nav-tabs nav-justified">
  <li class="nav-item">
    <a class="nav-link active" href="#tab1default" data-toggle="tab">Raw Material</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#tab2default" data-toggle="tab">Stock/WIP</a>
  </li>
  <li class="nav-item">
     <router-link :to="{name: 'receive-stock'}" class="nav-link" data-toggle="tab">Stock</router-link>
  </li>
 
  
  </ul>

  <!--End tabs -->
</div>
</template>
<script>
export default {
	name:'InventoryNavbar',
    
}
</script>
<style>
</style>