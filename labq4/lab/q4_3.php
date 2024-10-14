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
                <li><a href="../lab7w7/">lab7</a></li>
                <li><a href="../lab8/">lab8</a></li>
                <li><a href="../lab9/">lab9</a></li>
                <li><a href="../lab10/">lab10</a></li>
                <li><a href="../lab11/">lab11</a></li>
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

        async function getLargeHospitals() {
            try {

                let response = await fetch("http://202.44.40.193/~aws/JSON/priv_hos.json");
                if (!response.ok) {
                    throw new Error("Network response was not ok " + response.statusText);
                }
                let rawData = await response.text(); 
                let objectData = JSON.parse(rawData); 

                // กรองโรงพยาบาลที่มีเตียง >= 91
                return objectData.features.filter(hospital => {
                    let num_bed = parseInt(hospital.properties.num_bed, 10);
                    return num_bed >= 91;
                });
            } catch (error) {
                console.error("มีข้อผิดพลาดในการดึงข้อมูล:", error);
            }
        }

        async function populateHospitalDropdown() {
            const hospitalSelect = document.getElementById("hospitalSelect");
            const largeHospitals = await getLargeHospitals(); 

            largeHospitals.forEach(hospital => {
                const name = hospital.properties.name;

                const option = document.createElement("option");
                option.value = name;
                option.textContent = name;

                hospitalSelect.appendChild(option); 
            });

            hospitalSelect.addEventListener('change', function () {
                displayHospitalDetails(largeHospitals, this.value);
            });
        }

        function displayHospitalDetails(hospitals, selectedHospitalName) {
            const hospitalDetails = document.getElementById("hospitalDetails");
            hospitalDetails.innerHTML = ""; 

            const selectedHospital = hospitals.find(hospital => hospital.properties.name === selectedHospitalName);

            if (selectedHospital) {
                const name = selectedHospital.properties.name;
                const address = selectedHospital.properties.address;
                const dcode = selectedHospital.properties.dcode;
                const tel = selectedHospital.properties.tel;
                const num_bed = selectedHospital.properties.num_bed;

                let size;
                if (num_bed >= 91) {
                    size = "ขนาดใหญ่";
                } else if (num_bed >= 31 && num_bed <= 90) {
                    size = "ขนาดกลาง";
                } else {
                    size = "ขนาดเล็ก";
                }

                const details = `
                    <p><strong>ชื่อโรงพยาบาล:</strong> ${name}</p>
                    <p><strong>ที่อยู่:</strong> ${address}</p>
                    <p><strong>รหัสอำเภอ:</strong> ${dcode}</p>
                    <p><strong>เบอร์โทรศัพท์:</strong> ${tel}</p>
                    <p><strong>จำนวนเตียง:</strong> ${num_bed}</p>
                    <p><strong>ขนาดโรงพยาบาล:</strong> ${size}</p> <!-- เพิ่มการแสดงขนาดโรงพยาบาล -->
                `;

                hospitalDetails.innerHTML = details; 
            }
        }

        window.onload = populateHospitalDropdown;
    </script>

</body>

</html>