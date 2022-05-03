<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Ciao,</h3>
    <p>Il tuo ordine è andato a buon fine e non può più essere modificato.</p>
    <div style="background-color: #EFEFEF; border-top: 2px solid black; line-height:0.7;" class="data-box w-100">
        <div style="padding: 15px;" class="data w-100 p-5">
            <div>
                <p>Creato il:</p>
                <p style="color:green;">{{$data1['created_at']}}</p>
            </div>
            <div class="order">
                <p class="mb-3">Ordine di:</p>
                <p>{{$data1['name']}} {{$data1['surname']}}</p>
                <p>{{$data1['address']}}</p>
                <p>{{$data1['phone']}}</p>
                <p class="mt-5">Totale ordine: EUR {{$data1['total']}}</p>
            </div>
        </div>
    </div>
    <h3 style="color:orange;">Riepilogo Ordine</h3>
    <div style="border-top: 1px solid grey; border-bottom: 1px solid grey;" class="main-container d-flex align-items-center flex-column">
        <div class="back text-center">
            <ul>
                @foreach ($data1['plates'] as $elem)
                <li>
                    {{$elem['name']}} {{$elem['pivot']['quantity']}}x 
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>

  <style>
      .order p:not(:first-child){
          font-weight: bold;
      }

      .order p:last-child{
          margin-top: 25px;
      }
  </style>