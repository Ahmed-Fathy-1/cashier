<template>
    <div class="success">
        <div>
            <img src="/images/success.png" alt="success">
            <p>Thank you for subscripe</p>
        </div>
    </div>
</template>


<style>
    .success{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;

       /* background:url('/src/assets/images/banner-svg.svg'); */
        background-size: cover;
        background-position: 0 0;
    }

    .success div{
        max-width: 650px;
        display: flex;
        align-items: center;
        gap: 3rem;
        font-size: 3rem;
    }
    .success div img{
        max-width: 300px;
    }
</style>