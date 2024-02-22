<title>Página de Erro</title>
@include('usuario.inclusao.cabecalho')

<main>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: inherit">
        <div class="">
            <div class="col d-flex justify-content-center">
                <i class="fas fa-shield-alt" style="font-size: 200px; color: green"></i>
            </div>
            <div class="col">
                <p>Já existe um usuário logado com estes dados no sistema</p>
            </div>
        </div>
    </div>
</main>

@include('usuario.inclusao.rodape')
