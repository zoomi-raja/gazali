import React from 'react';
import API from "../utilities/api";
import api_url from "../utilities/apiurl";
import headers from "../utilities/headers";
import {removeItem} from "../utilities/localState";
class User extends React.Component{
    constructor(){
        super()
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
                console.log(response);
            })
            .catch((reason) => {
                console.log(reason);
            });
    }

    render(){
        return (
            <div className="container-fluid">
                <h4 className="c-grey-900 mT-10 mB-30">Data Tables</h4>
                <div className="row">
                    <div className="col-md-12">
                        <div className="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 className="c-grey-900 mB-20">Bootstrap Data Table</h4>
                            { this.state.users.length > 0 && (
                                <table id="dataTable" className="table table-striped table-bordered" cellSpacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>DOB</th>
                                        <th>school</th>
                                        <th>class</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>DOB</th>
                                        <th>school</th>
                                        <th>class</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    { this.state.users.map((item,index) => {
                                        return (<tr  key={index}>
                                            <td><a href={item.id}>{item.name}</a></td>
                                            <td>{item.gender}</td>
                                            <td>{item.email}</td>
                                            <td>{item.dob}</td>
                                            <td>{item.schools.name}</td>
                                            <td>{item.schools.classes.map(function ($item) {
                                                return $item.name;
                                            }).join(',')}</td>
                                        </tr>)
                                    })
                                    }
                                    </tbody>
                                </table>
                            )}
                            {/*@else*/}
                            {/*<div className="alert alert-dark" role="alert">*/}
                                {/*No users Exists in system*/}
                            {/*</div>*/}
                            {/*@endif*/}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
export default User