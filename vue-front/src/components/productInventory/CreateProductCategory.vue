<template>
  <div>
    <h3 class="title">Add  category</h3>
    <div class="alert alert-success" v-if="submitted">
                {{message}}
            </div>
    <form v-on:submit.prevent="addCategory">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>category Name:</label>
            <input type="text" class="form-control" v-model="category.category_name">
          </div>
        </div>
        </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Description:</label>
              <input type="text" class="form-control" v-model="category.description" />
            </div>
          </div>
        </div>
          
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <button class="btn btn-info pull-right">Save</button>
            </div>
          </div>
        </div>
                 

       
    </form>
  </div>
</template>
<script>
  export default {
    data(){
        return{
          category:{},
          message:'',
          submitted:false        }
    },
    methods: {
      addCategory(){
        let uri = 'http://127.0.0.1:8000/api/products/categories';
        this.axios.post(uri, this.category).then((response) => {
        console.log(response.data);
        this.message =response.data;
        this.submitted = true;
          //this.$router.push({name: 'list-categories'})
        })
    }
  }
}
</script>