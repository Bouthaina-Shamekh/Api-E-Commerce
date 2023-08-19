
import axios from 'axios';


axios.get('/get-formatted-amount')
    .then(response => {
        const formattedAmount = response.data.formattedAmount;
        document.getElementById('formatted-amount').innerText = formattedAmount;
    })
    .catch(error => {
        console.error(error);
    });
