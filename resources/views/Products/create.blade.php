@extends('layout')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="row">
            <form method="post" action="/products" class="m-3 col-12 col-md-6 my-5 shadow p-3 rounded-1 text-dark mx-auto d-flex flex-column">
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
                    <label for="price" class="col-sm-2 col-form-label" >Price</label>
                    <div class="col-sm-10 ">
                        <input type="text" value="{{old('price')}}" name="price" class="form-control" id="price" required>
                    </div>
                    @error('price')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row mb-3">
                    <label for="type" class="col-sm-2 col-form-label">Category</label>
                    <div class=" col-sm-10">
                        <select class="form-select category-type" name="category_id" value="{{old('info')}}" id="type">
                        @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('type')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="questions">

                </div>
                <button type="submit" class=" my-2 btn btn-dark">Create A product</button>

            </form>
        </div>
    </div>

    <script>
        let category_type = document.querySelector('.category-type');
        category_type.options[0].selected = 'selected';
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://127.0.0.1:8000/questions/'+category_type.options[0].value, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                makeQuestions(JSON.parse(xhr.responseText));
            }
        };
        category_type.addEventListener('change', (e) => {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://127.0.0.1:8000/questions/'+e.target.options[e.target.selectedIndex].value, true);
            xhr.send();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    makeQuestions(JSON.parse(xhr.responseText));
                }
            };
        })

        function makeQuestions(questions){
            let element;
            let p;
            let questions_ = document.querySelector('.questions');
            questions_.innerHTML = '';
            for(let ques of questions){
                console.log(ques.type);
                p = document.createElement('p');
                p.innerHTML = ques.name;
                if (ques.type === 'text'){
                    element = document.createElement('input');
                    element.classList.add('form-control');

                }else if (ques.type === 'data'){
                    element = document.createElement('textarea');
                    element.classList.add('form-control');

                }else{
                    let options = ques.data.split(',');
                    element = document.createElement('select');
                    element.classList.add('form-select');
                    for (let option of options){
                        option_ = document.createElement('option');
                        option_.setAttribute('value', option);
                        option_.selected = 'selected';
                        option_.innerHTML = option;
                        element.appendChild(option_);
                    }
                }
                if (ques.required === 1){
                    element.setAttribute('required','true');
                }
                element.setAttribute("name", "question_"+ques.id);
                questions_.appendChild(p);
                questions_.appendChild(element);
            }

        }

    </script>
@endsection
