<?php
include 'config.php';

$show_success_message = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize user inputs
    function sanitize_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Collect and sanitize the form data
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $zipcode = sanitize_input($_POST['zipcode']);
    $message = sanitize_input($_POST['message']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact_us (name, email, phone_number, zip_code, comments) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("sssss", $name, $email, $phone, $zipcode, $message);

    // Execute the statement
    if ($stmt->execute()) {
        $show_success_message = true;
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
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
<style>
        .success-message {
            display: none;
            padding: 20px;
            margin: 20px 0;
            color: #fff;
            background-color: #800080; /* Purple color */
            text-align: center;
            border-radius: 8px;
            font-size: 1.2em;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>
<body>
<?php if ($show_success_message): ?>
        <div class="success-message" id="success-message">Thanks for contacting us! Your remarks are valuable to us.</div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var message = document.getElementById("success-message");
                message.style.display = "block";
                setTimeout(function() {
                    message.style.display = "none";
                }, 3000);
            });
        </script>
    <?php endif; ?>
    <!-- page start -->
    <div class="page">

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
            <input type="email" name="email" class="email form-control" placeholder="Enter email">
        </p>
        <p class="prt-inputs">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" name="password" class="password form-control" placeholder="Enter password">
        </p>
        <p class="prt-inputs">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" name="comfirmpassword" class="password form-control" placeholder="Confirm password">
        </p>
        <p><button type="submit" class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white">Sign up now</button></p>
        <p class="mb-15">By sign up you agree to the <a href="#">‘terms & conditions’</a></p>
    </form>
    <ul class="social-icons model-social">
        <li><a target="black" href="https://www.facebook.com/preyantechnosys19" rel="noopener" aria-label="facebook"><i class="ti-facebook"></i></a></li>
        <li><a target="black" href="#" rel="noopener" aria-label="linkedin"><i class="ti-google"></i></a></li>
        <li><a target="black" href="https://twitter.com/PreyanTechnosys" rel="noopener" aria-label="twitter"><i class="flaticon flaticon-twitter"></i></a></li>
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
        <header id="masthead" class="header prt-header-style-01">
            <!-- topbar -->
            <div class="top_bar prt-topbar-wrapper clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="top_bar_contact_item">
                                <ul class="prt-list list-inline">
                                    <li><a href="mailto:info@example.com">wiseprice.com</a></li>
                                    
                               </ul>
                               <div class="top-media-block">
                                   
                                   <div class="top-link-block prt-signup-link">
                                        <button class="signupbtn prt-btn btn-inline" type="button" data-bs-toggle="modal" data-bs-target="#modal-signup"><i class="icon-user-o"></i> Sign up</button>
                                    </div>
                                   <ul class="social-icons topbar-social">
                                        <li><a target="black" href="https://www.facebook.com/preyantechnosys19" rel="noopener" aria-label="facebook"><i class="fontello icon-facebook"></i></a>
                                        </li>
                                        <li><a target="black" href="https://twitter.com/PreyanTechnosys" rel="noopener" aria-label="twitter"><i class="flaticon flaticon-twitter"></i></a>
                                        </li>
                                        <li><a target="black" href="https://www.linkedin.com/in/preyan-technosys-pvt-ltd/" rel="noopener" aria-label="linkedin"><i class="icon-linkedin"></i></a></li>
                                        <li><a target="black" href="https://dribbble.com/PreyanTechnosys" rel="noopener" aria-label="dribbble"><i class="fontello icon-dribbble"></i></a>
                                        </li>
                                    </ul>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- topbar end -->
            <!-- site-header-menu -->
            <div id="site-header-menu" class="site-header-menu">
                <div class="site-header-menu-inner prt-stickable-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="header-menu-wrapper d-flex align-items-center justify-content-between">
                                    <!--site-navigation -->
                                    <div class="site-navigation">
                                        <div class="sitemenu-main d-flex align-items-center justify-content-between">
                                            <!-- site-branding -->
                                            <div class="site-branding">
                                                <h1><a class="home-link" href="index.php" title="Autovis" rel="home">
                                                    <img id="logo-img" height="30" width="200" class="img-fluid auto_size" src="images/logo.svg" alt="logo-img">
                                                </a></h1>
                                            </div>
                                            <!-- site-branding end -->
                                            <!-- menu-link -->
                                            <div class="menu-link">
                                                <div class="btn-show-menu-mobile menubar menubar--squeeze">
                                                    <span class="menubar-box">
                                                        <span class="menubar-inner"></span>
                                                    </span>
                                                </div>
                                                <!-- menu -->
                                                <nav class="main-menu menu-mobile" id="menu">
                                                    <ul class="menu">
                                                        <li class="mega-menu-item "><a href="index.php" class="mega-menu-link">Home</a>
                                                        <li class="mega-menu-item "><a href="services.html" class="mega-menu-link">Services</a>
                                                        <li class="mega-menu-item "><a href="add-post.php" class="mega-menu-link">Add Post</a>
                                                        <li class="mega-menu-item "><a href="car-details.php" class="mega-menu-link">Car Details</a>    
                                                        <li class="mega-menu-item "><a href="about-us.html" class="mega-menu-link">About</a>
                                                        <li class="mega-menu-item active"><a href="contact-us.php" class="mega-menu-link">Contact</a>                  
                                                    </ul>
                                                </nav>
                                            </div>
                                            <!-- menu-link end-->
                                        </div>
                                    </div><!-- site-navigation end-->
                                    <!-- header_extra -->
                                    <div class="header_extra">
                                        <form>
                                            <div class="header-search">
                                                <input type="text" placeholder="Search car...." required>
                                                <button class="fa fa-search" type="submit"></button>
                                          </div>
                                        </form>
                                    </div>
                                    <!-- header_extra -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- site-header-menu end-->
        </header><!-- header end -->

        <!-- page-title -->
        <div class="prt-page-title-row style2">
            <div class="prt-page-title-row-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-12 m-auto">
                            <div class="prt-page-title-row-heading">
                                <div class="page-title-heading">
                                    <h2 class="title">Get in touch </h2>
                                </div>
                                <div class="page-title-desc mt-15 res-991-pl-0 res-991-pr-0 res-991-mt-20">
                                    <p>Rev up your inquiries! Contact us for a test drive or any car-related queries at Email or or Phone and Your dream car awaits</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
        <!-- page-title end-->
        
        <!-- site-main start -->
        <div class="site-main">

            <!-- contact-section -->
            <section class="prt-row prt-bg bg-base-lightgrey contact-section clearfix">
                <div class="container">
                    <div class="row row-equal-height">
                        <div class="col-xl-6 col-lg-12">
                            <div class="prt-bg prt-col-bgcolor-yes bg-base-grey prt-bg border-rad_15 overflow-hidden mr-10 res-1199-mr-0">
                                <div class="prt-col-wrapper-bg-layer prt-bg-layer bg-base-grey">
                                    <div class="prt-col-wrapper-bg-layer-inner"></div>
                                </div>
                                <div class="layer-content prt-contact-block">
                                <div id="comments_2" class="comments-area_2">
        <div class="comment-respond">
            <form method="post" id="contactform" class="comment-form_2" action="contact-us.php" novalidate="novalidate">
                <div class="response"></div>
                <p class="comment-form-author">
                    <input class="username" id="author" placeholder="Your name" name="name" type="text" value="" size="30" aria-required="true" required="required">
                </p>
                <p class="comment-form-email">
                    <input class="email" id="email" placeholder="Email (required)" name="email" type="email" value="" size="30" aria-required="true" required="required">
                </p>
                <p class="comment-form-number">
                    <input id="number" placeholder="Phone number" name="phone" type="text" value="" size="30" required="required">
                </p>
                <p class="comment-form-zipcode">
                    <input id="zipcode" placeholder="Zip code" name="zipcode" type="text" value="" size="6" required="required">
                </p>
                <p class="comment-form-comment">
                    <textarea class="message" id="comment" placeholder="Comment" name="message" cols="4" rows="5" aria-required="true" required="required"></textarea>
                </p>
                <p class="form-submit mt-30">
                    <button class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white" type="submit" id="submit" name="submit-form">Submit now!</button>
                    <span class="pl-30 text-base-white res-575-mt-10">Been here before? <a href="#" class="underline">Check your query</a></span>
                </p>
            </form>
        </div>
    </div>
                                    <div class="text-start mt-40">
                                        <h3>Share Info</h3>
                                        <ul class="social-icons contact-link">
                                            <li><a target="black" href="https://www.facebook.com/preyantechnosys19" rel="noopener" aria-label="facebook"><i class="fa fa-facebook"></i>Facebook</a></li>
                                            <li><a target="black" href="https://www.instagram.com/preyan_technosys/" rel="noopener" aria-label="instagram"><i class="fa fa-instagram"></i>Instagram</a></li>
                                            <li><a target="black" href="https://www.linkedin.com/in/preyan-technosys-pvt-ltd/" rel="noopener" aria-label="linkedin"><i class="fa fa-linkedin"></i>Linkedin</a></li>
                                            
                                            <li><a target="black" href="https://dribbble.com/PreyanTechnosys" rel="noopener" aria-label="dribbble"><i class="fa fa-dribbble"></i>Dribbble</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="border-rad_15 overflow-hidden ml-10 w-100 res-1199-ml-0 res-1199-mt-40">
                                <div id="google_map" class="google_map">
                                    <div class="map_container">
                                        <div id="map">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d162798.5129642327!2d-74.12438618380982!3d40.69560193061302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1705397282540!5m2!1sen!2sin" width="1920" height="590" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact-section end-->

            <!-- contact-faq-section -->
            <section class="prt-row contact-faq-section prt-contact-faq clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="prt-col-bgcolor-yes prt-bgcolor-dark prt-textcolor-white col-bg-img-one prt-col-bgimage-yes prt-bg" data-aos="fade-right" data-aos-duration="1500">
                                <div class="prt-col-wrapper-bg-layer prt-bg-layer bg-base-dark border-rad_20">
                                    <div class="prt-col-wrapper-bg-layer-inner bg-base-dark"></div>
                                </div>
                                <div class="layer-content">
                                    <div class="prt-contactfaq-sidebar">
                                        <span>Sale 25% Off!</span>
                                        <h3 class="widget-title">Luxury car interiors <br>All cars model</h3>
                                        <div class="prt-banner mt-25">
                                            <a class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white" href="about-us.html">Get a estimate</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <div class="accordion style3 res-991-mt-40" data-aos="fade-left" data-aos-duration="1500">
                                <!-- toggle -->
                                <div class="toggle prt-toggle_style_classic prt-control-right-true">
                                    <div class="toggle-title"><a class="active" href="#"> How often should i get my car serviced?</a></div>
                                    <div class="toggle-content show">
                                        <p>For optimal performance, aim for a routine car service every 6,000 to 8,000 miles or as per your vehicle's manual. Regular maintenance ensures longevity and reliability, keeping you confidently on the road</p>
                                    </div>
                                </div><!-- toggle end -->
                                <!-- toggle -->
                                <div class="toggle prt-toggle_style_classic prt-control-right-true">
                                    <div class="toggle-title"><a href="#">How often should i change my car's oil?</a></div>
                                    <div class="toggle-content">
                                        <p>For smooth engine performance, consider changing your car's oil every 3,000 to 5,000 miles, or follow your vehicle manufacturer's recommendations. regular oil changes are key to preserving engine health and maximizing fuel efficiency</p>
                                    </div>
                                </div><!-- toggle end -->
                                <!-- toggle -->
                                <div class="toggle prt-toggle_style_classic prt-control-right-true">
                                    <div class="toggle-title"><a href="#">What is the recommended tire pressure for my car?</a></div>
                                    <div class="toggle-content">
                                        <p>Maintain optimal tire performance by keeping your car's tire pressure within the recommended range, typically listed in your vehicle's manual or on the driver's side door jamb. regularly check and adjust the pressure to ensure a safe and fuel-efficient ride</p>
                                    </div>
                                </div><!-- toggle end -->
                                <!-- toggle -->
                                <div class="toggle prt-toggle_style_classic prt-control-right-true">
                                    <div class="toggle-title"><a href="#">Can i schedule a test drive for a specific model?</a></div>
                                    <div class="toggle-content">
                                        <p>Absolutely!  Schedule a test drive at your convenience to experience the thrill of driving your desired model. Contact us, and we'll arrange a personalized test drive to suit your preferences.</p>
                                    </div>
                                </div><!-- toggle end -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact-faq-section end -->

        </div><!-- site-main end-->

        <!-- footer start -->
        <footer class="footer widget-footer text-base-white overflow-hidden clearfix">
            <div class="second-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
                            <div class="pr-30 res-1199-pr-0">
                                <div class="footer-cta-wappper" data-aos="fade-up" data-aos-duration="1500">
                                    <span class="pretitle">Top brands 2023</span>
                                    <h2 class="title">New arrival audi sedan S23 car </h2>
                                    <p>Get 50% off selected items</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
                            <div class="row justify-content-between spacing-3 res-1199-mt-30">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="footer-widget-box res-575-mt-30">
                                        <h3 class="widget-title-h3">Our services</h3>
                                        <div class="footer-menu-links">
                                            <ul class="footer-menu-list">
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Browse used a car</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Auction car</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Browse offer</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Get in touch</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Prodge cars</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Sedan car</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="footer-widget-box res-575-mt-30">
                                        <h3 class="widget-title-h3">About company</h3>
                                        <div class="footer-menu-links">
                                            <ul class="footer-menu-list">
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">About us</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Return & exchange</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Refund policy</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Reviews</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">FAQ’s</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Contact us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="footer-widget-box res-767-mt-30">
                                        <h3 class="widget-title-h3">Cars by brands</h3>
                                        <div class="footer-menu-links">
                                            <ul class="footer-menu-list">
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">BMW</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Ferrari</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Mercedes</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Suzuki</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">TATA</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Toyota</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="footer-widget-box res-767-mt-30">
                                        <h3 class="widget-title-h3">Search & explore</h3>
                                        <div class="footer-menu-links">
                                            <ul class="footer-menu-list">
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Used cars</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">New cars</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Auction cars</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Sell my car</a></li>
                                                <li class="footer-menu-item"><a href="#" class="footer-menu-item-link">Shop now</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="bottom-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bottom-footer-border">
                                <div class="row prt-vertical_sep align-items-center">
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="row pr-30">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="prt-hotline-area">
                                                    <p>Call now <i class="flaticon flaticon-missed-call"></i> Available 24/7</p>
                                                    <a href="tel:1234567890" class="hotline-link">+1-800-356-8933</a>
                                                </div>
                                            </div> 
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="prt-hotline-area">
                                                    <p>Email us </p>
                                                    <a href="mailto:info@example.com" class="hotline-link">info@business.com</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="prt-hotline-area">
                                                    <p>Address</p>
                                                    <a href="https://www.google.com/" class="hotline-link">23 St, East Park Street</a>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 padding-right pr-0 res-1199-pr-15">
                                        <!-- Newsletter -->
                                        <div class="newsletter-form-main clearfix pl-55 res-1199-pl-0">
                                            <div class="widget-form">
                                                <form id="subscribe-form" class="newsletter-form" method="post" action="#" data-mailchimp="true">
                                                    <div class="mailchimp-inputbox clearfix" id="subscribe-content">
                                                        <p class="mb-5 margin-right"><input type="email" name="email" placeholder="Email us" required=""></p>
                                                        <button class="submit" type="submit">Send message</button>
                                                    </div>
                                                    <p class="cookies">
                                                        <input type="checkbox" name="cookies-consent" id="cookies-consent1">
                                                        <label for="cookies-consent1"></label>
                                                        You agree to our friendly <a href="#">Privacy Policy</a>
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="copyright ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="copyright-text">
                                <div class="cpy-text">
                                    <p>Copyright © 2024 
                                            <a href="https://themetechmount.com">ThemetechMount.</a> All rights reserved. powered by
                                        <a href="https://preyantechnosys.com/">PreyanTechnosys Pvt. Ltd.</a></p>
                                </div>
                                <ul class="footer-nav-menu">
                                    <li><a href="#"> Privacy policy </a></li>
                                    <li><a href="#"> Terms and conditions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
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

</body>
</html>