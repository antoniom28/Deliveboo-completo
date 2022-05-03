
@extends('layouts.navbar_admin')

@section('content')
<div class="d-flex flex-row flex-wrap justify-content-around w-100">
    @if ($orders && count($orders) > 0)
    @foreach ($orders as $order)
        <div class="col-md-12 justify-content-center d-flex">   
                <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <div class="row">
                        <div class="receipt-header receipt-header-mid">
                                <div class="receipt-right">
                                    <span class="date-order">Ordinato il: <br> <h4>{{$order['created_at']}}</h4></span>
                                    <span class="order-from">Prenotazione da: <br> <h4>{{$order['name']}} {{$order['surname']}}</h4></span>
                                    <span class="order-address">All'indirizzo: <br>  <h4>{{$order['address']}}</h4></span>
                                        <span class="phone">Numero di telefono: <br> <h4>{{$order['phone']}}</h4></span>
                                </div>
                        </div>
                    </div>
                    
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Descrizione</th>
                                    <th>Quantità</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-9">
                                        <div class="order-plate">
                                                @foreach ($order['plates'] as $plate)
                                                    <span class="plate"><h4> - {{$plate['name']}}</h4></span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="col-md-9">
                                            <div class="order-plate">
                                                @foreach ($order['plates'] as $plate)
                                                    <span class="plate"><h4> {{$plate['pivot']['quantity']}}x</h4></span>
                                                @endforeach
                                            </div>
                                        </td>
                                </tr>
                                <tr>
                                    
                                    <td class="text-right"><h2><strong>Totale: </strong></h2></td>
                                    <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i>{{$order['total']}} €</strong></h2></td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                </div> 
                </div>    
        </div>
        @endforeach
    
    @else 
        <div class="main-container">
            <div class="not-found">
            <div class="image-error"></div>
            </div>
            <div class="text">
                <h1>Non ci sono ordini in arrivo per il momento!</h1>
            </div>
        </div>
    @endif
</div>

@endsection