
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title"></span>
                    </a>
                </li>
              
                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
               
                <li>
                    <a href="course.php">
                        <span class="icon">
                        <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">courses</span>
                    </a>
                </li>
               

                
                <li>
                    <a href="categories.php">
                        <span class="icon">
                           <ion-icon name="grid-outline"></ion-icon>
                        </span>
                        <span class="title">Categorie</span>
                    </a>
                </li>
                <li>
                    <a href="articleDash.php">
                        <span class="icon">
                           <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">manage courses</span>
                    </a>
                </li>
                <li>
                    <a href="tags.php">
                        <span class="icon">
                        <ion-icon name="pricetag-outline"></ion-icon>
                        </span>
                        <span class="title">Tags</span>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">User</span>
                    </a>
                </li>
                
                <li>
    <a href="logout.php"> 
        <span class="icon">
            <ion-icon name="log-out-outline"></ion-icon>
        </span>
        <span class="title">Sign Out</span>
    </a>
</li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="../../assets/me.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">Cours</div>
                    </div>

                    <div class="iconBx">
                    <ion-icon name="document-text-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">Users</div>
                    </div>

                    <div class="iconBx">
                    <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">Tags</div>
                    </div>

                    <div class="iconBx">
                    <ion-icon name="pricetag-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">Categories</div>
                    </div>

                    <div class="iconBx">
                    <ion-icon name="grid-outline"></ion-icon>
                        
                    </div>
                </div>
            </div>

            <!-- ================ Add Charts JS ================= -->
            <div class="chartsBx">
                <div class="chart"><canvas id="chart-1"></canvas> </div>
                <div class="chart"> <canvas id="chart-2"></canvas> </div>
            </div>
    
     



            
            <script src="dashboard.js"></script>
   

   <!-- ======= Charts JS ====== -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
   <script src="assets/js/chartsJS.js"></script>

   <!-- ====== ionicons ======= -->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>