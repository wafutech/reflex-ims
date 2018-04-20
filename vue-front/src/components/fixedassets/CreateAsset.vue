<template>
  <div>

    <h3 class="title">Add Fixed Asset</h3>
    <form v-on:submit.prevent="addAsset" method="post">
      <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Asset Description:</label>
            <input type="text" class="form-control" v-model="asset.asset_description">
          </div>
        </div>
        </div>

        
        <div v-cloak>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
            <label>Category:</label>
             <select v-model="asset.category_id" class="form-control select-input" style="height:40px;">
            <option value="null" selected>Select Category</option>
            <option v-for="category in categories" v-bind:value="category.id">{{category.description}}</option>
        </select> 
            </div>
          </div>
        </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Date Acquired:</label>
              <input type="date" class="form-control date-picker" v-model="asset.acquisition_date" />
            </div>
          </div>
        </div>
          
          <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Acquisition Cost:</label>
              <input type="number" class="form-control" v-model="asset.acquisition_cost" />
            </div>
          </div>
        </div>
        
        

         <div v-cloak>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
            <label>Supplier:</label>
             <select v-model="asset.supplier_id" class="form-control select-input" style="height:40px;">
            <option value="null" selected>Select Supplier</option>
            <option v-for="supplier in suppliers" v-bind:value="supplier.id">{{supplier.company}}</option>
        </select> 
            </div>
          </div>
        </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Phisical Location:</label>
              <input type="text" class="form-control" v-model="asset.phisical_location" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Asset Number:</label>
              <input type="text" class="form-control disabled" v-model="asset.asset_no" />
            </div>
          </div>
        </div>

          

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Serial Number:</label>
              <input type="text" class="form-control" v-model="asset.serial_no" />
            </div>
          </div>
        </div>

           
         <div v-cloak>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
            <label>Depreciation Method:</label>
             <select v-model="asset.depreciation_method_id" class="form-control" style="height:40px;">
            <option value="null" >Select Depreciation Method</option>
            <option v-for="method in depreciations" v-bind:value="method.id">{{method.depreciation_method}}</option>
        </select> 
            </div>
          </div>
        </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Useful Years:</label>
              <input type="number" class="form-control" v-model="asset.useful_years" />
            </div>
          </div>
        </div>


           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Salvage Value:</label>
              <input type="text" class="form-control" v-model="asset.salvage_value" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Previous Depreciation:</label>
              <input type="text" class="form-control" v-model="asset.previous_depreciation" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Depreciation in this period:</label>
              <input type="text" class="form-control" v-model="asset.depreciation_in_this_period" />
            </div>
          </div>
        </div>

            <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Model (Optional):</label>
              <input type="text" class="form-control" v-model="asset.model" />
            </div>
          </div>
        </div>

           

         <div v-cloak>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
            <label>Asset Condition:</label>
             <select v-model="asset.asset_condintion_id" class="form-control select-input" style="height:40px;">
            <option value="null" selected>Select Condition</option>
            <option v-for="condition in conditions" v-bind:value="condition.id">{{condition.condition}}</option>
        </select> 
            </div>
          </div>
        </div>
        </div>
        </br>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
                <button class="btn btn-info pull-right">Save</button>

            </div>
          </div>
        </div><br />

       
    </form>
  </div>
</template>
<script>
import axios from 'axios';

  export default {
  name:'CreateAsset',
    data(){
        return{
            categories:{},
            suppliers:{},
            conditions:{},
            depreciations:{},
            asset:{}
        }
    },

     created: function()
        {
            this.retrieveCatgories();
            this.retrieveAssetConditions();
            this.retrieveSuppliers();
            this.retrieveAssetConditions();
            this. retrieveDepreciations();


        },

    methods: {
            retrieveCatgories()
            {
            var _this = this;
            let uri = 'http://127.0.0.1:8000/api/lists/categories';
           axios.get(uri).then((resp) => {
                  _this.categories = resp.data;
              });
            },

            retrieveSuppliers()
            {
            var _this = this;
            let uri = 'http://127.0.0.1:8000/api/lists/suppliers';
           axios.get(uri).then((supplier) => {
                  _this.suppliers = supplier.data;
              });
            },
            retrieveDepreciations()
            {
            var _this = this;
            let uri = 'http://127.0.0.1:8000/api/lists/asset-depreciations';
           axios.get(uri).then((dep) => {
                  _this.depreciations = dep.data;
              });
            },

            retrieveAssetConditions()
            {
            var _this = this;
            let uri = 'http://127.0.0.1:8000/api/lists/asset-conditions';
           axios.get(uri).then((condition) => {
                  _this.conditions = condition.data;
              });
            },
      addAsset(){
        var _this = this;
        let uri = 'http://127.0.0.1:8000/api/assets';
        axios.post(uri, _this.asset).then((response) => {
        console.log(response.data)
          this.$router.push({name: 'list-fixed-assets'})
        })
    }
    
  }
}
</script>