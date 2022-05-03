
@extends('layouts.navbar_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categorie') }}</div>
                <div class="card-body types-box">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($typeChoice) > 0)
                    <ul class="your-types">
                        <div>
                            Le tue categorie:
                        </div>
                        @foreach ($typeChoice as $type)
                        <li class="align-items-center">
                            <div class="d-flex justify-content-around align-items-center">
                                <span>{{$type['name']}}</span>
                                <form action="{{route("admin.delete_type", ['id' => $type['id'] , 'where' => "types"])}}" method="POST" onsubmit="return confirm('Eliminare la categoria {{$type->name}}?')">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn text-white g-0 p-0 m-0 ml-2 delete">
                                        <svg class="delete-x-button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                    
                    <form method="GET" class="form_box" action="{{route('admin.types')}}">
                        @csrf
                    <h3>Aggiungi categoria ristorante: solo 4</h3>
                        <div class="checkbox_list d-flex flex-wrap justify-content-start p-2">
                        @foreach ($types as $index => $type)
                            <div class="my-2 ms-1 input-type-box"> 
                                <div class="">
                                    <input onclick="countType({{count($typeChoice)}} , this)" type="checkbox" class="test type-button-all d-none btn-check" name="check[]" value="{{$type->id}}" id="{{$type->name}}">
                                    <label class="p-2 test" for="{{$type->name}}">{{$type->name}}</label>
                                </div>
                            </div> 
                        @endforeach
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" onsubmit="aggiungiCategoria()" class="btn btn-primary standard-button">
                                    {{ __('Conferma') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


