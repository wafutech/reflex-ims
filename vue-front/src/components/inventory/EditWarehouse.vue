<template>
    <div>
        <h3 class="title">Edit Ware House</h3>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'list-warehouses' }" class="btn btn-success">Back</router-link></div>
        </div>

        <form v-on:submit.prevent="updateWarehouse">
            <div class="form-group">
                <label>Ware House Name</label>
                <input type="text" name="warehouse_name" class="form-control" v-model="warehouse.warehouse_name" v-validate="'required'">
                <div class="help-block" alert alert-danger v-show="errors.has('warehouse_name')">
                {{errors.first('warehouse_name')}}
                </div>
            </div>

            <div class="form-group">
                <label>Ware House Code (Optional):</label>
                <input type="text" name="warehouse_code" class="form-control" v-model="warehouse.warehouse_code" v-validate="'string'">
                <div class="help-block" alert alert-danger v-show="errors.has('warehouse_code')">
                {{errors.first('warehouse_code')}}
                </div>
            </div>

            <div class="form-group">
                <label>Location:</label>
                <input type="text" name="location" class="form-control" v-model="warehouse.quantity_in_hand" v-validate="'string'">
                <div class="help-block" alert alert-danger v-show="errors.has('location')">
                {{errors.first('location')}}
                </div>
            </div>

                   
                     
            <div class="form-group">
                 <button class="btn btn-success pull-right">Update</button>
            </div>
             

            
        </form>
    </div>
</template>

<script>

    export default{
        data(){
            return{
                warehouse:{},
                

            }
        },

        created: function(){
            this.updateWarehouse();
            
        },

        methods: {
           

            updateWarehouse()
            {
              let uri = 'http://127.0.0.1:8000/api/ware-houses/'+this.$route.params.id;
                this.axios.patch(uri, this.warehouse).then((response) => {
                  this.$router.push({name: 'list-warehouses'});
                });
            }
          

         
        }
    }
</script>