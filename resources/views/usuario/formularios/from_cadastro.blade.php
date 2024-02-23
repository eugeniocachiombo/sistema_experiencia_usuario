<div class="container d-flex justify-content-center align-items-center" style=" ">
    <form class="needs-validation p-4" novalidate style="min-height: inherit;" action="/usuario/cadastro" method="post">
        @csrf
        <h1>Cadastrar</h1>
        <hr>
        <div class="row g-3 ">
            <div class="col-8 col-md-6">
                <label for="" style="color: dodgerblue"><b>Nome:</b></label>
                <input class="form-control" type="text" name="nome_usuario" id="nome_usuario" required="">
                <div class="invalid-feedback">
                    Campo obrigatório
                </div>
            </div>

            <div class="col-8 col-md-6">
                <label for="" style="color: dodgerblue"><b>Gênero</b></label>
                <select class="form-control select" name="genero_usuario" id="genero_usuario" required="">
                    <option value="">Selecione...</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                <div class="invalid-feedback">
                    Campo obrigatório
                </div>
            </div>

            <div class="col-8 col-md-6">
                <label for="" style="color: dodgerblue"><b>Email:</b></label>
                <input class="form-control" type="email" name="email_usuario" id="email_usuario" required>
                <div class="invalid-feedback">
                    Campo obrigatório
                </div>
            </div>

            <div class="col-8 col-md-6">
                <label for="" style="color: dodgerblue"><b>Senha:</b></label>
                <input class="form-control" type="password" name="senha_usuario" id="senha_usuario" required>
                <div class="invalid-feedback">
                    Campo obrigatório
                </div>
            </div>
        </div>

        <div class="col-4 mt-4  d-flex justify-content-center align-items-end">
            <button class="form-control button" type="submit">
                <b>Cadastrar</b>
            </button>
        </div>
    </form>
</div>

<script src="../assets/js/bootstrap_validacao.js"></script>
