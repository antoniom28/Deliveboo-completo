@extends('layouts.navbar_admin')

@section('content')
    <form class="form-edit-box" action="{{route("admin.plate.update" , $plate->id)}}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <h1>
        Stai modificando <strong>{{$plate->name}}</strong>
    </h1>
    
    <div class="main-box">
        <div class="main-form-box">
            <div class="form-group">
                <label for="name">Nome Piatto</label>
                <input value="{{old("name") ? old("name") : $plate->name}}" type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" placeholder="Nome">
            </div>
        
            <div class="form-group">
                <label for="ingredients">Ingredienti</label>
                <div class="form-floating">
                    <textarea class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients" placeholder="Aggiungi Ingredienti" style="height: 50px">{{old("ingredients") ? old("ingredients") : $plate->ingredients}}</textarea>
                </div>
            </div>
        
            <div class="mb-0 form-group">
                <label for="price">Prezzo</label>
                <input type="number" step="0.01" name="price" class="p-1 form-control @error('price') is-invalid @enderror  " 
                value="{{old("price") ? old("price") : $plate->price}}">
            </div>
        
            <div class="mt-4 mb-1 form-group">
                <u>Rendere visibile alla creazione ?</u>
                <br class="d-sm-none">
                <span class="ms_input_yes">
                    <input class="d-none" {{((old("visible") == null) ? ($plate->visible == 1) ? "checked" : "" : (old("visible") == "yes")) ? "checked" : ""}} value="yes" type="radio" name="visible" id="visible">
                    <label class="visible" for="visible">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4zM480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6V112.6zM288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112z"/></svg>
                    </label>
                </span>
                <span class="ms_input_no">
                    <input class="d-none" {{((old("visible") == null) ? ($plate->visible == 0) ? "checked" : "" : (old("visible") == "no")) ? "checked" : ""}} value="no" type="radio" name="visible" id="not-visible">
                    <label class="not-visible" for="not-visible">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M150.7 92.77C195 58.27 251.8 32 320 32C400.8 32 465.5 68.84 512.6 112.6C559.4 156 590.7 207.1 605.5 243.7C608.8 251.6 608.8 260.4 605.5 268.3C592.1 300.6 565.2 346.1 525.6 386.7L630.8 469.1C641.2 477.3 643.1 492.4 634.9 502.8C626.7 513.2 611.6 515.1 601.2 506.9L9.196 42.89C-1.236 34.71-3.065 19.63 5.112 9.196C13.29-1.236 28.37-3.065 38.81 5.112L150.7 92.77zM189.8 123.5L235.8 159.5C258.3 139.9 287.8 128 320 128C390.7 128 448 185.3 448 256C448 277.2 442.9 297.1 433.8 314.7L487.6 356.9C521.1 322.8 545.9 283.1 558.6 256C544.1 225.1 518.4 183.5 479.9 147.7C438.8 109.6 385.2 79.1 320 79.1C269.5 79.1 225.1 97.73 189.8 123.5L189.8 123.5zM394.9 284.2C398.2 275.4 400 265.9 400 255.1C400 211.8 364.2 175.1 320 175.1C319.3 175.1 318.7 176 317.1 176C319.3 181.1 320 186.5 320 191.1C320 202.2 317.6 211.8 313.4 220.3L394.9 284.2zM404.3 414.5L446.2 447.5C409.9 467.1 367.8 480 320 480C239.2 480 174.5 443.2 127.4 399.4C80.62 355.1 49.34 304 34.46 268.3C31.18 260.4 31.18 251.6 34.46 243.7C44 220.8 60.29 191.2 83.09 161.5L120.8 191.2C102.1 214.5 89.76 237.6 81.45 255.1C95.02 286 121.6 328.5 160.1 364.3C201.2 402.4 254.8 432 320 432C350.7 432 378.8 425.4 404.3 414.5H404.3zM192 255.1C192 253.1 192.1 250.3 192.3 247.5L248.4 291.7C258.9 312.8 278.5 328.6 302 333.1L358.2 378.2C346.1 381.1 333.3 384 319.1 384C249.3 384 191.1 326.7 191.1 255.1H192z"/></svg>
                    </label>
                </span>
            </div>
        
            <button type="submit" class="btn standard-button">Modifica!</button>
            
        </div>

        <div class="form-image-box mb-0">
            <div class="image-preview">
                @if(isset($plate->img))
                <img src="{{asset('storage/'.$plate->img) }}" class="" alt="{{$plate->name}}">
                <h2>Modifica Immagine</h2>
                @else
                <div class="img_404"></div>
                <h2>Aggiungi Immagine</h2>
                @endif
                <input type="file" name="img" class="p-1 form-control @error('img') is-invalid @enderror ">
            </div>
        </div>
        @error('img')
        <div class="mt-0 alert alert-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection