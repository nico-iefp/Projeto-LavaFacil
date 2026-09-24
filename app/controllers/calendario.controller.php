<?php
// Certifique-se de que o caminho usa o __DIR__ de forma exata
require_once __DIR__ . '/../models/calendario.model.php';

class CalendarioController {
    private $model;

    public function __construct($pdo) {
        $this->model = new CalendarioModel($pdo);
    }

    public function carregarDashboard() {
        return $this->model->getCalendarioAnual(2026);
    }

    public function processarAtualizacao() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['estado'])) {
            $id = $_POST['id'];
            $estado = $_POST['estado'];

            if (!in_array($estado, ['Concluído', 'Por cumprir'])) {
                echo json_encode(['success' => false, 'error' => 'Estado inválido.']);
                exit;
            }

            $sucesso = $this->model->atualizarEstado($id, $estado);
            echo json_encode(['success' => $sucesso]);
            exit;
        }

        echo json_encode(['success' => false, 'error' => 'Pedido inválido.']);
        exit;
    }
}
