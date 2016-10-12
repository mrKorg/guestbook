<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/bower_components/tether/dist/css/tether.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/bower_components/bootstrap-table/dist/bootstrap-table.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/signin.css') }}" rel="stylesheet">
    <style type="text/css">:root #content > #right > .dose > .dosesingle,
        :root #content > #center > .dose > .dosesingle
        {display:none !important;}</style>
</head>

<body>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="form-signin-heading">Welcome to GuestBook</h2>
                    <br>
                    <ul class="nav nav-tabs">
                        <li
                            @if($tab == 1)
                            class="active"
                            @endif
                            ><a href="#panel1">Messages</a></li>
                        <li
                            @if($tab == 2)
                            class="active"
                            @endif
                            ><a href="#panel2">Form</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="panel1" class="tab-pane fade
                            @if($tab == 1)
                            in active
                            @endif
                            ">
                            @yield("messages")
                        </div>
                        <div id="panel2" class="tab-pane fade
                            @if($tab == 2)
                            in active
                            @endif
                            ">
                            @yield("form")
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="{{ asset('/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/bower_components/tether/dist/js/tether.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/bower_components/bootstrap-table/dist/bootstrap-table.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/scripts.js') }}"></script>
</body>
</html>