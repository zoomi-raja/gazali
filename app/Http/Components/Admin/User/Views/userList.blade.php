@extends('..\..\..\..\..\layouts.admin')
@section('title', 'Users')
@section('content')
    <div class="container-fluid">
        <h4 class="c-grey-900 mT-10 mB-30">Data Tables</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Bootstrap Data Table</h4>
                    @if(sizeof($users) > 1)
                        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Group</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Group</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><a href="{{URL('user').'/'.$user->id}}">{{$user->name}}</a></td>
                                    <td>{{$user->groups->implode('name',',')}}</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>$320,800</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-dark" role="alert">
                            No users Exists in system
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection