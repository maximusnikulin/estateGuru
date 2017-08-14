<template>
    <div>
    <h1>{{title}}</h1>
    <vue-slider 
        v-model = "slider.value"
        v-bind = "slider"></vue-slider>
     <vue-select  
        v-bind:value.sync = "select.selected"
        v-bind:options = "select.values"
        ></vue-select>
    </div>
</template>

<script>    
import vueSlider from 'vue-slider-component';
import vSelect from "./vue-select.js"

export default {
    name:'root',
    components: {
		'vue-slider' : vueSlider,
        'vue-select' : vSelect
	},
    data: function(){
        return {
            title: "Hey vue",
            slider: {
                value:[0, 20],
                dotSize: 20
            },
            select: {
                selected:null,
                values: ["one","two","three", "four"]
            }
        }
    }
}
</script>
<style> 

</style> 