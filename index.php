<html>
    <head>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.forms['loginForm'];
            form.addEventListener('submit', function(e) {
                const cpf = form.cpf.value.trim();
                const senha = form.senha.value;

                // Validação do CPF: exatamente 11 dígitos numéricos
                if (!/^\d{11}$/.test(cpf)) {
                    alert('CPF deve conter exatamente 11 dígitos numéricos.');
                    e.preventDefault();
                    return;
                }

                // Validação da senha: minúscula, maiúscula e caractere especial
                const hasLower = /[a-z]/.test(senha);
                const hasUpper = /[A-Z]/.test(senha);
                const hasSpecial = /[^a-zA-Z0-9]/.test(senha);

                if (!hasLower || !hasUpper || !hasSpecial) {
                    alert('A senha deve conter pelo menos uma letra minúscula, uma maiúscula e um caractere especial.');
                    e.preventDefault();
                    return;
                }
            });
        });
        </script>
    </head>
    <body>
        <form name="loginForm" method="post" action="login.php">
            CPF:<input type="text" name="cpf" id="cpf"><br>
            SENHA:<input type="password" name="senha" id="senha"><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>