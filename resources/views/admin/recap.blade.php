
@extends('layouts.navbar_admin')

@section('content')
<div class="container recap-container">
    <div class="row justify-content-center p-1">
        <div class="col-12 col-sm 12 col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('I TUOI DATI') }}</div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <ul>
                            @if(isset($LoggedUser->img))
                                <img src="{{ asset("storage/".$LoggedUser->img) }}" class="img_profile">
                            @else
                                <img class="img_profile" src="{{asset("img/$LoggedUser->id.jpg")}}">
                               
                            @endif
                            <li>
                                nome: {{$LoggedUser->name}}
                            </li>

                            <li>
                                email: {{$LoggedUser->email}}
                            </li>

                            <li>
                                nome attività : {{$LoggedUser->activity}}
                            </li>
                            <li>
                                p. iva: {{$LoggedUser->p_iva}}
                            </li>
                            <li>
                                indirizzo: {{$LoggedUser->address}}
                            </li>
                            <h3 class="mt-3 text-center">
                                LE TUE CATEGORIE
                            </h3>
                            @if(count($LoggedUser->types) > 0)
                                <div class="d-flex flex-wrap">
                                    @foreach ($LoggedUser->types as $type)
                                    <li class="d-flex align-items-center">
                                        {{$type['name']}}
                                        <form action="{{route("admin.delete_type",['id' => $type['id'] , 'where' => "recap"])}}" method="POST" onsubmit="return confirm('Eliminare la categoria {{$type->name}}?')">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn text-white g-0 p-0 m-0 ml-2 delete">
                                                <svg class="delete-x-button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                                            </button>
                                        </form>
                                    </li>
                                    
                                @endforeach  
                                </div>
                            @else
                            <h3>Attualmente il tuo ristorante non ha categorie !</h3>
                                <h4><a href="types">Aggiungine almeno una</a></h4>
                            @endif
    
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
