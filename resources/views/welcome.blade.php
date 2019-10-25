<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BetaRides API</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
         <!-- Fonts -->
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            body {
                background: dodgerblue;
                color: white;
                padding:0;
                margin:0;
            }
            .header {
                margin: 20px;
                font-weight: bold;
                background: #e6e6e6;
                padding: 10px;
                color:dodgerblue;
            }
            a {
                color:dodgerblue !important;
                font-weight:bold;
                padding:8px;
            }
            a:hover {
                border: 1px solid dodgerblue;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row header">
                <div class="col-8">Welcome To BetaRides Api </div>
                <div class="col-4">
                <a href="">Api Doc</a> 
                <a href="">Website</a> 
                </div>
            </div>
        </div>
    </body>
</html>
