<?php
session_start();
include '../include/db.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password'])); // Hash da senha em MD5

    $query = "SELECT * FROM login WHERE user = '$username'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        http_response_code(500);
        echo json_encode(['error' => 'Erro na consulta ao banco de dados.']);
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        // Verifique a senha hashada
        if ($data['password'] === $password) {
            // Verifica se a data do plano já passou
            $plano_expirado = (strtotime($data['plano']) < time());
            
            if ($plano_expirado) {
                http_response_code(403);
                echo json_encode(['status' => 'error', 'message' => 'Plano expirado.']);
            } else {
                $_SESSION['user'] = $username; // Salve o usuário na sessão
                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            }
        } else {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Senha incorreta.']);
        }
    } else {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Usuário não encontrado.']);
    }
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Nome de usuário ou senha não fornecidos.']);
}

mysqli_close($conn);
?>
