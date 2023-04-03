<template>
<div>


    <router-link to="/"> Home</router-link>
    <router-link v-bind:to="{name:'second'}"> second </router-link>
    <router-link :to="{name:'help'}"> Help</router-link>

    <router-view></router-view>

</div>



</template>
