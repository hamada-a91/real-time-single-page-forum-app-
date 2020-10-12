<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Single Page Forum</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDDluSApZUNXd_vCofvKamBMdnfAIlw99k"></script>
    

</head>
<body>
    <div id="app">
        <v-app>
            <app-home></app-home> 
        </v-app>
    </div>

    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>