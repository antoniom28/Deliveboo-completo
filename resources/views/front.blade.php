<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{asset('css/front.css')}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/faviconV2.ico') }}">
    <title>DeliveBoo</title>
    <style>
        /* width */
        ::-webkit-scrollbar {
          width: 7px;
        }
        
        /* Track */
        ::-webkit-scrollbar-track {
          background: #f1f1f1; 
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: rgb(204, 204, 204); 
          border-radius: 10px;
        }
        
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          /*background: #555; */
        }
        </style>
</head>
<body id="remove-all-scroll">
    <div id="app"></div>
    <script src="https://js.braintreegateway.com/web/dropin/1.33.1/js/dropin.js"></script>
    <script src="https://kit.fontawesome.com/8f1b5398cd.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/front.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>