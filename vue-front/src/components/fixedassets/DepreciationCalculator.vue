<template>
    <div>
       <div class="panel panel-default">
       <div class="panel-heading">
       <div class="panel-title">
       <h3>Depreciation Calculator</h3>

       </div
       </div>
       <div class="panel-body">
         <form v-on:submit.prevent="addCategory">
                       
           <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Asset No.:</label>
              <input v-validate="'required'" type="text" class="form-control col-md-6" v-model="asset.asset_no" />
              <span v-show="errors.has('required')">{{ errors.first('required') }}</span>
            </div>
          </div>
        </div>
        <h4>Don't have Asset Number</h4>
            <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Asset Purchase Price:</label>
              <input type="number" class="form-control col-md-6" v-model="asset.purchase_price" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Asset Useful Years:</label>
              <input type="number" class="form-control col-md-6" v-model="category.useful_years" />
            </div>
          </div>
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Asset Depreciation Method:</label>
              <input type="number" class="form-control col-md-6" v-model="asset.depreciation_method_id" />
            </div>
          </div>
        </div><br />

        <div class="form-group">
          <button class="btn btn-primary">Calculate</button>
        </div>
    </form>
       </div>
       </div>
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
               
                assetPrice:'',
                usefulYears:'',
                residualValue:'',
                deprMethod:'',
                assetNo:null
            }
        },

        created: function()
        {
            this.calDepreciation();
        },

        methods: {
            calDepreciation()
            {
              let uri = 'http://localhost/ims/public/api/assets/depreciation';
              this.axios.post(uri).then((response) => {
                  this.assets = response.data;
                  console.log(this.assets)
              });
            }
            
        }
    }
</script>