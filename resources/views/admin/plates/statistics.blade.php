@extends('layouts.navbar_admin')

@section('content')
<div class="container statistics-container">
  <div class="row row-cols-1">
    <div class="col statistics">
      <h2 class="">I piatti preferiti dei tuoi clienti</h2>
      <canvas id="myChart"></canvas>
    </div> 
    
    <div class="mt-4 col statistics">
      <h2 class="">Ordini ricevuti in questo mese</h2>
      <canvas id="orderChart"></canvas>
    </div> 
    
    <div class="mt-4 col statistics">
      <h2 class="">I tuoi guadagni nell'ultimo mese</h2>
      <canvas id="moneyChart"></canvas>
    </div> 
  </div>
</div>
@endsection

<style>
  .container{
    width: 100%
  }

  @media screen 
</style>
