<?php

$alunos = [];

// Cadastro de alunos
for ($i = 0; $i < 5; $i++) {
    echo "Digite o nome do aluno " . ($i + 1) . ": ";
    $alunos[$i]['nome'] = trim(fgets(STDIN));
    $alunos[$i]['notas'] = [];
}

// Menu principal
do {
    echo "\nMenu Principal\n";
    echo "1. Atribuir Notas\n";
    echo "2. Exibir Resultados\n";
    echo "3. Editar Notas\n";
    echo "4. Sair\n";
    echo "Escolha uma opção: ";
    $opcao = trim(fgets(STDIN));

    switch ($opcao) {
        case 1:
            foreach ($alunos as &$aluno) {
                echo "Atribuindo notas para " . $aluno['nome'] . ":\n";
                for ($j = 0; $j < 4; $j++) {
                    do {
                        echo "Digite a nota " . ($j + 1) . " (0 a 10): ";
                        $nota = trim(fgets(STDIN));
                        if ($nota >= 0 && $nota <= 10) {
                            $aluno['notas'][$j] = $nota;
                            break;
                        } else {
                            echo "Nota inválida. Por favor, insira um valor entre 0 e 10.\n";
                        }
                    } while (true);
                }
                // Calcula a nota total e a média
                $aluno['nota_total'] = array_sum($aluno['notas']);
                $aluno['media'] = $aluno['nota_total'] / count($aluno['notas']);
            }
            break;

        case 2:
            foreach ($alunos as $aluno) {
                echo "Resultados para " . $aluno['nome'] . ":\n";
                echo "Notas: " . implode(", ", $aluno['notas']) . "\n";
                echo "Nota Total: " . $aluno['nota_total'] . "\n";
                echo "Média: " . $aluno['media'] . "\n";
                if ($aluno['media'] < 4) {
                    echo "Resultado: Reprovado\n";
                } elseif ($aluno['media'] >= 4 && $aluno['media'] <= 6) {
                    echo "Resultado: Recuperação\n";
                } else {
                    echo "Resultado: Aprovado\n";
                }
                echo "\n";
            }
            break;

        case 3:
            echo "Digite o nome do aluno para editar as notas: ";
            $nome = trim(fgets(STDIN));
            foreach ($alunos as &$aluno) {
                if ($aluno['nome'] === $nome) {
                    echo "Editando notas para " . $aluno['nome'] . ":\n";
                    for ($j = 0; $j < 4; $j++) {
                        do {
                            echo "Digite a nova nota " . ($j + 1) . " (0 a 10): ";
                            $nota = trim(fgets(STDIN));
                            if ($nota >= 0 && $nota <= 10) {
                                $aluno['notas'][$j] = $nota;
                                break;
                            } else {
                                echo "Nota inválida. Por favor, insira um valor entre 0 e 10.\n";
                            }
                        } while (true);
                    }
                    // Recalcula a nota total e a média
                    $aluno['nota_total'] = array_sum($aluno['notas']);
                    $aluno['media'] = $aluno['nota_total'] / count($aluno['notas']);
                    break;
                }
            }
            break;

        case 4:
            echo "Saindo do sistema...\n";
            break;

        default:
            echo "Opção inválida. Por favor, escolha uma opção válida.\n";
            break;
    }
} while ($opcao != 4);

?>