<!DOCTYPE html>
<html ng-app="app"> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <title>Laravel</title>

        @if( Config::get('app.debug') )
          <link rel="stylesheet" href="{{ asset('build/css/vendor/bootstrap.min.css')}}" media="screen" title="no title" charset="utf-8">
          <link rel="stylesheet" href="{{ asset('build/css/vendor/bootstrap-theme.min.css')}}" media="screen" title="no title" charset="utf-8">
        @else
            <link rel="stylesheet" href="{{ elixir('css/all.css') }}" media="screen" title="no title" charset="utf-8">
        @endif

        </style>
    </head>
    <body>
        
        <div ng-view></div>


        @if(Config::get('app.debug'))
          <script src="{{ asset('build/js/vendor/jquery.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/angular.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/angular-route.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/angular-resource.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/angular-animate.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/angular-messages.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/ui-bootstrap.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/navbar.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/angular-cookies.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/query-string.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/angular-oauth2.min.js') }}" charset="utf-8"></script>


          <script src="{{ asset('build/js/app.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/LoginController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/HomeController.js') }}" charset="utf-8"></script>

      @else
           <script src="{{ elixir('js/all.js') }}" charset="utf-8"></script>
        @endif
    </body>
</html>
