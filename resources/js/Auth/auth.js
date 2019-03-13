import React from 'react';
import ReactDOM from 'react-dom';
import API from '../utilities/api';
import api_url from '../utilities/apiurl';
import {guestAllowed,setToken} from './authfunction'

export default class Auth extends React.Component{
    constructor(){
        super();
        this.state = {
            loading: false,
            email: '',
            password:'',
            formErrors: {
                email: '',
                password: ''
            }};
        this.handleSubmit   = this.handleSubmit.bind(this);
        this.handleChange   = this.handleChange.bind(this);
        this.fromValid      = this.fromValid.bind(this);
        this.handleClick    = this.handleClick.bind(this);
    }
    componentDidMount() {
        guestAllowed();
    }
    fromValid ({formErrors, ...rest}) {
        let valid = true;

        Object.keys(rest).forEach((field) => {
            if(rest[field].length <= 0){
                valid = false;
                let event = {target:{ name:field , value : '' }};
                this.handleChange(event);
            }
        });
        Object.values(formErrors).forEach( val => val.length > 0 && (valid = false) )
        return valid;
    }

    handleSubmit( event ){
        event.preventDefault();
        const userCredentials = {
            email : this.state.email,
            password:this.state.password
        }
        if(this.fromValid(this.state)) {
            let apiToken = new API(api_url('login'));
            apiToken.endpoints.create(userCredentials)
                .then((response) => {
                    if(response.data.STATUS.CODE != 200 ){
                        let errors      = response.data.OUTPUT.DATA.errors;
                        let formErrors  = this.state.formErrors;
                        for (let property in errors) {
                            formErrors[property] = errors[property][0];
                        }
                        this.setState({formErrors,loading:false});
                    }else{
                        setToken(response.data.OUTPUT.DATA.token);
                    }
                })
                .catch((reason) => {
                    this.setState({loading:false});
                    console.log(reason);
                });
        }
    }
    handleChange( event ){
        const { name, value} = event.target;
        let formErrors = this.state.formErrors;
        switch(name){
            case 'email':
                formErrors.email =
                    value.length < 3
                        ? "minimum 3 characters required"
                        :"";
                break;
            case 'password':
                formErrors.password =
                    value.length < 6
                        ? "minimum length should be 6"
                        : "";
                formErrors.email =
                    this.state.email.length > 3
                        ? ""
                        :formErrors.email;
                break;
        }
        this.setState({formErrors,[name]:value});
    }

    handleClick(){
        this.setState({
            loading: true
        })
    };

    render(){
        const { formErrors } = this.state;
        return (
            <form onSubmit={this.handleSubmit} method="post">
                <div className="form-group">
                    <label className="text-normal text-dark">Email</label>
                    <input type="email" name="email" className= {"form-control " + (formErrors.email.length ? 'is-invalid' : '')} placeholder="Registered Email" value={this.state.email} onChange={this.handleChange} />
                    {formErrors.email.length > 0 && (
                        <div className="invalid-feedback">
                            {formErrors.email}
                        </div>
                    )}
                </div>
                <div className="form-group">
                    <label className="text-normal text-dark">Password</label>
                    <input type="password"  name="password" className={"form-control " + (formErrors.password.length ? 'is-invalid' : '')} placeholder="Password" value={this.state.password} onChange={this.handleChange} />
                    {formErrors.password.length > 0 && (
                        <div className="invalid-feedback">
                            {formErrors.password}
                        </div>
                    )}
                </div>
                <div className="form-group">
                    <div className="peers ai-c jc-sb fxw-nw">
                        <div className="peer">
                            <div className="checkbox checkbox-circle checkbox-info peers ai-c">
                                <input type="checkbox" id="inputCall1" name="remember_token" className="peer" />
                                <label htmlFor="inputCall1" className="peers peer-greed js-sb ai-c">
                                    <span className="peer peer-greed">Remember Me</span>
                                </label>
                            </div>
                        </div>
                        <div className="peer">
                            <button onClick={this.handleClick} className="btn btn-primary" type="submit">
                                {
                                    this.state.loading &&
                                    <i className='fa fa-circle-o-notch fa-spin'></i>
                                }
                                &nbsp;Login
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        )
    }
}
if (document.getElementById('loginForm')) {
    ReactDOM.render(<Auth name="peep"/>, document.getElementById('loginForm'));
}