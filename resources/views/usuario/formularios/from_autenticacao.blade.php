<div class="container " style="min-height: inherit; ">
    <form class=" d-flex justify-content-center align-items-center" style="min-height: inherit;" action="/usuario/autenticacao" method="post">
        @csrf
        <div class="col-6 ">
            <h1>Autenticação</h1> <hr>
                <div class="col mt-2">
                    <label for="" style="color: dodgerblue"><b>Email:</b></label>
                    <input class="form-control" type="text" name="email_usuario" id="email_usuario">
                </div>
        
                <div class="col mt-2">
                    <label for="" style="color: dodgerblue"><b>Senha:</b></label>
                    <input class="form-control" type="password" name="senha_usuario" id="senha_usuario">
                </div>
        
                <div class="col mt-4">
                    <button class="form-control button" type="submit">
                        <b>Autenticar</b>
                    </button>
                </div>
        </div>
    </form>
</div>
