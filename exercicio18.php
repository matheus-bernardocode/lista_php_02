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