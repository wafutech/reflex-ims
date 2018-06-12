<template>
    <div>
        <h3 class="title">Warehouses</h3>
               <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create-ware-house'}" class="btn btn-success">Add Warehouse</router-link>
          </div>
        </div><br />

        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
            
                <th>Ware House Name</th>
                <th>Code</th>
                <th>Location</th>
                                
            </tr>
            </thead>

            <tbody>
                <tr v-for="warehouse in warehouses"
            :key="warehouse.id">
                    <td>{{ warehouse.warehouse_name }}</td>
                    <td>{{ warehouse.warehouse_code }}</td>
                    <td>{{ warehouse.location }}</td>
                    
                                        
                    <td><router-link :to="{name: 'edit-warehouse', params: { id: warehouse.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" v-on:click="deleteWarehouse(warehouse.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
                warehouses: []
            }
        },

        created: function()
        {
            this.fetchWareHouses();
            this.deleteWarehouse(id);
        },

        methods: {
            fetchWareHouses()
            {
              let uri = 'http://127.0.0.1:8000/api/ware-houses';
              this.axios.get(uri).then((response) => {
                  this.warehouses = response.data;
                  
              });
            },
            deleteWarehouse(id)
            {
              let uri = `http://127.0.0.1:8000/api/raw-materials/${id}`;
              this.warehouses.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>

