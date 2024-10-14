<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โรงพยาบาลขนาดใหญ่ ในกรุงเทพมหานคร</title>
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

        table,
        th,
        td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .hospital-size {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
            margin: 20px 0;
            display: block;
        }

        .logo img {
            width: 200px;
        }

        .search {
            margin-top: 10px;
        }

        .mobile_bar {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="../csshop/cslogo.jpg" alt="Site Logo">
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
        <a href="#" onClick='toggle_visibility("menu"); return false;'><img src="responsive-demo-menu.gif"
                alt="Menu"></a>
    </div>

    <main>
        <article>
            <h1>เลือกโรงพยาบาลขนาดใหญ่ ในกรุงเทพมหานคร</h1>

            <label for="hospitalSelect">เลือกโรงพยาบาล:</label>
            <select id="hospitalSelect">
                <option value="">-- กรุณาเลือกโรงพยาบาล --</option>
            </select>

            <h2>รายละเอียดโรงพยาบาล</h2>
            <div id="hospitalDetails"></div>
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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit libero sit amet nunc ultricies, eu
                feugiat diam placerat. Phasellus tincidunt nisi et lectus pulvinar, quis tincidunt lacus viverra.
                Phasellus in aliquet massa. Integer iaculis massa id dolor venenatis scelerisque.
            </p>
        </aside>
    </main>

    <footer>
        <a href="#">Sitemap</a>
        <a href="#">Contact</a>
        <a href="#">Privacy</a>
    </footer>


    <script>
        // ฟังก์ชันสำหรับดึงข้อมูล JSON ผ่าน XMLHttpRequest
        function getLargeHospitals(callback) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://202.44.40.193/~aws/JSON/priv_hos.json", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    var largeHospitals = data.features.filter(function (hospital) {
                        var num_bed = parseInt(hospital.properties.num_bed, 10);
                        return num_bed >= 91;
                    });
                    callback(largeHospitals); // ส่งข้อมูลไปที่ callback
                }
            };
            xhr.send();
        }

        // ฟังก์ชันสำหรับเพิ่มตัวเลือกใน dropdown
        function populateHospitalDropdown() {
            var hospitalSelect = document.getElementById("hospitalSelect");
            getLargeHospitals(function (largeHospitals) {
                largeHospitals.forEach(function (hospital) {
                    var name = hospital.properties.name;
                    var option = document.createElement("option");
                    option.value = name;
                    option.textContent = name;
                    hospitalSelect.appendChild(option);
                });

                hospitalSelect.addEventListener('change', function () {
                    displayHospitalDetails(largeHospitals, this.value);
                });
            });
        }

        // ฟังก์ชันสำหรับแสดงรายละเอียดโรงพยาบาล
        function displayHospitalDetails(hospitals, selectedHospitalName) {
            var hospitalDetails = document.getElementById("hospitalDetails");
            hospitalDetails.innerHTML = ""; 

            var selectedHospital = hospitals.find(function (hospital) {
                return hospital.properties.name === selectedHospitalName;
            });

            if (selectedHospital) {
                var name = selectedHospital.properties.name;
                var address = selectedHospital.properties.address;
                var dcode = selectedHospital.properties.dcode;
                var tel = selectedHospital.properties.tel;
                var num_bed = selectedHospital.properties.num_bed;

                var size;
                if (num_bed >= 91) {
                    size = "ขนาดใหญ่";
                } else if (num_bed >= 31 && num_bed <= 90) {
                    size = "ขนาดกลาง";
                } else {
                    size = "ขนาดเล็ก";
                }

                var details = `
                    <p><strong>ชื่อโรงพยาบาล:</strong> ${name}</p>
                    <p><strong>ที่อยู่:</strong> ${address}</p>
                    <p><strong>รหัสอำเภอ:</strong> ${dcode}</p>
                    <p><strong>เบอร์โทรศัพท์:</strong> ${tel}</p>
                    <p><strong>จำนวนเตียง:</strong> ${num_bed}</p>
                    <p><strong>ขนาดโรงพยาบาล:</strong> ${size}</p>
                `;

                hospitalDetails.innerHTML = details; 
            }
        }

        window.onload = populateHospitalDropdown;
    </script>

</body>

</html>
