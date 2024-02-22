<h1>Cadastrar</h1>
<form action="/usuario/cadastro" method="post">
    @csrf
    <label for="nome">Nome</label>
    <input type="text" name="nome_usuario" id="nome_usuario">

    <label for="">Gênero</label>
    <select name="genero_usuario" id="genero_usuario">
        <option value="">Selecione...</option>
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
    </select>

    <label for="">Email</label>
    <input type="text" name="email_usuario" id="email_usuario">

    <label for="">Senha</label>
    <input type="password" name="senha_usuario" id="senha_usuario">

    <button type="submit">
        Cadastrar
    </button>
</form>