import React from 'react';
import ReactDOM from 'react-dom';

export default class Auth extends React.Component{
    constructor(){
        super();
    }
    render(){
        return (
            <form action="{{action('Auth\Controllers\LoginController@login')}}" method="post">
                <div className="form-group">
                    <label className="text-normal text-dark">Username</label>
                    <input type="email" name="email" className="form-control" placeholder="John Doe" />
                </div>
                <div className="form-group">
                    <label className="text-normal text-dark">Password</label>
                    <input type="password"  name="password" className="form-control" placeholder="Password" />
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