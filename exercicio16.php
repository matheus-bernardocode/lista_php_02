<?php

function contarMaiusculas($senha)
{
    $total = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_upper($senha[$i])) {
            $total++;
        }
    }

    return $total;
}

function contarMinusculas($senha)
{
    $total = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_lower($senha[$i])) {
            $total++;
        }
    }

    return $total;
}

function contarNumeros($senha)
{
    $total = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_digit($senha[$i])) {
            $total++;
        }
    }

    return $total;
}

function contarEspeciais($senha)
{
    $total = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (!ctype_alnum($senha[$i])) {
            $total++;
        }
    }

    return $total;
}

function definirNivel($senha)
{
    $tamanho = strlen($senha);
    $maiusculas = contarMaiusculas($senha);
    $minusculas = contarMinusculas($senha);
    $numeros = contarNumeros($senha);
    $especiais = contarEspeciais($senha);

    if (
        $tamanho >= 12 && $maiusculas > 0 && $minusculas > 0 &&
        $numeros > 0 && $especiais > 0
    ) {
        return "Muito Forte";
    }

    if (
        $tamanho >= 10 && $maiusculas > 0 && $minusculas > 0 &&
        $numeros > 0
    ) {
        return "Forte";
    }

    if (
        $tamanho >= 8 && $minusculas > 0 &&
        ($maiusculas > 0 || $numeros > 0 || $especiais > 0)
    ) {
        return "Média";
    }

    return "Fraca";
}

function analisarSenha($senha)
{
    $resultado = [];

    $resultado["maiusculas"] = contarMaiusculas($senha);
    $resultado["minusculas"] = contarMinusculas($senha);
    $resultado["numeros"] = contarNumeros($senha);
    $resultado["especiais"] = contarEspeciais($senha);
    $resultado["tamanho"] = strlen($senha);
    $resultado["nivel"] = definirNivel($senha);

    return $resultado;
}

$senha = "Matheus@2026";

$resultado = analisarSenha($senha);

echo "ANÁLISE DA SENHA<br><br>";

echo "Letras maiúsculas: " . $resultado["maiusculas"] . "<br>";
echo "Letras minúsculas: " . $resultado["minusculas"] . "<br>";
echo "Números: " . $resultado["numeros"] . "<br>";
echo "Caracteres especiais: " . $resultado["especiais"] . "<br>";
echo "Tamanho: " . $resultado["tamanho"] . "<br>";
echo "Nível de segurança: " . $resultado["nivel"];

?>