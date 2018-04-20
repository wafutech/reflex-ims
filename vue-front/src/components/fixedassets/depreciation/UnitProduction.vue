<template>
  <div>
    <h3 class="title">Production Units Depreciation Method Calculator</h3>
     <div class="row">
      <div class="col-md-6">
    <form v-on:submit.prevent="calculateDepreciation('Unit of Production')" method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Historical Cost:</label>
            <input type="number" class="form-control" v-model="asset.purchase_price">
          </div>
        </div>
        </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Salvage Value:</label>
              <input type="number" class="form-control" v-model="asset.salvage_value" />
            </div>
          </div>
        </div>
          
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Useful Years:</label>
              <input type="number" class="form-control" v-model="asset.useful_years" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Outer Shells Units:</label>
              <input type="number" class="form-control" v-model="asset.life_time_units" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Current Units:</label>
              <input type="number" class="form-control" v-model="asset.current_units" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Depreciation Method:</label>
              <input type="hidden"  class="form-control"  v-model="depreciation_method_id"/>

            </div>
          </div>
        </div>

         

        <br>
         

        <div class="form-group">
          <button class="btn btn-info">Calculate</button>
        </div>
    </form>
    </div>
    <div class="col-md-6">
    <ul class="nav nav-bar pull-right">
    <li>
      <router-link :to="{ name: 'straight-line' }">Straight Line</router-link>
      </li>
      <li>
      <router-link :to="{ name: 'reducing-bal-depreciation' }">Declining Balance</router-link>
      </li>
      
      <li>
      <router-link :to="{ name: 'sum-years' }">Sum of Years</router-link>
      </li>

    </ul>
    </div>
    </div>
  </div>
</template>
<script>
  export default {
    data(){
        return{
        depreciation_method_id:'Unit of Production',
          asset:{},
          results:[]
        }
    },
    methods: {
      calculateDepreciation(){
        let uri = 'http://localhost/ims/public/api/assets/depreciation';
        this.axios.post(uri, this.asset).then((response) => {
          this.results = response.data;
          console.log(this.results)
          this.$router.push({name: 'list-fixed-assets'})
          
        })
    }
  }
}
</script>