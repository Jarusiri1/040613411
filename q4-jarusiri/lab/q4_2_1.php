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
                <tbody>
                   
                </tbody>
            </table>

            <script>
                async function getDataFromAPI() {
                    try {

                        let response = await fetch("http://202.44.40.193/~aws/JSON/priv_hos.json");
                        if (!response.ok) {
                            throw new Error("Network response was not ok " + response.statusText);
                        }
                        let rawData = await response.text(); 
                        let objectData = JSON.parse(rawData); 

                        displayHospitals(objectData.features);
                    } catch (error) {
                        console.error("มีข้อผิดพลาดในการดึงข้อมูล:", error);
                    }
                }

                function displayHospitals(hospitals) {
                    const tableBody = document.getElementById("hospitalTable").getElementsByTagName("tbody")[0];

                    hospitals.forEach((hospital, index) => {
                        const name = hospital.properties.name;
                        const num_bed = parseInt(hospital.properties.num_bed, 10);
                        let size;

                        if (num_bed >= 91) {
                            size = "large";
                        } else if (num_bed >= 31 && num_bed <= 90) {
                            size = "medium";
                        } else {
                            size = "small";
                        }

                        const row = document.createElement("tr");

                        const numberCell = document.createElement("td");
                        numberCell.textContent = index + 1;
                        row.appendChild(numberCell);

                        const nameCell = document.createElement("td");
                        nameCell.textContent = name;
                        row.appendChild(nameCell);

                        const largeCell = document.createElement("td");
                        const mediumCell = document.createElement("td");
                        const smallCell = document.createElement("td");

                        if (size === "large") {
                            largeCell.textContent = "✔";
                        } else if (size === "medium") {
                            mediumCell.textContent = "✔";
                        } else if (size === "small") {
                            smallCell.textContent = "✔";
                        }

                        row.appendChild(largeCell);
                        row.appendChild(mediumCell);
                        row.appendChild(smallCell);

                        tableBody.appendChild(row);
                    });
                }

                getDataFromAPI();
            </script>
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
