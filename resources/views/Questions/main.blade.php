@extends('layout')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="row">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">type</th>
                    <th scope="col">required</th>
                    <th scope="col">options</th>
                    <th scope="col">Control</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <th scope="row">{{$question->id}}</th>
                        <td>{{$question->name}}</td>
                        <td>{{$question->type}}</td>
                        <td>{{$question->required}}</td>
                        <td>{{$question->data}}</td>
                        <td>Delete</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <form method="post" action="" class="m-3 col-12 col-md-6 my-5 shadow p-3 rounded-1 text-dark mx-auto d-flex flex-column">
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

                <div class="row mb-3">
                    <label for="required" class="col-sm-2 col-form-label" >Required</label>
                    <div class="col-sm-10">
                        <input type="checkbox"  name="required" value="true"  id="required">
                    </div>
                    @error('required')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="question-type row mb-3">
                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                    <div class=" col-sm-10">
                        <select class="form-select" name="type" value="{{old('info')}}" id="type">
                            <option value="text" selected>Text</option>
                            <option value="data">Data</option>
                            <option value="select">Select</option>
                        </select>
                    </div>
                    @error('type')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                    @enderror
                </div>



                <button type="submit" class="btn btn-dark">Add Question</button>
            </form>
        </div>
    </div>

    <script>

        let questionType = document.querySelector('.question-type');
        questionType.addEventListener('change', (e) => {
            if(e.target.selectedIndex == 2){
                let div = document.createElement('div');
                div.innerHTML = `
                    <div class=" question-select row mb-3">
                        <label for="data" class="col-sm-2 col-form-label" >Items</label>
                        <p class="fs-6 text-danger">Please separate the answers with comma</p>

                        <div class="col-sm-10 ">
                            <input type="text" value="{{old('data')}}" name="data" class="form-control" id="data" required>
                        </div>
                        @error('data')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                `
                questionType.insertAdjacentElement('afterend', div);
            }else{
                let div = document.querySelector('.question-select');
                if (div) div.remove();
            }
        })

    </script>
@endsection
