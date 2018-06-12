<template>
    <div>
        <h3 class="title">Edit Asset</h3>
        
            <div class="alert alert-success" v-if="submitted">
                {{message}}
            </div>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'displayAsset' }" class="btn btn-success">Return to Items</router-link></div>
        </div>

        <form v-on:submit.prevent="updateAsset">
            <div class="form-group">
                <label>Asset Description</label>
                <input type="text" class="form-control" v-model="asset.asset_description">
            </div>

            <div class="form-group">
                <label name="category_id">Category</label>
                <input type="text" class="form-control" v-model="asset.category_id">
            </div>

             <div class="form-group">
                <label name="acquisition_cost">Acquisition Cost</label>
                <input type="text" class="form-control" v-model="asset.acquisition_cost">
            </div>

             <div class="form-group">
                <label name="asset_no">Asset No.</label>
                <input type="text" class="form-control" v-model="asset.asset_no">
            </div>

             <div class="form-group">
                <label name="serial_no">Serial No.</label>
                <input type="text" class="form-control" v-model="asset.serial_no">
            </div>

             <div class="form-group">
                <label name="depreciation_method_id">Depreciation Method</label>
                <input type="text" class="form-control" v-model="asset.depreciation_method_id">
            </div>

             <div class="form-group">
                <label name="useful_years">Useful Years</label>
                <input type="text" class="form-control" v-model="asset.useful_years">
            </div>

             <div class="form-group">
                <label name="salvage_value">Salvage Value</label>
                <input type="text" class="form-control" v-model="asset.salvage_value">
            </div>
             <div class="form-group">
                <label name="previous_depreciation">Previous Depreciation</label>
                <input type="text" class="form-control" v-model="asset.previous_depreciation">
            </div>

             <div class="form-group">
                <label name="depreciation_this_period">Depreciation this Period</label>
                <input type="text" class="form-control" v-model="asset.depreciation_this_period">
            </div>

             <div class="form-group">
                <label name="model">Model</label>
                <input type="text" class="form-control" v-model="asset.model">
            </div>

             <div class="form-group">
                <label name="asset_condition_id">Asset Condition</label>
                <input type="text" class="form-control" v-model="asset.asset_condition_id">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
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
            
               return this.axios.get(`assets/${this.$route.params.id}/edit`).then((response) => {
                    this.asset = response.data;
                });
            },

            updateAsset()
            {
             
               return this.axios.patch('assets'+this.$route.params.id, this.asset).then((response) => {
                this.message = 'Asset Updated';
                this.submitted = true;
                  //this.$router.push({name: 'displayAsset'});
                });
            }
        }
    }
</script>