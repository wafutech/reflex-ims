<template>
<div>
    <h1>Inventory Managment System (IMS)</h1>
    <section class="here is-success is-fullheight">
    <div class="hero-body">
    <div class="container">
    <h2>Vuejs Wrappers for chartJS</h2>
    <ul>
    <li><router-link to:="/chartjs">Vue-ChartJs</router-link></li>
    <li><router-link to:="/charts">Vue-Charts</router-link></li>
    <li><router-link to:="/chart-kick">Vue-ChartKick</router-link></li>
    </ul>
    </div> <!--End of container div-->
    </div>
    </section>









    <div class="row">
    <div class="col-md-2">
    <h1>345</h1>
    </div>
    <div class="col-md-2">
    <h1>345</h1>
    </div>
    <div class="col-md-2">
    <h1>345</h1>
    </div>
    <div class="col-md-2">
    <h1>345</h1>
    </div>
    <div class="col-md-2">
    <h1>345</h1>
    </div>
    <div class="col-md-2">
    <h1>345</h1>
    </div>
    
    
   
    </div>
    </div>
</template>
<script>
export default
{
    name:'home',

}
</script>
<style scoped>
.home
{
    display:flex;
    align-items:center;
    align-content:center;
    justify-content: center;
}
h1,h2
{
    font-weight:normal;
}
ul
{
    list-style-type:none;
    padding:0;
}
li
{
    display:inline-block;
    margin: 0 10px;

}
a {
    color:#42b983;
    text-decoration:underline;
}
</style>