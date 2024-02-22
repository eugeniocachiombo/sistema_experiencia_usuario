@include('usuario.inclusao.cabecalho')

@if(session("notificacao"))
    {{ session("notificacao") }} <br>
    Tentativas Restantes: {{ session("tentativa_login") }}
@endif

<main >
    @include('usuario.formularios.from_autenticacao')
</main>

@include('usuario.inclusao.rodape')