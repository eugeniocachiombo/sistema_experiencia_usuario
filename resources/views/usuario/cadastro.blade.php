@include('usuario.inclusao.cabecalho')

@if(session("notificacao"))
    <script>
        Swal.fire(
            'Sucesso!',
            'Cadastrado com sucesso!',
            'success'
        )
    </script>
@endif

<main>
@include('usuario.formularios.from_cadastro')
</main>

@include('usuario.inclusao.rodape')