<?php

if (!class_exists('CalendarioModel')) {

    class CalendarioModel {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function getCalendarioAnual($ano = 2026) {
            // Consulta simplificada por ID (instantânea para o Laragon)
            $sql = "SELECT * FROM calendario_fiscal WHERE ano = :ano ORDER BY id ASC";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':ano' => $ano]);
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $calendario = [];
            foreach ($dados as $linha) {
                $calendario[$linha['mes']][] = $linha;
            }
            return $calendario;
        }

        public function atualizarEstado($id, $novoEstado) {
            $sql = "UPDATE calendario_fiscal SET estado = :estado WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':estado' => $novoEstado,
                ':id' => (int)$id
            ]);
        }
    }

}
