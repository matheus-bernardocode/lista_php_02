<?php

function separarPalavras($texto)
{
    $texto = trim($texto);
    $texto = preg_replace('/\s+/', ' ', $texto);

    return explode(" ", $texto);
}

function contarCaracteres($texto)
{
    return strlen($texto);
}

function contarPalavras($texto)
{
    $palavras = separarPalavras($texto);

    return count($palavras);
}

function contarFrases($texto)
{
    $frases = preg_split('/[.!?]+/', $texto);
    $total = 0;

    foreach ($frases as $frase) {
        if (trim($frase) != "") {
            $total++;
        }
    }

    return $total;
}

function maiorPalavra($palavras)
{
    $maior = "";

    foreach ($palavras as $palavra) {
        $palavra = preg_replace('/[.,!?;:]/', '', $palavra);

        if (strlen($palavra) > strlen($maior)) {
            $maior = $palavra;
        }
    }

    return $maior;
}

function menorPalavra($palavras)
{
    $menor = "";

    foreach ($palavras as $palavra) {
        $palavra = preg_replace('/[.,!?;:]/', '', $palavra);

        if ($palavra == "") {
            continue;
        }

        if ($menor == "" || strlen($palavra) < strlen($menor)) {
            $menor = $palavra;
        }
    }

    return $menor;
}

function palavrasRepetidas($palavras)
{
    $lista = [];

    foreach ($palavras as $palavra) {
        $palavra = strtolower($palavra);
        $palavra = preg_replace('/[.,!?;:]/', '', $palavra);

        if ($palavra != "") {
            $lista[] = $palavra;
        }
    }

    $contagem = array_count_values($lista);
    $repetidas = 0;

    foreach ($contagem as $quantidade) {
        if ($quantidade > 1) {
            $repetidas++;
        }
    }

    return $repetidas;
}

function palavrasFrequentes($palavras)
{
    $lista = [];

    foreach ($palavras as $palavra) {
        $palavra = strtolower($palavra);
        $palavra = preg_replace('/[.,!?;:]/', '', $palavra);

        if ($palavra != "") {
            $lista[] = $palavra;
        }
    }

    $contagem = array_count_values($lista);

    arsort($contagem);

    return array_slice($contagem, 0, 5, true);
}

function tirarEspacos($texto)
{
    return trim(preg_replace('/\s+/', ' ', $texto));
}

function formatarTexto($texto)
{
    $texto = tirarEspacos($texto);

    return ucwords(strtolower($texto));
}

function processarTexto($texto)
{
    $palavras = separarPalavras($texto);

    return [
        "caracteres" => contarCaracteres($texto),
        "palavras" => contarPalavras($texto),
        "frases" => contarFrases($texto),
        "maior" => maiorPalavra($palavras),
        "menor" => menorPalavra($palavras),
        "repetidas" => palavrasRepetidas($palavras),
        "frequentes" => palavrasFrequentes($palavras),
        "texto_sem_espacos" => tirarEspacos($texto),
        "texto_formatado" => formatarTexto($texto)
    ];
}

$texto = "PHP é uma linguagem muito utilizada. PHP é fácil de aprender. Programar em PHP é interessante.";

$resultado = processarTexto($texto);

echo "PROCESSADOR DE TEXTO<br><br>";

echo "Caracteres: " . $resultado["caracteres"] . "<br>";
echo "Palavras: " . $resultado["palavras"] . "<br>";
echo "Frases: " . $resultado["frases"] . "<br>";
echo "Maior palavra: " . $resultado["maior"] . "<br>";
echo "Menor palavra: " . $resultado["menor"] . "<br>";
echo "Palavras repetidas: " . $resultado["repetidas"] . "<br><br>";

echo "5 palavras mais frequentes:<br>";

foreach ($resultado["frequentes"] as $palavra => $quantidade) {
    echo $palavra . " - " . $quantidade . " vez(es)<br>";
}

echo "<br>Texto sem espaços duplicados:<br>";
echo $resultado["texto_sem_espacos"];

echo "<br><br>Texto formatado:<br>";
echo $resultado["texto_formatado"];

?>