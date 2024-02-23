<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Kool Form Pack | Register or Create an account</title>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

        <!-- CSS FILES -->                
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,700;1,200&family=Unbounded:wght@400;700&display=swap" rel="stylesheet">
        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/tooplate-kool-form-pack.css" rel="stylesheet">
<!--

Tooplate 2136 Kool Form Pack

https://www.tooplate.com/view/2136-kool-form-pack

Bootstrap 5 Form Pack Template

-->
    </head>
    
    <body>

        <main>

        <header class="site-header">
                <div class="container">
                    <div class="row justify-content-between">

                        <div class="col-lg-12 col-12 d-flex">
                            <a class="site-header-text d-flex justify-content-center align-items-center me-auto" href="login.php">
                            <i class="fa-brands fa-dropbox"></i>
                                <span class="text-white me-4 d-none d-lg-block">
                                    ทะเบียนพัสดุครุภัณฑ์และการแจ้งซ่อม
                                </span>
                            </a>

                            <ul class="social-icon d-flex justify-content-center align-items-center mx-auto">
                                <span class="text-white me-4 d-none d-lg-block">องค์การบริหารส่วนจังหวัดจันทบุรี</span>

                                <li class="social-icon-item">
                                    <a href="https://www.instagram.com/chanpao.chanyim?igsh=MXgydmxvMWdvcXI2Yg==" class="fa-brands fa-instagram"></a>
                                </li>
                                <&nbsp>
                                <li class="social-icon-item">
                                    <a href="https://www.facebook.com/Chanpaochanyim" class="fa-brands fa-facebook"></a>
                                </li>
                                <&nbsp>
                                <li class="social-icon-item">
                                    <a href="https://www.chan-pao.go.th/" class="fa-solid fa-globe"></a>
                                </li>
                            </ul>

                            <a class="fa-solid fa-bars fa-2x" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu"></a>

                        </div>

                    </div>
                </div>
            </header>

            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">                
                <div class="offcanvas-header">                    
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                
                <div class="offcanvas-body d-flex flex-column justify-content-center align-items-center">
                    <nav>
                        <ul>
                            <li>
                                <a class="active" href="login.php">Login Form</a>
                            </li>

                            <li>
                                <a href="register.php">Create an account</a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="#" method="get" class="custom-form mt-lg-4 mt-2" role="form">
                                <h2 class="modal-title" id="subscribeModalLabel">Stay up to date</h2>

                                <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="your@email.com" required="">

                                <button type="submit" class="form-control">Notify</button>
                            </form>
                        </div>

                        <div class="modal-footer justify-content-center">
                            <p>By signing up, you agree to our Privacy Notice</p>
                        </div>
                    </div>
                </div>
            </div>
<br><br>

            <section class="hero-section d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12 mx-auto">
                            <form class="custom-form" role="form" action="process_registration.php" method="post">
                                <h2 class="hero-title text-center mb-4 pb-2">Create an account</h2>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-floating">
                                            <input type="text" name="u_fname" class="form-control" required><br>
                                            
                                            <label for="floatingInput">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-floating">
                                            <input type="text" name="u_lname" class="form-control" required><br>
                                            
                                            <label for="floatingInput">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-floating p-0">
                                            <input type="email" name="u_email" id="u_email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required="">

                                            <label for="email">Email address</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-floating p-0">
                                            <input type="password" name="u_password" id="u_password" class="form-control"  required>

                                            <label for="password">Password</label>
                                        </div>

                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                          
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I agree to the Terms of Service and Privacy Policy.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <label for="u_status" class="hero-title text-center mb-4 pb-2">Status:</label>
                                        <select name="u_status" required>
                                            <option value="ใช้งาน">Active</option>
                                            <option value="ไม่ได้ใช้งาน">Inactive</option>
                                        </select><br>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <label for="u_type" class="hero-title text-center mb-4 pb-2">User Type:</label>
                                        <select name="u_type" required>
                                            <option value="ผู้ใช้">User(ผู้ใช้ทั่วไป)</option>
                                            <option value="ช่าง">Technician(ช่าง)</option>
                                        </select><br>
                                    </div>
                                    <div class="row">
    <div class="col-lg-6 col-md-6 col-12">
        <label for="u_dp_id" class="hero-title text-center mb-4 pb-2">Department</label>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <select name="u_dp_id" required>
        <option>ประชาชน</option>
            <?php
                // Include database connection code here
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "repair";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to retrieve Department IDs and Names from the 'department' table
                $sql = "SELECT dp_id, dp_name FROM department";
                $result = $conn->query($sql);

                // Fetch and display the Department Names in the dropdown
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['dp_id']."'>".$row['dp_name']."</option>";
                }

                $conn->close();
            ?>
        </select>
    </div>
</div>

                                    
  
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-lg-5 col-md-5 col-5 ms-auto">
                                        <input type="submit" class="form-control" value="Register">
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-7">
                                            <p class="mb-0">Already have an account? <a href="login.php" class="ms-2">Login</a></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="video-wrap">
                    <video autoplay="" loop="" muted="" class="custom-video" poster="">
                        <source src="videos\_Patel.mp4" type="video/mp4">
                    </video>
                </div>
            </section>
        </main>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/countdown.js"></script>
        <script src="js/init.js"></script>

    </body>
</html>
