<?php
$servername = "mysql";
$username = "my_user";
$password = "my_password";
$dbname = "my_database";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del formulario
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Preparar y ejecutar la consulta de inserción
$sql = "INSERT INTO form_data (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
        $success_message = "Nuevo registro creado exitosamente";
        $success = true;
    } else {
        $error_message = "Error: " . $stmt->error;
        $success = false;
    }

    // Cerrar conexión
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Resultado del Formulario</title>
</head>
<body>
    <div class="container">
        <div class="message">
            <?php if (isset($success) && $success): ?>
                <p class="success"><?php echo $success_message; ?></p>
            <?php else: ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

