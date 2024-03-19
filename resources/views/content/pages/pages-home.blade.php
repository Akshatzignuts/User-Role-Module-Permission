    @php
    $configData = Helper::appClasses();
    @endphp
    @extends('layouts/layoutMaster')

    @section('title', 'Home')
    @section('content')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,900" rel="stylesheet">
    </head>
    <body>

        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-3 text-center">
                    <div class="card card-1 mb-4">
                        <i class="fas fa-cog fa-3x"></i>
                        <h3>Modules</h3>
                        <p>Active Modules</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="card card-2 mb-4">
                        <i class="fas fa-users fa-3x"></i>
                        <h3>Users</h3>
                        <p>Active users</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="card card-3 mb-4">
                        <i class="fas fa-lock fa-3x"></i>
                        <h3>Permissions</h3>
                        <p>Active permissions</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="card card-3 mb-4">
                        <i class="fas fa-crown fa-3x"></i>
                        <h3>Roles</h3>
                        <p>Active Roles</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    @endsection
    <style>
        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            text-align: center;
        }

        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        body {
            font-family: 'Nunito', sans-serif;

        }

        .card {
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
            transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
            padding: 14px 80px 18px 36px;
            cursor: pointer;

        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }

        .card h3 {
            font-weight: 600;
        }

        .card img {
            position: absolute;
            top: 20px;
            right: 15px;
            max-height: 120px;
        }

        .card-1 {
            background-image: url(https://ionicframework.com/img/getting-started/ionic-native-card.png);
            background-repeat: no-repeat;
            background-position: right;
            background-size: 80px;
        }

        .card-2 {
            background-image: url(https://ionicframework.com/img/getting-started/components-card.png);
            background-repeat: no-repeat;
            background-position: right;
            background-size: 80px;
        }

        .card-3 {
            background-image: url(https://ionicframework.com/img/getting-started/theming-card.png);
            background-repeat: no-repeat;
            background-position: right;
            background-size: 80px;
        }

        @media(max-width: 990px) {
            .card {
                margin: 20px;
            }
        }

    </style>
