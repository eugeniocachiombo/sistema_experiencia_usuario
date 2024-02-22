
@if(session("notificacao"))
    {{ session("notificacao") }} <br>
    Tentativas: {{ session("tentativa_login") }}
@endif

@include('usuario.formularios.from_autenticacao')