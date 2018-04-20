<template>
    <div>
        <h3>Edit Category</h3>
        <div class="alert alert-success" v-if="submitted">
                {{message}}
            </div>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'display-asset-category' }" class="btn btn-success">Return to Categories</router-link></div>
        </div>

        <form v-on:submit.prevent="updateCategory">
            
            <div class="form-group">
                <label name="asset_category">Category</label>
                <input type="text" class="form-control" v-model="category.asset_category">
            </div>

             <div class="form-group">
                <label name="description">Description</label>
                <input type="text" class="form-control" v-model="category.description">
            </div>

             <div class="form-group">
                <label name="class_id">Class</label>
                <input type="text" class="form-control" v-model="category.class_id">
            </div>

             

            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</template>

<script>

    export default{
        data(){
            return{
                category:{},
                submitted:false,
                message:''
            }
        },

        created: function(){
            this.getCategory();
        },

        methods: {
            getCategory()
            {
              
                let uri = `http://127.0.0.1:8000/api/asset/categories/${this.$route.params.id}/edit`;
                this.axios.get(uri).then((response) => {
                    this.category = response.data;
;
                });
            },

            updateCategory()
            {
              let uri = 'http://127.0.0.1:8000/api/asset/categories/'+this.$route.params.id;
                this.axios.patch(uri, this.category).then((response) => {
                    this.message=response.data;
                     this.submitted = true
                  //this.$router.push({name: 'display-asset-category'});
                });
            }
        }
    }
</script>