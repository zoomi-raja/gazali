import React from "react";
import LeftNaveBar from './Dashboard/LeftNaveBar';
import TopNavBar from './Dashboard/TopNavBar';
import Dashboard from './Dashboard/Dashboard';
import User from './User/User';
import {BrowserRouter as Router, Route } from "react-router-dom"
import ReactDOM from "react-dom";

export default class Index extends React.Component{
    render() {
        return (
            <div>
                <Router>
                    <div>
                        <LeftNaveBar />
                        <div className="page-container">
                            <TopNavBar />
                            <Route path="/gazali/admin" exact={true} component={Dashboard} />
                            <Route path="/gazali/admin/user" component={User} />
                            <footer className="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                            <span>Copyright © 2017 Designed by <a href="https://colorlib.com" target="_blank"
                                                                  title="Colorlib">Colorlib</a>. All rights reserved.</span>
                            </footer>
                        </div>
                        </div>
                </Router>
            </div>
        )
    }
}

if (document.getElementById('dashboard')) {
    ReactDOM.render(<Index />, document.getElementById('dashboard'));
}
