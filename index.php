<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>NY Travel Bookmark</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(to bottom, #1a1a2e, #16213e);
      color: #fff;
    }

    h1 {
      font-family: 'Playfair Display', serif;
      text-align: center;
      font-size: 2.5em;
      color: #f0c929;
      margin: 1em 0 0.5em;
    }

    #map {
      width: 100%;
      height: 500px;
    }

    .form-container {
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      margin: 30px auto;
      max-width: 600px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    form input, form select {
        width: 90%;                 /* ← 幅を100% → 90% に */
        padding: 10px;
        margin: 8px auto 15px auto; /* ← 上下はそのまま、左右を auto に */
        display: block;             /* ← 中央に寄せるため */
        border: none;
        border-radius: 5px;
        font-size: 1em;
    }

    form button {
      background: #f0c929;
      color: #1a1a2e;
      border: none;
      padding: 12px 24px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
      transition: all 0.3s;
    }

    form button:hover {
      background: #fff;
      color: #1a1a2e;
    }

    .nav-links {
      text-align: center;
      margin-bottom: 2em;
    }

    .nav-links a {
      color: #f0c929;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
    }

    .nav-links a:hover {
      text-decoration: underline;
    }

    #toast {
      display: none;
      position: fixed;
      top: 20px;
      right: 20px;
      background: #f0c929;
      color: #1a1a2e;
      padding: 15px 20px;
      border-radius: 8px;
      font-weight: bold;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
      z-index: 9999;
      transition: opacity 0.5s ease-in-out;
    }
  </style>
</head>
<body>
<input id="pac-input" class="controls" type="text" placeholder="NYスポットを検索">
  <h1>🗽 NY Travel Bookmark</h1>
  <div id="map"></div>
  <div class="form-container">
    <form id="bookmarkForm">
      地名：<input type="text" name="name" required>
      緯度：<input type="text" name="lat" id="lat" readonly>
      経度：<input type="text" name="lng" id="lng" readonly>
      区分：
      <select name="status">
        <option value="行きたい">行きたい</option>
        <option value="行った">行った</option>
      </select>
      コメント：<input type="text" name="comment">
      <button type="submit" id="submitBtn">📍 登録する</button>
    </form>
  </div>

  <div class="nav-links">
    <a href="list.php">📄 一覧を見る</a>
  </div>

  <!-- トースト通知 -->
  <div id="toast">✔️ 保存しました！</div>


  <!-- 地図＆API -->
  <script src="map.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=●●●&libraries=places&callback=initMap" async defer></script>

  </script>

  <script>
    document.getElementById("bookmarkForm").addEventListener("submit", function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);
      const button = document.getElementById("submitBtn");

      fetch("insert.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          showToast("✔️ 保存しました！");
          button.innerText = "✔️ 登録完了！";
          button.style.background = "#4caf50";

          // 元に戻す
          setTimeout(() => {
            button.innerText = "📍 登録する";
            button.style.background = "#f0c929";
            form.reset();
          }, 3000);
        } else {
          showToast("⚠️ エラーが発生しました");
        }
      })
      .catch(() => {
        showToast("⚠️ 通信エラー");
      });
    });

    function showToast(msg) {
      const toast = document.getElementById("toast");
      toast.innerText = msg;
      toast.style.display = "block";
      toast.style.opacity = 1;

      setTimeout(() => {
        toast.style.opacity = 0;
        setTimeout(() => toast.style.display = "none", 500);
      }, 3000);
    }
  </script>

</body>
</html>