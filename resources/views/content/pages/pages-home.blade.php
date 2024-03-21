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
        <h5 class="pb-1 mb-4">Draggable Cards</h5>
        <div class="row" id="sortable-4">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-header cursor-move">Drag me!</div>
                    <div class="card-body">
                        <h4 class="card-title text-white">Primary card title</h4>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-secondary text-white mb-3">
                    <div class="card-header cursor-move">Drag me!</div>
                    <div class="card-body">
                        <h4 class="card-title text-white">Secondary card title</h4>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-success text-white mb-3">
                    <div class="card-header cursor-move">Drag me!</div>
                    <div class="card-body">
                        <h4 class="card-title text-white">Success card title</h4>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-header cursor-move">Drag me!</div>
                    <div class="card-body">
                        <h4 class="card-title text-white">Danger card title</h4>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up.
                        </p>
                    </div>
                </div>
            </div>
    </body>
    </html>
    @endsection
