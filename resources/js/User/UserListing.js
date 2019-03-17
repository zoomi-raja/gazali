import React from "react";
class UserListing extends React.Component{
    render() {
        return (
            <div className="row">
                <div className="col-md-12">
                    <div className="bgc-white bd bdrs-3 p-20 mB-20">
                        <h4 className="c-grey-900 mB-20">Bootstrap Data Table</h4>
                        { this.props.users.length > 0 && (
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
                                { this.props.users.map((item,index) => {
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
                    </div>
                </div>
            </div>
        );
    }
}
export default UserListing