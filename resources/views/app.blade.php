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
          <script src="{{ asset('build/js/vendor/ui-bootstrap-tpls.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/navbar.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/angular-cookies.min.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/query-string.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/vendor/angular-oauth2.min.js') }}" charset="utf-8"></script>


          <script src="{{ asset('build/js/app.js') }}" charset="utf-8"></script>

          <script src="{{ asset('build/js/controllers/LoginController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/HomeController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/client/ClientListController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/client/ClientNewController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/client/ClientEditController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/client/ClientRemoveController.js') }}" charset="utf-8"></script>

          <script src="{{ asset('build/js/controllers/notes/NotesListController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/notes/NotesListOneController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/notes/NotesNewController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/notes/NotesEditController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/notes/NotesRemoveController.js') }}" charset="utf-8"></script>

          <script src="{{ asset('build/js/controllers/projects/ProjectListController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/projects/ProjectListOneController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/projects/ProjectNewController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/projects/ProjectEditController.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/controllers/projects/ProjectRemoveController.js') }}" charset="utf-8"></script>
          <!-- Servies -->
          <script src="{{ asset('build/js/services/Client.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/services/User.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/services/Notes.js') }}" charset="utf-8"></script>
          <script src="{{ asset('build/js/services/Project.js') }}" charset="utf-8"></script>
          <!-- Filters -->

          <script src="{{ asset('build/js/filters/date-br.js') }}" charset="utf-8"></script>

        @else
           <script src="{{ elixir('js/all.js') }}" charset="utf-8"></script>
        @endif
    </body>
</html>
