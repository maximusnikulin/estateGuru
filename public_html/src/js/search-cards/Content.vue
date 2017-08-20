<template>
    <div class = "content">
        <h1>{{title}}</h1>
    </div>
</template>

<script>    

export default {
    name:'vue-content',
    props: ["title"]   
}
</script>
<style scoped> 
    .content {
        border:2px solid red;
        margin:10px;
    }
</style> 