<?php
// ========== ВАШИ ДАННЫЕ ОТ INFINITYFREE (ЗАМЕНИТЕ НА СВОИ!) ==========
$host = "sql110.infinityfree.com";              // Ваш хост БД
$dbname = "if0_42015829_epiz_12345678_support_db";      // Полное имя БД
$username = "if0_42015829";          // Имя пользователя БД
$password = "5JzzoHU0Lg8kOT";                // Ваш пароль

// ========== ПОДКЛЮЧЕНИЕ ==========
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Устанавливаем кодировку
$conn->set_charset("utf8mb4");

// Получаем все сообщения (от новых к старым)
$result = $conn->query("SELECT * FROM messages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Сообщения поддержки</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #667eea;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .message {
            max-width: 300px;
            word-wrap: break-word;
        }
        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .empty {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Сообщения в поддержку</h1>
        <p>Всего сообщений: <strong><?= $result->num_rows ?></strong></p>
        
        <?php if ($result->num_rows == 0): ?>
            <div class="empty">
                Пока нет сообщений
            </div>
        <?php else: ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Сообщение</th>
                    <th>Дата</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td class="message"><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>
        
        <br>
        <a href="index.html" class="back">← На главную</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>