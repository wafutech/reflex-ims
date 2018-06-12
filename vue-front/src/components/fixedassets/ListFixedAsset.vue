<template>
    <div>
        <h3 class="title">Asset Register</h3>        
         <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
             
          <button class="btn btn-success" v-on:click="openCreateAssetForm" v-show="!isCreating">Add Asset</button>
          <button class="btn btn-danger" v-on:click="closeCreateAssetForm" v-show="isCreating">CANCEL</button>
          </div>
        </div><br />
          <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>Asset No.</td>
                <td>Asset Description</td>
                <td>Category</td>
                <td>Date Acquired</td>
                <td>Purchase Price</td>
                <td></td>
            </tr>
            </thead>

            <tbody>
                <tr  v-for="asset in assets">
                    <td>{{asset.asset_no}}</td>
                    <td>{{asset.asset_description}}</td>
                    <td>{{asset.asset_category}}</td>
                    <td>{{asset.acquisition_date}}</td>
                    <td>{{asset.acquisition_cost}}</td>
                    <td>
                    <router-link :to="{name: 'show-asset', params: {id: asset.id}}" class="btn btn-success">Details</router-link></td>

                    <td><router-link :to="{name: 'edit-asset', params: {id: asset.id}}" class="btn btn-primary">Edit</router-link></td>                    
                    <td><button class="btn btn-danger" v-on:click="deleteAsset(asset.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
        <div v-show="isCreating">
        <CreateAsset></CreateAsset>
        </div>
    </div>
</template>


<script>
import CreateAsset from '../../components/fixedassets/CreateAsset'
    export default {
        components:
        {
        CreateAsset
        },
       
        data(){
            return{
               
                assets:{},
                isCreating:false,

            }
        },


        created: function()
        {
            this.fetchAssets();
            this.openCreateAssetForm();
            this.closeCreateAssetForm();


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
            },
            openCreateAssetForm()
            {
            this.isCreating = true;
            },
            closeCreateAssetForm()
            {
          this.isCreating = false;

            }
        }
    }
</script>