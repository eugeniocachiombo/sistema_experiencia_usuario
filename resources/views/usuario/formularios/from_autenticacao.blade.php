<h1>Autenticar</h1>
<form action="/usuario/autenticacao" method="post">
    @csrf
    <label for="">Email</label>
    <input type="text" name="email_usuario" id="email_usuario">

    <label for="">Senha</label>
    <input type="password" name="senha_usuario" id="senha_usuario">

    <button type="submit">
        Autenticar
    </button>
</form>