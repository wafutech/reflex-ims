<template>
  <div>
    <h3 class="title">Straight Line Depreciation Method Calculator</h3>
    <div class="row">
      <div class="col-md-6">
     <form v-on:submit.prevent="calculateDepreciation">
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
              <input type="number" class="form-control col-md-6" v-model="asset.salvage_value" />
            </div>
          </div>
        </div>
          
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Useful Years:</label>
              <input type="number" class="form-control col-md-6" v-model="asset.useful_years" />
            </div>
          </div>
        </div>
        <input type="hidden" name="depreciation_method_id" value="Straight Line"  v-model="asset.depreciation_method_id">
        <br>
     <div class="form-group">
          <button class="btn btn-info">Calculate</button>
        </div>
    </form>
</div>
    <div class="col-md-6">
    <ul class="nav nav-bar pull-right">
    
      <li>
      <router-link :to="{ name: 'reducing-bal-depreciation' }">Declining Balance</router-link>
      </li>
      <li>
      <router-link :to="{ name: 'unit-production' }">Unit of Production</router-link>
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
          asset:{},
          results:[]
        }
    },
    methods: {
      calculateDepreciation(){
        let uri = 'http://localhost/ims/public/api/assets/depreciation';
        this.axios.post(uri, this.asset).then((response) => {
          this.$router.push({name: 'list-fixed-assets'})
        })
    }
  }
}
</script>