<template>
    <div>
        <header>
            <div>
                <h2>Product Add</h2>
            </div>
             <div class="btns-header">                
                <button class="btn" v-on:click.prevent="addProduct" type="Submit">Save</button>

                <button class="btn" @click="back()">Cancel</button>
            </div>
        </header>
        <hr>
        <div class="errors">
            <span v-for="error in errors" :key="error.id">{{error}}<br></span>
        </div>
        <div class="form" >
            <form id="#product_form" >
                <!-- <div> -->
                    <input type="text" id="#sku" placeholder="SKU" v-model="sku" >
                    <input type="text" id="#name" placeholder="name" v-model="name" >
                    <input type="text" id="#price" placeholder="price" v-model="price" >
                <!-- </div> -->


                <!-- <div> -->
                    <select v-model="type" name="type" id="#productType" @change="getAttributes($event)" >
                            <option selected disabled>type</option>
                            <option :key="item.id" v-for="item in types" :value="item.id" :id="'#' + item.name" >{{item.name}}</option>
                    </select>
                <!-- </div> -->

                <div  v-for="attribute in attributes" :key="attribute.id" :id="'#' + attribute.name">
                    <span>{{attribute.name}} ({{attribute.unit}}) </span> 
                    <input :id="attribute.name"  class="input-field" name="field1" type="text"   v-model="attribute.value">
                </div>
                <p>{{type.description}}</p>

            </form>
        </div>
    </div>
</template>



<script>
import axios from 'axios';

export default {
    name: "AddProduct",
    data(){
        return {
            name:'',
            sku:'',
            price: '',
            type: 'type',
            errors: [],
            attributes: [],
            type_value: '',
            types: [],
            err: []
            }
            
        },
    methods: { 
            back(){
                    this.$router.push("/");
                },
            addProduct(){
                    var data = new FormData();
                    data.append("sku", this.sku);
                    data.append("name", this.name);
                    data.append("price", this.price);
                    data.append("type", this.type_value);
                    data.append("attributes", JSON.stringify(this.attributes));
                    for (const key in this.attributes) {
                            data.append(this.attributes[key].name,this.attributes[key].value);
                        }

                    axios
                    .post('https://store-php-api22.000webhostapp.com/api.php?action=addProduct',data)
                    .then(res => { 
                        if(res.data.errors){
                            this.errors = res.data.errors;
                        }else{
                            this.back();
                        }
                    })
                    .catch(err => (this.err = err.data))
                   
 

            }
            ,getAttributes(event){
                this.type_value = event.target.options[event.target.options.selectedIndex].text;
                let type_id = event.target.value;
                axios
                .get('https://store-php-api22.000webhostapp.com/api.php?action=getAttributes&type_id='+type_id)
                .then(res =>{
                    (this.attributes = res.data)
                    })
                .catch(err => {console.log("Error", err);});
                    
            }
          

    },mounted()
    {
        // this.getTypes();          
                axios
                .get('https://store-php-api22.000webhostapp.com/api.php?action=getTypes')
                .then(res => {
                    this.types = res.data;
                })
                .catch(err => {console.log("Error", err);});

          
        

    }
}
</script>



<style scoped>

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
header h2 {
    margin-left: 20px; 
}
.btn {
    color: #fff;
    border: none;
    background-color: #2196f3;
    padding: 5px;
    border-radius: 4px;
    transition-duration: .3s;
    transition-property: all;
    transition-timing-function: ease-in-out;
    cursor: pointer;
}
.btn a {
    text-decoration: none;
    color: #fff;
}

form {
    display: flex;
    align-items: center;
    flex-direction: column;
    
}
form div {
    margin: 20px 0;
    display: flex;
    flex-direction: column;
}
form input,select {
    margin-bottom: 5px;
    padding: 4px;
    border-radius: 5px;
    border: 1px solid #2196f3;
}

.errors {
    position:absolute;
    margin: 25px 160px;
    color: red;
} 




</style>