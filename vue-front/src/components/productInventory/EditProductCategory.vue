<template>
    <div>
        <h3 class="title">Edit Product Category</h3>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'list-product-category' }" class="btn btn-success">Return to Categories</router-link></div>
        </div>

        <form v-on:submit.prevent="updateCategory">
            
            <div class="form-group">
                <label name="category_name">Category</label>
                <input type="text" class="form-control" v-model="category.category_name">
            </div>

             <div class="form-group">
                <label name="description">Description</label>
                <input type="text" class="form-control" v-model="category.description">
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
                category:{}
            }
        },

        created: function(){
            this.getCategory();
        },

        methods: {
            getCategory()
            {
              let uri = `http://localhost/ims/public/api/categories/${this.$route.params.id}/edit`;
                this.axios.get(uri).then((response) => {
                    this.category = response.data;
                });
            },

            updateCategory()
            {
              let uri = 'http://localhost/ims/public/api/products/categories/'+this.$route.params.id;
                this.axios.patch(uri, this.category).then((response) => {
                  this.$router.push({name: 'list-product-categories'});
                });
            }
        }
    }
</script>