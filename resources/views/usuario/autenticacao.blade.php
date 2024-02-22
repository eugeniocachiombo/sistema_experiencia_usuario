<title>Autenticação</title>
@include('usuario.inclusao.cabecalho')
@include('usuario.inclusao.navbar_inicio')

@if (session('notificacao'))
    <script>
            Swal.fire({
                icon: "error",
                title: "Erro!",
                text: "Usuario não encontrado",
                footer: '<a href="#">Verifique se os dados form introduzidos correctamente</a>'
            });
    </script>
    <p style="background: green; color: white; padding: 5px">Tentativas Restantes: {{ session('tentativa_login') }}</p>
@endif

<main>
    @include('usuario.formularios.from_autenticacao')
</main>

@include('usuario.inclusao.rodape')
