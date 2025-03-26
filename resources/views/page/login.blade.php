@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card" style="margin-top: 50px">
                <div class="card-body">
                    <form id="loginForm">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" class="form-control"  required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password"  placeholder="Password" class="form-control mb-3" required>
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
                    </form>

                    {{-- <button id="logoutButton">Logout</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
