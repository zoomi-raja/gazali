import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';


function validate(email, password) {
    return {
        email: email.length === 0,
        password: password.length === 0
    };
}
export default class Auth extends React.Component{
    constructor(){
        super();
        this.state = {
            email: '',
            password:'',
            touched: {
                email: false,
                password: false
            }};
        this.handleSubmit   = this.handleSubmit.bind(this);
        this.handleChange   = this.handleChange.bind(this);
    }
    componentDidMount() {
    }

    handleSubmit( event ){
        event.preventDefault();
        if (!this.canBeSubmitted()) {
            return;
        }
        const userCredentials = {
            email : this.state.email,
            password:this.state.password
        }
        axios.post(process.env.MIX_APP_URL+'/api/login', userCredentials)
            .then((response) => {
                console.log(response.data);
            })
            .catch(( reason ) =>{
                console.log(response.data);
            });
    }
    canBeSubmitted() {
        const errors = validate(this.state.email, this.state.password);
        const isDisabled = Object.keys(errors).some(x => {errors[x];console.log(errors[x])});
        return !isDisabled;
    }
    handleChange( event ){
        this.setState({[event.target.name]:event.target.value});
    }
    render(){
        const errors = validate(this.state.email, this.state.password);

        const shouldMarkError = field => {
            const hasError = errors[field];
            const shouldShow = this.state.touched[field];

            return hasError ? shouldShow : false;
        };

        return (
            <form onSubmit={this.handleSubmit} method="post">
                <div className="form-group">
                    <label className="text-normal text-dark">Email</label>
                    <input type="email" name="email" className={shouldMarkError("email") ? "form-control is-invalid" : "form-control"} placeholder="Registered Email" value={this.state.email} onChange={this.handleChange} />
                </div>
                <div className="form-group">
                    <label className="text-normal text-dark">Password</label>
                    <input type="password"  name="password" className={shouldMarkError("password") ? "form-control is-invalid" : "form-control"} placeholder="Password" value={this.state.password} onChange={this.handleChange} />
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
                         <button className="btn btn-primary">Login</button>
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