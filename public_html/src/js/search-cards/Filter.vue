<template>
    <div class = "filter-b">
        <h1>{{title}}</h1>
        <input type = "range" min = "0" max = "200" v-model = "price"/>
        <select v-model = "selected" >
            <option value = "FirstClause">First clause</option>  
            <option value = "SecondClause">Second clause</option>                          
        </select>
        <button v-on:click = "handleClick">Клик</button>    
    </div>
</template>

<script>   
// Vue.filter("getDistrict", function(value){
//     return value.name
// }) 
import {bus} from './index.js';
export default {
    name:'vue-filter', 
    props: [
        "title"
    ],
    created: function(){
        bus.$on("changeUrl", this.getData)
    },
    data: function(){
        return {
            price:0,
            selected:"FirstClause"
        }
    },
    methods: {
        getData:function(query) {
            console.log(query)
        }
    }   
}
</script>
<style >    
    .filter-b {
        border:2px solid green;
        margin:10px;
    }
</style> 