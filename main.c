#include <stdio.h>

void obterDados(int *idade, int *altura, float *peso, char *sexo, int *atividadeFisica, int *objetivo) {
    printf("---------- CRIE SUA DIETA ----------\n");

    printf("Qual a sua idade? ");
    scanf("%d", idade);

    printf("Qual a sua altura? (cm) ");
    scanf("%d", altura);

    printf("Qual o seu peso? (kg) ");
    scanf("%f", peso);

    printf("Qual o seu sexo? [M/F] ");
    scanf(" %c", sexo);

    printf("Qual dessas opções representa seu nível de atividade física diário: \n");
    printf("[1] Sedentário (pouca ou nenhuma atividade física)\n");
    printf("[2] Levemente ativo (atividades leves 1–3 dias/semana)\n");
    printf("[3] Moderadamente ativo (exercícios moderados 3–5 dias/semana)\n");
    printf("[4] Muito ativo (exercícios intensos 6–7 dias/semana)\n");
    printf("[5] Extremamente ativo (trabalho físico intenso ou treinos duplos)\n");
    scanf("%d", atividadeFisica);

    printf("Qual dessas opções representa seu objetivo atual: \n");
    printf("[1] Ganhar massa muscular\n");
    printf("[2] Manter o peso\n");
    printf("[3] Perder gordura\n");
    scanf("%d", objetivo);
}

float calcularGastoCaloricoBasal(char sexo, float peso, int altura, int idade) {
    float gastoCaloricoBasal;
    
    if (sexo == 'M') {
        return (10 * peso) + (6.25 * altura) - (5 * idade) + 5;
    } else if (sexo == 'F') {
        return (10 * peso) + (6.25 * altura) - (5 * idade) - 161;
    } else {
        printf("Erro: Sexo inválido. Use 'M' ou 'F'.\n");
        return -1;
    }
}

float calcularGastoCaloricoTotal(float gcb, int atividadeFisica) {
    switch (atividadeFisica) {
        case 1: return gcb * 1.2; 
        case 2: return gcb * 1.375;
        case 3: return gcb * 1.55;
        case 4: return gcb * 1.725;
        case 5: return gcb * 1.9;
        default:
            printf("Erro: Atividade física inválida.\n");
            return -1;
    }
}

float calcularConsumoCalorias(float gct, int objetivo) {
    switch (objetivo) {
        case 1: return gct + 500;
        case 2: return gct;
        case 3: return gct - 500;
        default:
            printf("Erro: Objetivo inválido.\n");
            return -1;
    }
}

int main() {
    int idade;
    int altura;
    float peso;
    char sexo;
    int atividadeFisica;
    int objetivo;
    float gastoCaloricoBasal;
    float gastoCaloricoTotal;
    float consumoCalorias;

    obterDados(&idade, &altura, &peso, &sexo, &atividadeFisica, &objetivo);

    gastoCaloricoBasal = calcularGastoCaloricoBasal(sexo, peso, altura, idade);
    if (gastoCaloricoBasal == -1) return 1;

    gastoCaloricoTotal = calcularGastoCaloricoTotal(gastoCaloricoBasal, atividadeFisica);
    if (gastoCaloricoTotal == -1) return 1;

    consumoCalorias = calcularConsumoCalorias(gastoCaloricoTotal, objetivo);
    if (consumoCalorias == -1) return 1;

    printf("Gasto calórico basal: %.0f\n", gastoCaloricoBasal);
    printf("Gasto calórico Total: %.0f\n", gastoCaloricoTotal);
    printf("Você deve consumir %0.f kcal por dia\n", consumoCalorias);

    return 0;
}