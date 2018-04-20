<template>
    <div>
        <h3 class="title">Suppliers</h3>
               <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create-supplier'}" class="btn btn-primary">Add Supplier</router-link>
          </div>
        </div><br />

        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Company</td>
                <td>Mobile Phone</td>
                <td>Work Phone</td>
                <td>Telephone Code</td>
                <td>Email</td>
                <td>Postal Address</td>
                <td>Town/City</td>
                <td>Postal Code</td>
                
            </tr>
            </thead>

            <tbody>
                <tr v-for="supplier in suppliers">
                    <td>{{ supplier.first_name }}</td>
                    <td>{{ supplier.last_name }}</td>
                    <td>{{ supplier.company }}</td>
                    <td>{{ supplier.mobile_number }}</td>
                    <td>{{ supplier.work_phone }}</td>
                    <td>{{ supplier.phone_code }}</td>
                    <td>{{ supplier.email }}</td>
                    <td>{{ supplier.postal_address }}</td>
                    <td>{{ supplier.town }}</td>
                    <td>{{ supplier.zip }}</td>
                   
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
                suppliers: []
                
            }
        },

        created: function()
        {
            this.fetchSuppliers();
        },

        methods: {
            fetchSuppliers()
            {
              let uri = 'http://localhost/ims/public/api/suppliers';
              this.axios.get(uri).then((response) => {
                  console.log(this.suppliers);
                  this.suppliers = response.data;
              });
            },
            deleteSupplier(id)
            {
              let uri = `http://localhost/ims/public/api/suppliers/${id}`;
              this.suppliers.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>