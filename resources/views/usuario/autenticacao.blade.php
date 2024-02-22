
@if(session("notificacao"))
    {{ session("notificacao") }} <br>
    Tentativas Restantes: {{ session("tentativa_login") }}
@endif

@include('usuario.formularios.from_autenticacao')