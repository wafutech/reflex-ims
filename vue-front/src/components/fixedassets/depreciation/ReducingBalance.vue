<template>
  <div>
    <h3 class="title">Declining Balance Depreciation Method Calculator</h3>
     <div class="row">
      <div class="col-md-6">
    <form v-on:submit.prevent="DepreciationCalculator">

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Historical Cost:</label>
            <input type="number" class="form-control" v-model="reducingbal.purchase_price">
          </div>
        </div>
        </div>

                   
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Useful Years:</label>
              <input type="number" class="form-control" v-model="reducingbal.useful_years" />
            </div>
          </div>
        </div>
         <input type="hidden" name="depreciation_method_id" value="Declining Balance"  v-model="reducingbal.depreciation_method_id">
        <br>
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
          reducingbal:{}
        }
    },
    methods: {
    DepreciationCalculator()
    {
    var StraightLine = function(purchasePrice,salvageValue,usefulYears)
    {
    this.purchasePrice=purchasePrice;
    this.salvageValue = salvageValue;
    this.usefulYears=usefulYears;
    this.yearlyDepreciation = (this.purchasePrice-this.salvageValue)/this.usefulYears;

        return this.yearlyDepreciation;

    }

    var ReducingBal = function(purchasePrice,usefulYears)
    {
     this.purchasePrice=purchasePrice;
    this.usefulYears=usefulYears;
    this.depreciationRate = 100/this.usefulYears;
    this.doubleDepreciation = Math.round(this.depreciationRate)*2;
    this.eachYearDepreciation = new Array();
    this.eachYearBookValue = new Array();
    for(var i =0; i<this.usefulYears;i++)
    {
    this.eachYearDepreciation[i] =(this.doubleDepreciation/100)*this.purchasePrice;
    console.log(this.eachYearDepreciation[i]);
    }
    //this.depreciationValue =(doubleDepreciation/100)*this.purchasePrice;
    return this.depreciationValue;
    }

     var someAsset = new ReducingBal(30000,5);
    console.log(someAsset.depreciationValue);
      

    },
   
      /*calculateDepreciation(){
        let uri = 'http://localhost/ims/public/api/assets/depreciation';
        this.axios.post(uri, this.reducingbal).then((response) => {
          this.$router.push({name: 'list-fixed-assets'})
        })
    }*/
  }
}
</script>