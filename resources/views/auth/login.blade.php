@extends('layouts.app')

@section('f_content')
    @include('partials.header')
    <div class="container-fluid pt-5 ">
        <div class="row px-xl-5">
            <div class="col-lg-12 d-flex justify-content-center">  
                <div class="card" style="width: 20rem;">
                    <div class="card-header">
                        <h4 class="text-center font-weight-semi-bold m-0">Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection