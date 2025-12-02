<?php

function validarCPF($cpf) {
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    // Verifica se tem 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }
    
    return true;
}

function validarSenha($senha) {
    // Minúscula, maiúscula e caractere especial
    $hasLower = preg_match('/[a-z]/', $senha);
    $hasUpper = preg_match('/[A-Z]/', $senha);
    $hasSpecial = preg_match('/[^a-zA-Z0-9]/', $senha);
    $hasNumbers = preg_match_all('/[0-9]/', $senha) >= 3;
    
    
    if (!$hasLower || !$hasUpper || !$hasSpecial || !$hasNumbers) {
        return false;
    }
    
    return true;
}

function validarNome($nome) {
    $nome = trim($nome);
    return !empty($nome);
}

function validarAno($ano) {
    return is_numeric($ano) && $ano > 1800 && $ano <= date('Y');
}
