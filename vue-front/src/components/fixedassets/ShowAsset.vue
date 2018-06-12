<template>
    <div>
       
        <div class="panel panel-info">
        <div class="panel-heading">
        <div class="panel-title">
        <h3>{{asset.asset_description}}</h3>
        </div>
        </div>
        <div class="panel-body">
        <div class="row">
        <div class="col-md-9">
        <table class="table">
        <tr>
        <td>
          <label>supplier</label>        
        </td>
        {{asset.company}}
        <td>
        </td>
        </tr>

        <tr>
        <td>
          <label>Category</label>
        
        </td>
        {{asset.asset_category}}
        <td>
        </td>
        </tr>

        <tr>
        <td>
          <label>Purchase Price</label>
        
        </td>
        {{asset.acquisition_cost}}
        <td>
        </td>
        </tr>
        <tr>
        <td>
          <label>Asset No.</label>
        
        </td>
        {{asset.asset_no}}
        <td>
        </td>
        </tr>

        <tr>
        <td>
          <label>Serial No.</label>
        
        </td>
        {{asset.serial_no}}
        <td>
        </td>
        </tr>

        <tr>
        <td>
          <label>Depreciation Method</label>
        
        </td>
        {{asset.depreciation_method}}
        <td>
        </td>
        </tr>

        <tr>
        <td>
          <label>Useful Years</label>
        
        </td>
        {{asset.useful_years}}
        <td>
        </td>
        </tr>

        <tr>
        <td>
          <label>Salvage Value</label>
        
        </td>
        {{asset.salvage_value}}
        <td>
        </td>
        </tr>

        <tr>
        <td>
          <label>Previous Depreciation</label>
        
        </td>
        {{asset.previous_depreciation}}
        <td>
        </td>
        </tr>

        <tr>
        <td>
          <label>Current Depreciation</label>
        
        </td>
        {{asset.depreciation_this_period}}
        <td>
        </td>
        </tr>

        <tr>
        <td>
          <label>Model</label>
        
        </td>
        {{asset.model}}
        <td>
        </td>
        </tr>

        <tr>
        <td>
          <label>Condition</label>
        
        </td>
        {{asset.condition}}
        <td>
        </td>
        </tr>

        </table>
        </div>
        <div class="col-md-3">
        <h3>{{asset.depreciation_method}}</h3>
        <p>{{asset.description}}</p>
        </div>
        </div>
        
        </div>
        <div class="panel-footer">
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'list-assets' }" class="btn btn-success">Return to Items</router-link></div>
        </div>
        </div>
        </div>        

        
    </div>
</template>

<script>

    export default{
        data(){
            return{
                asset:{},
                message:'',
                submitted:false
            
                        }
        },

        created: function(){
            this.getAsset();
        },

        methods: {
            getAsset()
            {
              let uri = `http://127.0.0.1:8000/api/assets/${this.$route.params.id}`;
                this.axios.get(uri).then((response) => {
                    this.asset = response.data;
                });
            },

            updateAsset()
            {
              let uri = 'http://127.0.0.1:8000/api/assets/'+this.$route.params.id;
                this.axios.patch(uri, this.asset).then((response) => {
                this.message = 'Asset Updated';
                this.submitted = true;
                  //this.$router.push({name: 'displayAsset'});
                });
            }
        }
    }
</script>