<template>
 <div>
        <div class="container">
            <h1>My Applications </h1>
             <!--
            <applications-list-item v-bind:price="30" month="June"> </applications-list-item>

            <applications-list-item :price="10" month="January"> </applications-list-item>
            -->

            <ul>
                <li v-for = "user in users">
                    <h3> user.firstname</h3>

                </li>
            </ul>



        </div>




 </div>
</template>


<script>
    import ApplicationsListItem from "./ApplicationsListItem";

    export default {

       components: {
           ApplicationsListItem:ApplicationsListItem
       },

        props:['users'],


    }
</script>
