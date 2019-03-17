import React from 'react';
import API from "../utilities/api";
import api_url from "../utilities/apiurl";
import headers from "../utilities/headers";
import {Link, Route } from "react-router-dom"
import UserListing from "./UserListing";
import AddUser from "./AddUser";
class User extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            users:[]
        };
    }
    componentDidMount() {
        let apiToken = new API(api_url('user_listing'));
        apiToken.endpoints.get({headers:headers})
            .then((response) => {
                if(response.data.STATUS.CODE == 200){
                    this.setState({users:response.data.OUTPUT.DATA})
                }
            })
            .catch((reason) => {
                console.log(reason);
            });
    }

    render(){
        const { location: { pathname }, match: {url} } = this.props;

        return (
            <div className="container-fluid">
                <div className="row mB-20" >
                    <div className="col-md-4">
                        <h4 className="c-grey-900">Data Tables</h4>
                    </div>
                    {
                        pathname.indexOf("user/add") < 0 &&

                        <div className="col-md-2 offset-md-6">
                            <Link className="btn btn-primary" to={`${url}/add`}>
                                Add new User
                            </Link>
                        </div>
                    }
                </div>
                <Route path={`${this.props.match.url}/add`} component={AddUser}/>
                <Route path={this.props.match.path} exact={true} render = {(routeProps) => (
                    <UserListing {...routeProps} users={this.state.users}/>
                )}/>
            </div>
        );
    }
}
export default User