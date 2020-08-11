<html>
    <head>
        <title>SISAR</title>
        <meta charset="UTF-8">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body { padding: 20px; }
            .navbar { margin-bottom: 30px; }
            .card{ margin: 20px; }
            .card-header { color: white; }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark d-flex justify-content-between">
            <a class="navbar-brand">
                @if($tag=="CURSO")
                    <img width="36px" height="36px" src="{{ asset('img/curso_ico.png') }}">
                @elseif($tag=="ALUNO")
                    <img width="36px" height="36px" src="{{ asset('img/aluno_ico.png') }}">
                @elseif($tag=="DISCIPLINA")
                    <img width="36px" height="36px" src="{{ asset('img/disciplina_ico.png') }}">
                @elseif($tag=="PROFESSOR")
                    <img width="36px" height="36px" src="{{ asset('img/professor_ico.png') }}">
                @elseif($tag=="HOME")
                    <img width="36px" height="36px" src="{{ asset('img/home_ico.svg') }}">
                @elseif($tag=="MATRICULA")
                    <img width="36px" height="36px" src="{{ asset('img/conceito_ico.png') }}">
                @elseif($tag=="NEGADO")
                    <img width="36px" height="36px" src="{{ asset('img/negado.png') }}">
                @endif
                
                <b>{{$titulo}}</b>
            </a>
            <a class="navbar-brand mx-auto">
                <b>SISAR - Sistema de Avaliação Remota</b>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item" >
                    <a class="nav-link" href="/">
                        <b>|Home|</b>
                    </a>
                </li>
            </ul>
        </nav>
        @yield('conteudo')
        <hr>
    </body>
    <footer>
        <b>&copy; 2020 - Gustavo Galdino de Camargo.</b>
    </footer>
    <script src="{{asset('js/app.js')}}" type='text/javascript'></script>
    @yield('script')

</html>