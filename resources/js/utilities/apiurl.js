const apiurl = (url, prefix = true) => {
    let urlArray = {
        login     : '/api/login',
        login_pg  : '/login',
        dash_pg   : '/dashboard',
        validate  : '/api/auth',
        user_listing : '/api/user',
        user_pg     : 'user'
    };
    if(typeof urlArray[url] !== 'undefined'){
        return { url : (prefix)?process.env.MIX_APP_URL +'/admin'+ urlArray[url]:'/admin'+ urlArray[url]};
    }else{
        console.log( url + 'path not found');
        return false
    }

}
export default apiurl