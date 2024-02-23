<title>Página Inicial</title>
@include('usuario.inclusao.cabecalho')
@include('usuario.inclusao.navbar_usuario_logado')

<main>
    <div class="container p-5 d-flex justify-content-center align-items-center" style="min-height: inherit">
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
                <b>Total de ataques: </b> <span style="color: red">{{ session("total_ataques") }}</span> <br>
                <b>Dispositivo: </b>  <span style="color: green">{{session("dispositivo_query")}}</span> <br>
                <b>Navegador: </b> <span style="color: dodgerblue">{{session("navegador_query")}}</span> <br>
                <b>Plataforma: </b> <span style="color: redodgerblued">{{session("plataforma_query")}}</span> <br>
            </div>
            <div class="col">
                <form action="/usuario/terminar_sessao" method="get">
                    <button class="form-control bg-danger text-white" type="submit">
                        Terminar Sessão
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

@include('usuario.inclusao.rodape')