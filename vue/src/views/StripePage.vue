<template>
    <form id="payment-form">
        <div id="payment-element">
            <!-- Stripe will create form elements here -->
        </div>
        <button type="submit" @click="handleSubmit">Pay via Stripe</button>
    </form>
</template>

<script>
import payPackage from "@/api/post/payPackage";
import { extrnalUrl } from "@/config";
import axios from "axios";
import { ref, onMounted } from "vue"

export default {
    name:'stripe',

    data:()=>({
      subDomain: "",
      errorMessage: "",
      mark: false,
      disable: true,
      errorMsg: "",
      color: "",
      res: {},
      cash: "card",
      isOpen: false,
      type: "",
      amount: "",
      image: null,
      plan: {},
      walletPhone: "",
      isPaying: false,
      domainMsg: "You must enter a valid sub domain first.",
      loader: false,
      valueMonth: 300,
      valueYear: 3000,
  
      domainError:"",
      planError:"",
      receiptError:"", 

      package : {},

      stripe: null,
      cardElement: null,
      stripeKey:process.env.STRIPE_KEY
       
    })
}



const payData = ref({
      token:'',
});

const token = ref(null)
const stripe = ref(null)
const elements = ref(null)

const package_id = ref(null)

console.log(
    localStorage.getItem('token')
);

const payPackage = async (path, body)=>{
    let data = null;
    let token = '';
    
        if (localStorage.getItem('token') && localStorage.getItem('token') !== 'undifined') {
            token = localStorage.getItem('token');
        }

        try{

            await api.post(`${extrnalUrl}pay-package`, body , {
                headers:{
                    'Authorization': `Bearer ${token}`
                },

            }).then((response) => {
                data = response.data.data;
                token = response.data.data.token;

                //console.log(response.data);
            //  token = response.data.data.token;
            // localStorage.setItem('token', token);
            });
        }
        catch(error){
        // data = null
            console.log(error);
        }    
        return data
}




onMounted(async() => {
    payPackage()

})


const handleSubmit = async (e) => {
    e.preventDefault();

    const { error } = await stripe.value.confirmPayment({
        elements: elements.value,
        redirect: "if_required"
    });

    if (error === undefined) {
        axios.post("PAYMENT_SUCCESS_API", {
            token: token.value,
        })
    } else {
        axios.post("PAYMENT_FAILURE_API", {
            token: token.value,
            code: error.code,
            description: error.message,
        })
    }
}
</script>