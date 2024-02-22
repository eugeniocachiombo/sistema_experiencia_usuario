@include('usuario.inclusao.cabecalho')

@if(session("notificacao"))
    {{ session("notificacao") }}
@endif

<main>
@include('usuario.formularios.from_cadastro')
</main>

@include('usuario.inclusao.rodape')