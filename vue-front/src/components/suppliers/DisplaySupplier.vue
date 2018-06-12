<template>
    <div>
        <h3 class="title">Suppliers <span class="pull-right"> <router-link :to="{ name: 'create-supplier'}" class="btn btn-success">Add Supplier</router-link></span></h3>
               
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Supplier Name (Co.)</th>
                            
                <th>Mobile Phone</th>
                <th>Work Phone</th>
                <th>Telephone Code</th>
                <th>Contact Title</th>
                <th>Contact Name</th>
                <th>Email</th>
                <!--<th>Country</th>
               <th>Postal Address</th>
                <th>Town/City</th>
                <th>Postal Code</th>-->
                
            </tr>
            </thead>

            <tbody>
                <tr v-for="(supplier,index) in suppliers">
                <td>{{ supplier.supplier_name }}</td>

                    <td>{{ supplier.mobile_number }}</td>
                    <td>{{ supplier.work_phone }}</td>
                    <td>{{ supplier.phone_code }}</td>
                    <td>{{ supplier.contact_title }}</td>
                    <td>{{ supplier.contact_name }}</td>
                   
                    <td>{{ supplier.email }}</td>
                    <!-- <td>{{ supplier.country }}</td>
                   <td>{{ supplier.postal_address }}</td>
                    <td>{{ supplier.town }}</td>
                    <td>{{ supplier.zip }}</td>-->
                   
                    <td><router-link :to="{name: 'edit-supplier', params: { id: supplier.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" v-on:click="deleteSupplier(supplier.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
        name:'displayAsset',
        data(){
            return{
                suppliers: {}
                
            }
        },

        created: function()
        {
            this.fetchSuppliers();
        },

        methods: {
            fetchSuppliers()
            {
              let uri = 'http://127.0.0.1:8000/api/suppliers';
              this.axios.get(uri).then((response) => {
                  this.suppliers = response.data;
              });
            },
            deleteSupplier(id)
            {
              let uri = `http://127.0.0.1:8000/api/suppliers/${id}`;
              this.suppliers.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>