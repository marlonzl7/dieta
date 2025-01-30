<?php

function obterDados(int &$idade, int &$altura, float &$peso, string &$sexo, int &$atividadeFisica, int &$objetivo) {
    echo "---------- CRIE SUA DIETA ----------\n";

    echo "Qual a sua idade? ";
    $idade = (int)trim(fgets(STDIN));

    echo "Qual a sua altura? (cm) ";
    $altura = (int)trim(fgets(STDIN));

    echo "Qual o seu peso? (kg) ";
    $peso = (float)trim(fgets(STDIN));

    echo "Qual seu sexo? [M/F] ";
    $sexo = trim(fgets(STDIN));

    echo "Qual dessas opções representa seu nível de atividade física diário: \n";
    echo "[1] Sedentário (pouca ou nenhuma atividade física)\n";
    echo "[2] Levemente ativo (atividades leves 1–3 dias/semana)\n";
    echo "[3] Moderadamente ativo (exercícios moderados 3–5 dias/semana)\n";
    echo "[4] Muito ativo (exercícios intensos 6–7 dias/semana)\n";
    echo "[5] Extremamente ativo (trabalho físico intenso ou treinos duplos)\n";
    $atividadeFisica = (int)trim(fgets(STDIN));

    echo "Qual dessas opções representa seu objetivo atual: \n";
    echo "[1] Ganhar massa muscular\n";
    echo "[2] Manter o peso\n";
    echo "[3] Perder gordura\n";
    $objetivo = (int)trim(fgets(STDIN));
}

function calcularGastoCaloricoBasal(string $sexo, float $peso, int $altura, int $idade) {
    $masculino = ['M', 'm', 'Masculino', 'masculino'];
    $feminino = ['F', 'f', 'Feminino', 'feminino'];

    if (in_array(trim($sexo), $masculino)) {
        return $gastoCaloricobasal = (10 * $peso) + (6.25 * $altura) - (5 * $idade) + 5;
    } else if (in_array(trim($sexo), $feminino)) {
        return $gastoCaloricobasal = (10 * $peso) + (6.25 * $altura) - (5 * $idade) - 161;
    }

    throw new Exception("Sexo fornecido inválido");
}

function calcularGastoCaloricoTotal(float $gcb, int $atividadeFisica) {
    switch ($atividadeFisica) {
        case 1: return $gcb * 1.2; 
        case 2: return $gcb * 1.375;
        case 3: return $gcb * 1.55;
        case 4: return $gcb * 1.725;
        case 5: return $gcb * 1.9;
        default:
            throw new Exception("Erro parâmetro inválido");
    }
}

function calcularConsumoCalorias(float $gct, int $objetivo) {
    switch ($objetivo) {
        case 1: return $gct + 500;
        case 2: return $gct;
        case 3: return $gct - 500;
    }
}

function main(): void {
    $idade = 0;
    $altura = 0;
    $peso = 0.0;
    $sexo = "";
    $atividadeFisica = 0;
    $objetivo = 0;
    $gastoCaloricoBasal = 0.0;
    $gastoCaloricoTotal = 0.0;
    $consumoCalorias = 0;

    obterDados($idade, $altura, $peso, $sexo, $atividadeFisica, $objetivo);

    $gastoCaloricoBasal = calcularGastoCaloricoBasal($sexo, $peso, $altura, $idade);
    $gastoCaloricoTotal = calcularGastoCaloricoTotal($gastoCaloricoBasal, $atividadeFisica);

    $consumoCalorias = calcularConsumoCalorias($gastoCaloricoTotal, $objetivo);

    echo "Gasto calórico basal: " . round($gastoCaloricoBasal) . "kcal\n";
    echo "Gasto calórico Total: " . round($gastoCaloricoTotal) . "kcal\n";
    echo "Você deve consumir " . round($consumoCalorias) . "kcal por dia\n";
}

main();