import React from "react";
import {Link } from "react-router-dom";
import * as $ from 'jquery';
class AddUser extends React.Component{
    constructor(props){
        super(props);
    }
    componentDidMount() {
        hookTabs();
    }

    render() {
        return (
            <div className="row">
                <div className="col-md-12">
                    <ul className="nav nav-tabs" id="myTab" role="tablist">
                        <li className="nav-item">
                            <a className="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">Home</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Profile</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                               aria-controls="contact" aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div className="tab-content" id="myTabContent">
                        <div className="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div className="col-md-12 px-0">
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
                                                            <input className="ml-3" type="checkbox" name="active" id="active" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="form-group">
                                                    <div className="col-xs-6">
                                                        <label htmlFor="dob"><h4>Date Of Birth</h4></label>
                                                        <input type="text" className="form-control" name="dob" id="dob"
                                                               placeholder="DOB" title="enter Date of Birth."/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="col-md-6">
                                                <hr/>
                                                <div className="form-group">
                                                    <div className="col-xs-6">
                                                        <label htmlFor="first_name"><h4>Name</h4></label>
                                                        <input type="text" className="form-control" name="name"
                                                               id="first_name" placeholder="first name"
                                                               title="enter your first name if any."/>
                                                    </div>
                                                </div>
                                                <div className="form-group">
                                                    <div className="col-xs-6">
                                                        <label htmlFor="last_name"><h4>Father name</h4></label>
                                                        <input type="text" className="form-control" name="father_name"
                                                               id="last_name" placeholder="last name"
                                                               title="enter your last name if any."/>
                                                    </div>
                                                </div>

                                                <div className="form-group">

                                                    <div className="col-xs-6">
                                                        <label htmlFor="phone"><h4>Phone</h4></label>
                                                        <input type="text" className="form-control" name="phone" id="phone"
                                                               placeholder="enter phone" title="enter your phone number if any."/>
                                                    </div>
                                                </div>

                                                <div className="form-group">
                                                    <div className="col-xs-6">
                                                        <label htmlFor="email"><h4>Email</h4></label>
                                                        <input type="email" className="form-control" name="email"
                                                               id="email" placeholder="enter email" title="enter email."/>
                                                    </div>
                                                </div>
                                                <div className="form-group">
                                                    <div className="col-xs-6">
                                                        <label htmlFor="address"><h4>Address</h4></label>
                                                        <input type="text" className="form-control" id="address" name="address"
                                                               placeholder="somewhere" title="enter a address"/>
                                                    </div>
                                                </div>
                                                <div className="form-group">
                                                    <div className="col-xs-6">
                                                        <label htmlFor="gender"><h4>Gender</h4></label>
                                                        <div className="row row mx-4">
                                                            <div className="form-check col-md-6">
                                                                <label className="form-check-label">
                                                                    <input className="form-check-input" type="radio" name="gender"
                                                                           id="gender" value="M"/>
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
                                                        <input type="text" className="form-control" name="fees" id="fees"
                                                               placeholder="Fees" title="enter Amount."/>
                                                    </div>
                                                </div>
                                                <div className="form-group">
                                                    <div className="col-xs-6">
                                                        <label htmlFor="school"><h4>School</h4></label>
                                                        <select className="form-control form-control-sm" id="school" name="school">
                                                            <option >peep</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div className="form-group">
                                                    <div className="col-xs-6">
                                                        <label htmlFor="class"><h4>Classe</h4></label>
                                                        <select className="form-control form-control-sm  " multiple
                                                                data-live-search="true" id="class" name="class">
                                                            <option>default</option>
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
                        <div className="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">second tab
                        </div>
                        <div className="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">third tab
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
const hookTabs = () => {
    $('#myTab a').on('click', function (e) {
        $("#myTab a").removeClass("active");
        $(this).addClass("active");
        $("#myTabContent div").removeClass("show active");
        $("#myTabContent div[aria-labelledby="+$(this).attr('id')+"]").addClass("show active")
        e.preventDefault()
    })
}
export default AddUser