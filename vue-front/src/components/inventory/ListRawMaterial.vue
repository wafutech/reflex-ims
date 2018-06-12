<template>
    <div>
        <h3 class="title">Raw Materials</h3>
               <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create-product'}" class="btn btn-success">Add Raw Material</router-link>
          </div>
        </div><br />

        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
            
                <th>Raw Material Name</th>
                <th>Description</th>
                <th>Opening Quantity</th>
                <th>Unit of Measure</th>
                <th>Opening Value</th>
                <th>Prefered Supplier</th>
                 <th>Re-Order Level</th>
                 <th>Re-Order Quantity</th>
                
            </tr>
            </thead>

            <tbody>
                <tr v-for="raw_material in raw_materials"
            :key="raw_material.id">
                    <td>{{ raw_material.raw_material_name }}</td>
                    <td>{{ raw_material.raw_material_desc }}</td>
                    <td>{{ raw_material.quantity_in_hand }}</td>
                    <td>{{ raw_material.starting_value }}</td>
                    <td>{{ raw_material.prefered_supplier }}</td>
                    <td>{{ raw_material.reorder_level }}</td>
                     <td>{{ raw_material.reorder_quantity }}</td>
                                        
                    <td><router-link :to="{name: 'edit-raw-material', params: { id: raw_material.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" v-on:click="deleteRawMaterial(raw_material.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
                raw_materials: []
            }
        },

        created: function()
        {
            this.fetchRawMaterials();
            this.deleteRawMaterial(id);
        },

        methods: {
            fetchRawMaterials()
            {
              let uri = 'http://127.0.0.1:8000/api/raw-materials';
              this.axios.get(uri).then((response) => {
                  this.raw_materials = response.data;
                  
              });
            },
            deleteRawMaterial(id)
            {
              let uri = `http://127.0.0.1:8000/api/raw-materials/${id}`;
              this.raw_materials.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>

