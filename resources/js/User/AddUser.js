import React from "react";
import {Link } from "react-router-dom"
class AddUser extends React.Component{
    constructor(props){
        super(props);
    }
    render() {
        return (
            <div className="row">
                <div className="col-md-12">
                    <div className="bgc-white bd bdrs-3 p-20 mB-20">
                        <form className="form" id="registrationForm">
                            <div className="row">
                                <div className="col-md-3">
                                    <div className="text-center">
                                        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                                             className="avatar img-circle img-thumbnail" alt="avatar"/>
                                        <h6>Upload a different photo...</h6>
                                        <input type="file" className="text-center center-block file-upload"/>
                                    </div>
                                    <div className="form-group mt-4">
                                        <div className="col-xs-6">
                                            <div className="form-check">
                                                <label className="form-check-label"><h4>Active</h4></label>
                                                <input className="ml-3" type="checkbox" name="active" id="active"
                                                       value="1"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="col-xs-6">
                                            <label htmlFor="dob"><h4>Date Of Birth</h4></label>
                                            <input type="text" className="form-control" name="dob" value="" id="dob"
                                                   placeholder="DOB" title="enter Date of Birth."/>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-6">
                                    <hr/>
                                    <div className="form-group">
                                        <div className="col-xs-6">
                                            <label htmlFor="first_name"><h4>Name</h4></label>
                                            <input type="text" className="form-control" name="name" value=""
                                                   id="first_name" placeholder="first name"
                                                   title="enter your first name if any."/>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="col-xs-6">
                                            <label htmlFor="last_name"><h4>Father name</h4></label>
                                            <input type="text" className="form-control" name="father_name" value=""
                                                   id="last_name" placeholder="last name"
                                                   title="enter your last name if any."/>
                                        </div>
                                    </div>

                                    <div className="form-group">

                                        <div className="col-xs-6">
                                            <label htmlFor="phone"><h4>Phone</h4></label>
                                            <input type="text" className="form-control" name="phone" value="" id="phone"
                                                   placeholder="enter phone" title="enter your phone number if any."/>
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <div className="col-xs-6">
                                            <label htmlFor="email"><h4>Email</h4></label>
                                            <input type="email" className="form-control" name="email" value=""
                                                   id="email" placeholder="enter email" title="enter email."/>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="col-xs-6">
                                            <label htmlFor="address"><h4>Address</h4></label>
                                            <input type="text" className="form-control" id="address" name="address"
                                                   value="" placeholder="somewhere" title="enter a address"/>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="col-xs-6">
                                            <label htmlFor="gender"><h4>Gender</h4></label>
                                            <div className="row row mx-4">
                                                <div className="form-check col-md-6">
                                                    <label className="form-check-label">
                                                        <input className="form-check-input" type="radio" name="gender"
                                                               id="gender" value="M" checked="checked"/>
                                                        Male
                                                    </label>
                                                </div>
                                                <div className="form-check col-md-6">
                                                    <label className="form-check-label">
                                                        <input className="form-check-input" type="radio" name="gender"
                                                               id="gender" value="F"/>
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                                <div className="col-md-3">
                                    <hr/>
                                    <div className="form-group">
                                        <div className="col-xs-6">
                                            <label htmlFor="fees"><h4>fees</h4></label>
                                            <input type="text" className="form-control" name="fees" value="" id="fees"
                                                   placeholder="Fees" title="enter Amount."/>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="col-xs-6">
                                            <label htmlFor="school"><h4>School</h4></label>
                                            <select className="form-control form-control-sm" id="school" name="school">
                                                <option value="1">peep</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="col-xs-6">
                                            <label htmlFor="class"><h4>Classe</h4></label>
                                            <select className="form-control form-control-sm  " multiple
                                                    data-live-search="true" id="class" name="class">
                                                <option value="">default</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <div className="col-xs-6">
                                            <label htmlFor="class"><h4>Group</h4></label>
                                            <select className="form-control form-control-sm  disabled" multiple
                                                    data-live-search="true" id="class" name="group[]" multiple>
                                                <option value="">default</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-md-3"></div>
                                <div className="col-md-6">
                                    <div className="row">
                                        <div className="col-md-6">
                                            <div className="form-group">
                                                <button className="btn btn-lg btn-success" type="submit"><i
                                                    className="glyphicon glyphicon-ok-sign"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="form-group float-right">
                                                <Link to={'/gazali/admin/user'} className="btn btn-lg" type="reset">
                                                    <i className="glyphicon glyphicon-repeat"></i> Back
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}
export default AddUser