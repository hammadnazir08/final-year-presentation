<?php
    include 'config.php';

$sql = "SELECT c.CarID, c.ManufacturerID, m.Name as ManufacturerName, c.Model, c.Year, c.BasePrice, c.CarPicture 
        FROM cars c
        JOIN manufacturers m ON c.ManufacturerID = m.ManufacturerID
        WHERE c.status = 'approved'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="Autovis - Car Dealers HTML Template, Autovis - Car Dealers WordPress Theme, wordpress theme, premium wordpress theme, responsive wordpress theme, themeforest, envato,  themes & templates, wordpress theme, unlimited colors available, ui/ux, ui/ux design, best wordpress theme, wordpress theme, JavaScript, best css theme,css3, elementor theme, latest premium themes 2024, latest premium templates 2024, Preyan Technosys Pvt.Ltd, cymol themes, themetech mount, Web 3.0, multi-theme, website theme and template, bootstrap template, web templates, responsive theme, services, web design and development, blog website, HTML template, Html5, auto, business, car dealer, car dealership, car listing, cars, listing, motors, automotive, car repair, cardealer, cars, directory, elementor, car inventory, vehicle,  auto, auto dealer, auto shop, bike, buy car, car store, accessories shop, car ecommerce, car seller, car listing, auto dealer, auto parts, automobile, car rental, car repair, car shop, car wash, garage, marketplace, motor cycle, trucks" >
<meta name="description" content="Autovis - Car Dealers HTML Template" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Autovis - Car Dealers HTML Template</title>

<link rel="shortcut icon" href="images/favicon.webp">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/swiper-bundle.min.css">
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/all.min.css">
<link rel="stylesheet" type="text/css" href="css/fontello.css">
<link rel="stylesheet" type="text/css" href="css/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/themify-icons.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="css/aos.css">
<link rel="stylesheet" type="text/css" href="css/slick.css">
<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
<link rel="stylesheet" type="text/css" href="css/shortcodes.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/megamenu.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
<!-- REVOLUTION LAYERS STYLES -->
<link rel='stylesheet' id='rs-plugin-settings-css' href="revolution/css/rs6.css">
<style>
    .car-list-container {
        background-color: #000000; /* Black background for the table container */
        padding: 40px;
        border-radius: 40px;
        color: #ffffff; /* White text color */
    }
    .car-list-container h3 {
        font-size: 40px;
        color: #ffffff; /* White text color */
        margin-bottom: 20px;
    }
    .table th, .table td {
        vertical-align: middle;
        background-color: #1c1c1c; /* Dark background for table cells */
        color: #ffffff; /* White text color */
        border-color: #333333; /* Darker border color */
    }
    .table thead th {
        background-color: #333333; /* Dark background for table header */
    }
