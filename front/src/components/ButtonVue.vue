<template>
    <button @click="onClick()" :type="type" :style="{ background: color, borderRadius: border ,width: width}" class="btn">{{ nameBtn }}</button>
</template>



<script>
export default {
    name:'ButtonVue',
    props: {
        nameBtn: String,
        color:String,
        border:String,
        width:String,
        type:String
    },
    methods: {
        onClick(){
            this.$emit('toggle-add-task')
        }
    },
}
</script>
<style scoped lang="scss">

</style>
