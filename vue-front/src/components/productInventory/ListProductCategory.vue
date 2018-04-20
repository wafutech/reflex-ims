<template>
    <div>
        <h3 class="title">Product Categories</h3>
               <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create-product-category'}" class="btn btn-success">Add Category</router-link>
          </div>
        </div><br />

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
                    <td>{{ category.category_name }}</td>
                    <td>{{ category.description }}</td>
                    <td><router-link :to="{name: 'edit-product-category', params: { id: category.id }}" class="btn btn-primary">Edit</router-link></td>                    
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
                categories: []
            }
        },

        created: function()
        {
            this.fetchCategories();
        },

        methods: {
            fetchCategories()
            {
              let uri = 'http://127.0.0.1:8000/api/product/categories';
              this.axios.get(uri).then((response) => {
                  this.categories = response.data;
                  console.log(this.categories);
              });
            },
            deleteCategory(id)
            {
              let uri = 'http://127.0.0.1:8000/api/product/categories/${id}';
              this.categories.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>