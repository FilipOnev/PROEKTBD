<?php
// ========== НАСТРОЙКИ (ЗАМЕНИТЕ НА СВОИ) ==========
$host = "sql110.infinityfree.com";              // Ваш хост
$dbname = "if0_42015829_epiz_12345678_support_db";      // Имя БД
$username = "if0_42015829";          // Логин
$password = "5JzzoHU0Lg8kOT";                // Пароль

// ========== ПОДКЛЮЧЕНИЕ ==========
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка: " . $conn->connect_error);
}

// ========== УСТАНАВЛИВАЕМ КОДИРОВКУ ==========
$conn->set_charset("utf8mb4");

// ========== ПОЛУЧАЕМ ДАННЫЕ ==========
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if (empty($name) || empty($email) || empty($message)) {
    echo "Заполните все поля";
    exit;
}

// ========== СОХРАНЯЕМ ==========
$stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo "Сообщение отправлено!";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>