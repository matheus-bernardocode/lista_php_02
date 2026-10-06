<?php

function contarConsultas($agenda)
{
    return count($agenda);
}

function contarPacientes($agenda)
{
    $pacientes = [];

    foreach ($agenda as $consulta) {
        $pacientes[] = $consulta["paciente"];
    }

    return count(array_unique($pacientes));
}

function contarEspecialidades($agenda)
{
    $especialidades = [];

    foreach ($agenda as $consulta) {

        $nome = $consulta["especialidade"];

        if (isset($especialidades[$nome])) {
            $especialidades[$nome]++;
        } else {
            $especialidades[$nome] = 1;
        }
    }

    return $especialidades;
}

function ordenarAgenda($agenda)
{
    usort($agenda, function ($a, $b) {
        return strcmp($a["horario"], $b["horario"]);
    });

    return $agenda;
}
function primeiroAtendimento($agenda)
{
    $agenda = ordenarAgenda($agenda);

    return $agenda[0];
}

function ultimoAtendimento($agenda)
{
    $agenda = ordenarAgenda($agenda);

    return $agenda[count($agenda) - 1];
}

function pesquisarPaciente($agenda, $nome)
{
    $resultado = [];

    foreach ($agenda as $consulta) {

        if (stripos($consulta["paciente"], $nome) !== false) {
            $resultado[] = $consulta;
        }
    }

    return $resultado;
}

function horariosDuplicados($agenda)
{
    $horarios = [];
    $duplicados = [];

    foreach ($agenda as $consulta) {

        $horario = $consulta["horario"];

        if (in_array($horario, $horarios)) {
            $duplicados[] = $horario;
        } else {
            $horarios[] = $horario;
        }
    }

    return array_unique($duplicados);
}

function organizarAgenda($agenda, $nomePaciente)
{
    return [
        "total" => contarConsultas($agenda),
        "pacientes" => contarPacientes($agenda),
        "especialidades" => contarEspecialidades($agenda),
        "primeiro" => primeiroAtendimento($agenda),
        "ultimo" => ultimoAtendimento($agenda),
        "agenda" => ordenarAgenda($agenda),
        "pesquisa" => pesquisarPaciente($agenda, $nomePaciente),
        "duplicados" => horariosDuplicados($agenda)
    ];
}


$agenda = [

    [
        "paciente" => "João",
        "especialidade" => "Cardiologia",
        "data" => "05/10/2026",
        "horario" => "08:00"
    ],

    [
        "paciente" => "Maria",
        "especialidade" => "Dermatologia",
        "data" => "05/10/2026",
        "horario" => "09:00"
    ],

    [
        "paciente" => "Pedro",
        "especialidade" => "Cardiologia",
        "data" => "05/10/2026",
        "horario" => "10:00"
    ],

    [
        "paciente" => "João",
        "especialidade" => "Ortopedia",
        "data" => "05/10/2026",
        "horario" => "11:00"
    ],

    [
        "paciente" => "Ana",
        "especialidade" => "Dermatologia",
        "data" => "05/10/2026",
        "horario" => "09:00"
    ]
];


$resultado = organizarAgenda($agenda, "João");


echo "GERENCIADOR DE AGENDA<br><br>";

echo "Total de consultas: " . $resultado["total"] . "<br>";
echo "Pacientes diferentes: " . $resultado["pacientes"] . "<br><br>";

echo "Consultas por especialidade:<br>";

foreach ($resultado["especialidades"] as $especialidade => $quantidade) {
    echo $especialidade . ": " . $quantidade . "<br>";
}

echo "<br>";

echo "Primeiro atendimento:<br>";
echo "Paciente: " . $resultado["primeiro"]["paciente"] . "<br>";
echo "Horário: " . $resultado["primeiro"]["horario"] . "<br>";

echo "<br>";

echo "Último atendimento:<br>";
echo "Paciente: " . $resultado["ultimo"]["paciente"] . "<br>";
echo "Horário: " . $resultado["ultimo"]["horario"] . "<br>";

echo "<br>";

echo "Agenda em ordem de horário:<br>";

foreach ($resultado["agenda"] as $consulta) {
    echo $consulta["horario"] . " - ";
    echo $consulta["paciente"] . " - ";
    echo $consulta["especialidade"] . "<br>";
}

echo "<br>";

echo "Pesquisa pelo paciente João:<br>";

foreach ($resultado["pesquisa"] as $consulta) {
    echo $consulta["paciente"] . " - ";
    echo $consulta["especialidade"] . " - ";
    echo $consulta["horario"] . "<br>";
}

echo "<br>";

echo "Horários duplicados:<br>";

if (count($resultado["duplicados"]) == 0) {
    echo "Nenhum horário duplicado.";
} else {
    foreach ($resultado["duplicados"] as $horario) {
        echo $horario . "<br>";
    }
}

?>