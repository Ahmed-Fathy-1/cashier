import api from '..';

const fetchPageData = async (path)=>{
    let data = null;
    let token = '64|0r9sd8IwXwPMZCYOX19rYzOxj6m6pw9e3VPwKKF36d1d6387';
    
    if (localStorage.getItem('token') && localStorage.getItem('token') !== 'undifined') {
        token = localStorage.getItem('token');
    }

    try{
       await api.get(`${path}`, {
            headers:{
                'Authorization': `Bearer ${token}`
            }
        }).then((response) => {
            data = response.data.data;
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

export default fetchPageData;