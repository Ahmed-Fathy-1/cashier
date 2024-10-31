<template>
    <div>
        <button @click="proccessToPayment">proccessToPayment</button>

        <br />  <br />  <br /> <hr/>

        {{ elements }}

        <form id="payment-form">
            <div id="payment-element">
                <!-- Stripe will create form elements here -->
            </div>
            
            <button type="submit" @click="handleSubmit">Pay via Stripe</button>
        </form>
    </div> 
</template>

<script setup>
import { extrnalUrl } from "@/config";
import axios from "axios";
import { ref, onMounted } from "vue"


const token = ref(null)
const stripe = ref(null)
const elements = ref(null)

const proccessToPayment = async()=>{
    await axios.post(`${extrnalUrl}payment/initiate`, {
        amount: 150,
        currency: 'USD',
        package_id: '2',
        package_type: '2',
        domain_name: 'fake domain',

    },
        {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        }
    ).then(response => {
        console.log(response);

        token.value = response.token // Use to identify the payment
        stripe.value = process.env.STRIPE_KEY;
        const options = {
            clientSecret: response.clientSecret,
        }

        elements.value = stripe.value.elements(options);
        const paymentElement = elements.value.create('payment');
        paymentElement.mount('#payment-element');
    }).catch(error => {
        // throw error
    })
}



const handleSubmit = async (e) => {
    e.preventDefault();
    const error = 'ahmed fathy abo om el errors';
    // const { error } = await stripe.value.confirmPayment({
    //     elements: elements.value,
    //     redirect: "if_required"
    // });

    if (error === undefined) {
        axios.post(`${extrnalUrl}payment/complete`, {
            token: token.value,
        },
            {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            }
        )
    } else {
        axios.post(`${extrnalUrl}payment/failure`, {
            token: token.value,
            code: error.code,
            description: error.message,
        },
            {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            }
        )
    }
}
</script>