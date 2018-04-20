<template>
  <div>
    <h3 class="title">New Asset Category</h3>
    <form v-on:submit.prevent="addCategory">            
                    

           <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Category:</label>
              <input type="text" class="form-control" v-model="category.asset_category" />
              
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

        <div v-cloak>
        <div class="row">
          <div class="col-md-6">
          <div class="form-group">
            <label>Class:</label>
            <select v-model="category.class_id" class="form-control" style="height:40px;">
            <option value="null" selected>Select Class</option>
            <option v-for="c in classes" v-bind:value="c.id">{{c.code}}</option> 
          </select> 


          </div>
          </div>
          </div>
        </div>

                     
          
        <br />

        <div class="form-group">
          <button class="btn btn-info">Save Category</button>
        </div>
    </form>
  </div>
</template>
<script>
import axios from 'axios';

  export default {

    data(){
        return{
          classes:{},
          category:{}
        }
    },

    created: function()
        {
            this.retrieveCatgoryClasses();
           
        },
    methods: {

          retrieveCatgoryClasses(){
          var _this =this;
        let uri = 'http://127.0.0.1:8000/api/lists/asset-classes';
        axios.get(uri).then((classes) => {
        _this.classes = classes.data;
          
        })
    },
    
      addCategory(){
      var _this =this;
        let uri = 'http://127.0.0.1:8000/api/asset/categories';
        _this.axios.post(uri, _this.category).then((response) => {
          console.log(_this.response.data);
          _this.$router.push({name: 'display-asset-category'})

        })
    }
  }
}
</script>