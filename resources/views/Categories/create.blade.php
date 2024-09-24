@extends('layout')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="row">
            <form method="post" action="/categories" class="m-3 col-12 col-md-6 my-5 shadow p-3 rounded-1 text-dark mx-auto d-flex flex-column">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label" >Name</label>
                    <div class="col-sm-10 ">
                        <input type="text" value="{{old('name')}}" name="name" class="form-control" id="name" required>
                    </div>
                    @error('name')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark">Create Category</button>
            </form>
        </div>
    </div>
@endsection
