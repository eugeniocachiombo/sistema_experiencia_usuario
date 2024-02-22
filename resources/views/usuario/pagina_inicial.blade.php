<title>Página Inicial</title>
@include('usuario.inclusao.cabecalho')
@include('usuario.inclusao.navbar_usuario_logado')

<main>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: inherit">
        <div class="">
            <div class="col d-flex justify-content-center">
                <i class="fas fa-shield-alt" style="font-size: 200px; color: green"></i>
            </div>
            <div class="col d-flex justify-content-center">
                <p><b>Sessão inciada</b></p>
            </div>
            <div class="col">
                <b>Usuario:</b> {{ session("nome_usuario") }}  <br>
                <b>Gênero:</b> @if (session("genero_usuario") == "M")
                    Masculino
                @else
                    Femenino
                @endif <br>
                <b>Email:</b> {{ session("email_usuario") }} <br>
            </div>
        </div>
    </div>
</main>

@include('usuario.inclusao.rodape')


<h1></h1>