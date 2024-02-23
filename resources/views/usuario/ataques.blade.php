<title>Total de ataques</title>
@include('usuario.inclusao.cabecalho')
@include('usuario.inclusao.navbar_usuario_logado')

<main>
    <div class="container " style="min-height: inherit; max-height: 80vh; overflow: auto;">
        <div class="p-5">
            <h4><b>Total de ataques: </b> <span style="color: red">{{ session('total_ataques') }}</span></h4> <br>
            @foreach ($ataques as $item)
                <b>Dispositivo: </b> <span style="color: green">{{ $item->nome_dispositivo }}</span> <br>
                <b>Navegador: </b> <span style="color: dodgerblue">{{ $item->navegador }}</span> <br>
                <b>Plataforma: </b> <span style="color: redodgerblued">{{ $item->plataforma }}</span> <br>
                <b>Data: </b> <span style="color: redodgerblued">{{ $item->created_at }}</span> <br>
                <hr>
            @endforeach
        </div>
    </div>
</main>

@include('usuario.inclusao.rodape')