</style>
</head>
<body>

    <!-- page start -->
    <div class="page">

        <div class="main-box">

            <!--model register  -->
            <div class="modal signUp-modal fade" id="modal-signup" tabindex="-1" aria-labelledby="modal-signupLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 id="modal-signupLabel">Register</h3>
                            <p>Already have an account? <button class="signupbtn prt-btn btn-inline" type="button" data-bs-toggle="modal" data-bs-target="#modal-login">Log In</button></p>
                            <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"><i class="ti-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <form class="signup-form">
                                        <p class="prt-inputs">
                                            <i class="icon-user mt_3"></i>
                                            <input type="text" name="username" class="username form-control" placeholder="Enter name">
                                        </p>
                                        <p class="prt-inputs">
                                            <i class="ti-email"></i>
                                            <input type="text" name="email" class="email form-control" placeholder="Enter email">
                                        </p>
                                        <p class="prt-inputs">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                            <input type="password" name="password" class="password form-control" placeholder="Enter password">
                                        </p>
                                        <p class="prt-inputs">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                            <input type="password" name="comfirmpassword" class="password form-control" placeholder="Comfirm password">
                                        </p>
                                        <p><button type="submit" class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white">Sign up now</button></p>
                                        <p class="mb-15">By sign up you agree to the <a href="#">‘terms & conditons’</a></p>
                                    </form>
                                    <ul class="social-icons model-social">
                                        <li><a target="black" href="https://www.facebook.com/preyantechnosys19" rel="noopener" aria-label="facebook"><i class="ti-facebook"></i></a>
                                        </li>
                                        <li><a target="black" href="#" rel="noopener" aria-label="linkedin"><i class="ti-google"></i></a></li>
                                        <li><a target="black" href="https://twitter.com/PreyanTechnosys" rel="noopener" aria-label="twitter"><i class="flaticon flaticon-twitter"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- model register end -->
            <!-- model login -->
            <div class="modal signUp-modal fade" id="modal-login" tabindex="-1" aria-labelledby="modal-loginLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 id="modal-loginLabel">Log In</h3>
                            <p>Don’t have any account? <button class="signupbtn prt-btn btn-inline" type="button" data-bs-toggle="modal" data-bs-target="#modal-signup">Register</button></p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <form class="signup-form">
                                        <p class="prt-inputs">
                                            <i class="ti-email"></i>
                                            <input type="text" name="username" class="username form-control" placeholder="Enter email">
                                        </p>
                                        <p class="prt-inputs">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                            <input type="password" name="password" class="password form-control" placeholder="Enter password">
                                        </p>
                                        <p class="cookies">
                                            <span><input type="checkbox" name="cookies-consent" id="cookies-consent2">
                                            <label for="cookies-consent2"></label>
                                             Keep me signed in  
                                            </span><a href="#">Lost your password?</a>
                                        </p>
                                        <p><button type="submit" class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white">Login</button></p>
                                        <p class="mb-15">By sign up you agree to the <a href="#">‘terms & conditons’</a></p>
                                    </form>
                                    <ul class="social-icons model-social">
                                        <li><a target="black" href="https://www.facebook.com/preyantechnosys19" rel="noopener" aria-label="facebook"><i class="ti-facebook"></i></a>
                                        </li>
                                        <li><a target="black" href="#" rel="noopener" aria-label="linkedin"><i class="ti-google"></i></a></li>
                                        <li><a target="black" href="https://twitter.com/PreyanTechnosys" rel="noopener" aria-label="twitter"><i class="flaticon flaticon-twitter"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- model login end -->
 
            <!-- header start -->
            

            <section class="prt-row prt-bg bg-base-lightgrey comparecar-section clearfix">
    <div class="container" style="padding:200px 20px;">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title title-style-center_text">
                    <div class="title-header">
                        <h2 class="title">List of Cars</h2>
                        <div class="title-overlay style2" data-aos="fade-up" data-aos-duration="1500">Cars</div>
                    </div>
                    <div class="title-desc style2">
                        <p>We have a range of cars available. Browse through the list and find your next car.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- row end -->
        <!-- row -->
        <div class="row row-equal-height">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="600">
                        <!-- compare-card -->
                        <div class="featured-compare-card">
                            <div class="featured-imagebox featured-imagebox-comparecar">
                                <!-- prt-single-car -->
                                <div class="prt-single-car">
                                    <div class="featured-thumbnail">
                                        <img width="155" height="80" class="img-fluid" src="<?php echo htmlspecialchars($row['CarPicture']); ?>" alt="image">
                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-title">
                                            <span class="car-category"><?php echo htmlspecialchars($row['ManufacturerName']); ?></span>
                                            <h3 class="title"><a href="view.php?id=<?php echo $row['CarID']; ?>"><?php echo htmlspecialchars($row['Model']); ?><br><?php echo htmlspecialchars($row['Year']); ?></a></h3>
                                            <p class="price">$<?php echo number_format($row['BasePrice'], 2); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- prt-single-car end -->
                            </div>
                            <div class="compare-card-btn" style="display: flex; justify-content: space-between;">
                                <a class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white" href="view.php?id=<?php echo $row['CarID']; ?>">View</a>
                            </div>
                        </div>
                        <!-- compare-card end -->
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No cars found</p>
            <?php endif; ?>
        </div>
        <!-- row end -->
    </div>
</section>



        <!-- footer end -->

        <!-- back-to-top start -->
        <a id="totop" href="#top" style="display: inline;" class="top-visible">
            <i class="icon-angle-up"></i>
        </a>
        <!-- back-to-top end -->

    </div><!-- page end -->

    <!-- Javascript -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery-migrate-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script> 
    <script src="js/nouislider.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/Scrolltrigger.js"></script>
    <script src="js/Splittext.js"></script>
    <script src="js/cursor.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="js/jquery-validate.js"></script> 
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/slick.min.js"></script>   
    <script src="js/numinate.min.js"></script>
    <script src="js/imagesloaded.min.js"></script>  
    <script src="js/jquery-isotope.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/main.js"></script>
    <script src="js/aos.js"></script>
    <script>
        AOS.init({
            offset: 0,
            duration: 400,
            delay:0,
            once: true,
        });
    </script>

    <!-- Revolution Slider -->    
    <script src='revolution/js/revolution.tools.min.js'></script>
    <script src='revolution/js/rs6.min.js'></script>
    <script src="revolution/js/slider.js"></script>
    <!-- Javascript end-->

</body>
</html>
<?php $conn->close(); ?>