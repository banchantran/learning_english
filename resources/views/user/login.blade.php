@extends('layout.login')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 offset-4">
                <form class="form-login">
                    <h1 class="title mb-20 text-center">Login form</h1>

                    <div class="form-group">
                        <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group mt-3">
                        <input type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-red w-100 mt-4">Login</button>
                    </div>
                    <div class="text-center f14 mt-3">
                        Not a member? <a href="#" class="text-success">Signup now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
