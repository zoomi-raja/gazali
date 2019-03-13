'use strict';
import api_url from '../utilities/apiurl';
import headers from '../utilities/headers';
import {getItem,setItem,removeItem} from '../utilities/localState'
import API from "../utilities/api";
export function checkAuth(){
    return getItem('auth_token')?true:false;
}

export function setToken(token){
    setItem('auth_token',token);
    guestAllowed();
}

export function guestAllowed() {
    if(checkAuth()){
        console.log(api_url('dash_pg').url);
        window.location.href = api_url('dash_pg').url;
    }
}

export function guestNotAllowed() {
    if(!checkAuth()){
        window.location.href = api_url('login_pg').url;
        console.log(api_url('login_pg'));
    }else{
        let apiToken = new API(api_url('validate'));
        apiToken.endpoints.get({headers:headers})
            .then((response) => {
                if(response.data.STATUS.CODE == 403 ){
                    removeItem('auth_token');
                    window.location.href = api_url('login_pg').url;
                }else{
                    return true;
                }
            })
            .catch((reason) => {
                console.log(reason);
            });
    }
    return true;
}