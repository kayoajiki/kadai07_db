<?php
include('db.php');

$sql = "SELECT * FROM tb ORDER BY indate DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>NY Travel Bookmark 一覧</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(to bottom, #1a1a2e, #16213e);
      color: #fff;
      margin: 0;
      padding: 20px;
    }

    h1 {
      font-family: 'Playfair Display', serif;
      text-align: center;
      font-size: 2.5em;
      color: #f0c929;
      margin-bottom: 1em;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(255,255,255,0.05);
      margin-bottom: 2em;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,0.2);
    }

    th {
      background-color: rgba(255,255,255,0.1);
      font-weight: bold;
    }

    tr:hover {
      background-color: rgba(255,255,255,0.1);
    }

    .btn-back {
      display: block;
      width: fit-content;
      margin: 0 auto;
      background: #f0c929;
      color: #1a1a2e;
      padding: 12px 24px;
      border-radius: 6px;
      font-weight: bold;
      text-decoration: none;
      transition: 0.3s;
    }

    .btn-back:hover {
      background: #fff;
      color: #1a1a2e;
    }

    @media screen and (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      th {
        background: none;
        font-size: 1.1em;
        padding-top: 20px;
      }

      td {
        padding-left: 20px;
      }

      td:before {
        content: attr(data-label);
        font-weight: bold;
        display: block;
        color: #f0c929;
      }
    }
  </style>
</head>
<body>

  <h1>📄 NY Travel Bookmark 一覧</h1>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>地名</th>
        <th>緯度</th>
        <th>経度</th>
        <th>区分</th>
        <th>コメント</th>
        <th>登録日時</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $row): ?>
      <tr>
        <td data-label="ID"><?= htmlspecialchars($row['id']) ?></td>
        <td data-label="地名"><?= htmlspecialchars($row['name']) ?></td>
        <td data-label="緯度"><?= htmlspecialchars($row['lat']) ?></td>
        <td data-label="経度"><?= htmlspecialchars($row['lng']) ?></td>
        <td data-label="区分"><?= htmlspecialchars($row['status']) ?></td>
        <td data-label="コメント"><?= htmlspecialchars($row['comment']) ?></td>
        <td data-label="登録日時"><?= htmlspecialchars($row['indate']) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="index.php" class="btn-back">← 地図に戻る</a>

</body>
</html>