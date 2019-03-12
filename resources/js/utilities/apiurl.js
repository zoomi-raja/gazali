const apiurl = (url) => {
    let urlArray = {
        login     : '/api/login',
        login_pg  : '/login',
        dash_pg   : '/dashboard',
        validate  : '/api/auth',
    };
    if(typeof urlArray[url] !== 'undefined'){
        return { url : process.env.MIX_APP_URL +'/admin'+ urlArray[url]};
    }else{
        console.log( url + 'path not found');
        return false
    }

}
export default apiurl