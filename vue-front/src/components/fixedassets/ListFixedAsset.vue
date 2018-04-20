<template>
    <div>
        <h3 class="title">Asset Register</h3>        
         <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{name: 'create-asset'}" class="btn btn-success">Add Asset</router-link>
          </div>
        </div><br />
          <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>Asset No.</td>
                <td>Asset Description</td>
                <td>Category</td>
                <td>Serial No.</td>
                <td>Date Acquired</td>
                <td>Acquisition Price</td>
                <td>Supplier</td>
                <td>Asset Phisical Location</td>
                <td>Useful Years</td>
                <td>Salvage Value</td>
                <td>Condition</td>
                <td>Closing Bal</td>
                <td>Actions</td>
            </tr>
            </thead>

            <tbody>
                <tr  v-for="asset in assets">
                    <td>{{asset.asset_no}}</td>
                    <td>{{asset.asset_description}}</td>
                    <td>{{asset.asset_category}}</td>
                    <td>{{asset.serial_no}}</td>
                    <td>{{asset.date_acquired}}</td>
                    <td>{{asset.acquisition_cost}}</td>
                    <td>{{asset.company}}</td>
                    <td>{{asset.phisical_location}}</td>
                    <td>{{asset.useful_years}}</td>
                    <td>{{asset.salvage_value}}</td>
                    <td>{{asset.condition}}</td>
                     <td>{{ asset.closing_bal }}</td>
                    <td><router-link :to="{name: 'edit-asset', params: {id: asset.id}}" class="btn btn-primary">Edit</router-link></td>                    
                    <td><button class="btn btn-danger" v-on:click="deleteAsset(asset.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
               
                assets:{}

            }
        },


        created: function()
        {
            this.fetchAssets();
        },

        methods: {
            fetchAssets()
            {
              let uri = 'http://127.0.0.1:8000/api/assets';
              this.axios.get(uri).then((response) => {
                  this.assets = response.data;
              });
            },
            deleteAsset(id)
            {
              let uri = 'http://127.0.0.1:8000/api/assets/${id}';
              this.assets.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>