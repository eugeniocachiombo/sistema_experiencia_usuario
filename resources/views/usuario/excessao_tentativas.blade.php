<title>Página de Erro</title>
@include('usuario.inclusao.cabecalho')

<main>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: inherit">
        <div class="">
            <div class="col d-flex justify-content-center">
                <i class="fas fa-exclamation-triangle" style="font-size: 300px; color: red"></i>
            </div>
            <div class="col">
                <p>Excedeu o número máximo de tentativas, não é permitido acessar o sistema mais de 2 vezes</p>
            </div>
        </div>
    </div>
</main>

@include('usuario.inclusao.rodape')

