<template>
    <div>
        <h3 class="title">Asset Categories</h3>
               <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create-asset-category'}" class="btn btn-success">Add Category</router-link>
          </div>
        </div><br />
        <div class="alert alert-success" v-if="submitted">
                {{message}}
            </div>
        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>Category Name</td>
                <td>Description</td>
                
                 <td>Actions</td>
            </tr>
            </thead>

            <tbody>
                <tr v-for="category in categories">
                    <td>{{ category.asset_category }}</td>
                    <td>{{ category.description }}</td>
                    <td><router-link :to="{name: 'edit-asset-category', params: { id: category.id }}" class="btn btn-primary">Edit</router-link></td>                    
                    <td><button class="btn btn-danger" v-on:click="deleteCategory(category.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
        data(){
            return{
                categories: [],
                submitted:false,
                message:''
            }
        },

        created: function()
        {
            this.fetchCategories();
        },

        methods: {
            fetchCategories()
            {
              let uri = 'http://127.0.0.1:8000/api/asset/categories';
              this.axios.get(uri).then((response) => {
                  this.categories = response.data;
              });
            },
            

            deleteCategory(id)
            {
            
              let uri = 'http://127.0.0.1:8000/api/asset/categories/${id}';
             this.categories.splice(id, 1);
              this.axios.delete(uri).then((response)=>
              {
                  this.message=response.data;              this.submitted = true;
             
              });
                           }
        }
    }
</script>