<template>
    <div>  
        <header>
            <div>
                <h2>Product List</h2>
            </div>
           <div class="btns-header">
                <button class="btn"><router-link to="addproduct">ADD</router-link></button>
           <button class="btn" id="delete-product-btn" value="MASS DELETE" @click="massDelete()">MASS DELETE</button>
           </div>
        </header>
        <hr>
        <div class="con">
            <div class="card"  v-bind:key="objData.id" v-for="objData in products" >
                <input type="checkbox" class="delete-checkbox" :id="objData.id">
                <ul>
                    <li>{{objData.sku}}</li>
                    <li>{{objData.name}}</li>
                    <li>{{objData.price}}$</li>
                    <li>{{objData.front_end}}</li>

                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import AddProduct from './AddProduct';
export default {
    name: 'ProductList',
    components: {
    AddProduct,
},
  data() {
    return {
        products: [],
        toDelete:[],
        }
  },  
  methods: {
      massDelete(){
        let checks = document.getElementsByClassName("delete-checkbox");
        for(let i=0;i<checks.length;i++){
        if(checks[i].checked == true){
            this.toDelete.push(checks[i].id);
            }
        }
        var data = new FormData();
        data.append("toDeleteArray", this.toDelete);
        axios
          .post("http://scandiwebtestapp.herokuapp.com/public/home/delete",data)
            .then(res => {
              if (res.data.error) {
                console.log("Error", res);

              } else {
                  this.getAllData();
              }
            })
            .catch(err => {
              console.log("Error", err);
            });
        },
     getAllData(){
           axios
            .get('http://scandiwebtestapp.herokuapp.com/public/home/getData')
              .then(res => (this.products = res.data))
              .catch(err => {
                console.log("Error", err);
            })
        }
    

   
  },
  mounted () {
  this.getAllData();
  },
}
</script>



<style  scoped>
header{
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.btns-header {
    margin-right: 50px;
    width: 20%;
    display: flex;
    justify-content: space-around;
}
.btn {
    color: #fff;
    border: none;
    background-color: #2196f3;
    padding: 5px;
    border-radius: 4px;
    /* transition-duration: .3s; */
    /* transition-property: all; */
    /* transition-timing-function: ease-in-out; */
    /* cursor: pointer; */
}
.btn a {
    text-decoration: none;
    color: #fff;
}
/* .btn:hover {
    transform: scale(.95);
} */
header h2 {
    margin-left: 20px; 
}

ul {
    list-style: none;
}
.con {
    margin: 10px;
    width: 100%;
    display: flex;
    flex-wrap: wrap;
}
.card {
    position: relative;
    border: 1px solid #2196f3;
    border-radius: 5px;
    width: 250px;
    padding: 5px;
    margin: 10px;
}

.card ul {
    margin-left: 50%;
    margin-bottom: 10px;
    transform: translateX(-50%);
    text-align: center;
}



</style>