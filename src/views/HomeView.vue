<template>
  <div id="app">
  <!-- <AddProduct v-on:addProduct="addproduct"/> -->
            <!-- <div><button @click="test">test</button></div> -->
  <ProductList />
  <!-- <button @click="test">test</button> -->
  </div>
</template>

<script>
import axios from 'axios';
import ProductList from '../components/ProductList';
import AddProduct from '../components/AddProduct';

export default {
  name: 'Home',
  components: {
    ProductList,
    AddProduct
},


  }

</script>

<style>
* {
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  font-weight: 1.4;
}
</style>

