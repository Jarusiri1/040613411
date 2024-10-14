<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS Shop - โรงพยาบาลเอกชน ในกรุงเทพมหานคร</title>
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../csshop/mcss.css" rel="stylesheet" type="text/css" />
    <script src="../csshop/mpage.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            <img src="../csshop/cslogo.jpg" width="200" alt="Site Logo">
        </div>
        <div class="search">
            <form>
                <input type="search" placeholder="Search the site...">
                <button>Search</button>
            </form>
        </div>
    </header>

    <div class="mobile_bar">
        <a href="#"><img src="responsive-demo-home.gif" alt="Home"></a>
        <a href="#" onClick='toggle_visibility("menu"); return false;'><img src="responsive-demo-menu.gif" alt="Menu"></a>
    </div>

    <main>
        <article>
            <h1>โรงพยาบาลเอกชน ในกรุงเทพมหานคร</h1>

            <table id="hospitalTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ชื่อโรงพยาบาล</th>
                        <th>ขนาดใหญ่</th>
                        <th>ขนาดกลาง</th>
                        <th>ขนาดเล็ก</th>
                    </tr>
                </thead>
                <tbody id="hospitalData">
                    <!-- รายการโรงพยาบาลจะถูกแสดงที่นี่ -->
                    <?php
                    // ดึงข้อมูล JSON จาก URL
                    $json_url = "http://202.44.40.193/~aws/JSON/priv_hos.json";
                    $json_data = file_get_contents($json_url);
                    $hospitals = json_decode($json_data, true); // แปลงข้อมูลเป็น array

                    // วนลูปเพื่อแสดงผลข้อมูลโรงพยาบาล
                    $index = 1;
                    foreach ($hospitals['features'] as $hospital) {
                        $name = $hospital['properties']['name'];
                        $num_bed = (int)$hospital['properties']['num_bed'];
                        $size = '';

                        // กำหนดขนาดของโรงพยาบาล
                        if ($num_bed >= 91) {
                            $size = "large";
                        } elseif ($num_bed >= 31 && $num_bed <= 90) {
                            $size = "medium";
                        } else {
                            $size = "small";
                        }

                        // แสดงผลในตาราง
                        echo "<tr>";
                        echo "<td>" . $index++ . "</td>";
                        echo "<td>" . htmlspecialchars($name) . "</td>";
                        echo "<td>" . ($size === "large" ? "✔" : "") . "</td>";
                        echo "<td>" . ($size === "medium" ? "✔" : "") . "</td>";
                        echo "<td>" . ($size === "small" ? "✔" : "") . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </article>

        <nav id="menu">
            <h2>Navigation</h2>
            <ul class="menu">
                <li class="dead"><a>Home</a></li>
                <li><a href="../l10/login/login-form.php">Login Lab10</a></li>
                <li><a href="../l11">Lab 11</a></li>
                <li><a href="../l9">Lab 9</a></li>
                <li><a href="../lab8">Lab 8</a></li>
                <li><a href="../lab7">Lab 7</a></li>
            </ul>
        </nav>

        <aside>
            <h2>Aside</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit libero sit amet nunc ultricies, eu feugiat diam placerat. Phasellus tincidunt nisi et lectus pulvinar, quis tincidunt lacus viverra. Phasellus in aliquet massa. Integer iaculis massa id dolor venenatis scelerisque.
            </p>
        </aside>
    </main>

    <footer>
        <a href="#">Sitemap</a>
        <a href="#">Contact</a>
        <a href="#">Privacy</a>
    </footer>

</body>

</html>

