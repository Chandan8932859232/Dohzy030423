<template>
    <div>

        <div class="container">

            <strong>amount: {{price}} dollars</strong>
            <p> pay month : {{month}} </p>
            <hr>

        </div>


    </div>
</template>


<script>
    export default {
        props: { "price" : Number, "month": String },



        data(){
            return {
             users: [
                    {firstname:'Fidelis' , lastname:'Njikem', age:'40'},
                    {firstname:'David' , lastname:'Chappel', age:'71'},
                    {firstname:'Kevin' , lastname:'Hear', age:'43'},

                ]


            }


        }

    }
</script>

