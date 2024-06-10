<?php
// session_start();
include 'config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle signup
    if (isset($_POST['signup'])) {
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['comfirmpassword'];

        if ($password === $confirm_password) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO customers (Name, Email, Password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            // Execute the query
            if ($stmt->execute()) {
                $message = "Customer record has been added successfully.";
            } else {
                $message = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "Passwords do not match.";
        }
    }

    // Handle login
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $redirect_url = isset($_POST['redirect']) ? $_POST['redirect'] : 'index.php';

        // Prepare and bind
        $stmt = $conn->prepare("SELECT Password FROM customers WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $email;
                header("Location: " . $redirect_url);
                exit;
            } else {
                $message = "Invalid password.";
            }
        } else {
            $message = "No user found with this email.";
        }

        $stmt->close();
    }
}

$conn->close();
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
                <h3 id="modal-loginLabel">Sign Up</h3>
                <p>Have an account?? <button class="signupbtn prt-btn btn-inline" type="button" data-bs-toggle="modal" data-bs-target="#modal-login">Log In</button></p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form class="signup-form" method="post" action="">
                            <?php if (isset($message) && isset($_POST['signup'])): ?>
                                <div id="message" class="alert alert-success"><?php echo $message; ?></div>
                            <?php endif; ?>
                            <p class="prt-inputs">
                                <i class="icon-user mt_3"></i>
                                <input type="text" name="username" class="username form-control" placeholder="Enter name" required>
                            </p>
                            <p class="prt-inputs">
                                <i class="ti-email"></i>
                                <input type="email" name="email" class="email form-control" placeholder="Enter email" required>
                            </p>
                            <p class="prt-inputs">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <input type="password" name="password" class="password form-control" placeholder="Enter password" required>
                            </p>
                            <p class="prt-inputs">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <input type="password" name="comfirmpassword" class="password form-control" placeholder="Confirm password" required>
                            </p>
                            <p>
                                <button type="submit" name="signup" class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white">Sign up now</button>
                            </p>
                            <p class="mb-15">By signing up you agree to the <a href="#">‘terms & conditions’</a></p>
                        </form>
                        <ul class="social-icons model-social mt-4">
                            <li><a target="_blank" href="https://www.facebook.com/preyantechnosys19" rel="noopener" aria-label="facebook"><i class="ti-facebook"></i></a></li>
                            <li><a target="_blank" href="#" rel="noopener" aria-label="linkedin"><i class="ti-google"></i></a></li>
                            <li><a target="_blank" href="https://twitter.com/PreyanTechnosys" rel="noopener" aria-label="twitter"><i class="flaticon flaticon-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
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
                    <form class="signup-form" method="POST" action="">
                    <input type="hidden" name="redirect" value="<?php echo htmlspecialchars(isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php'); ?>">
                            <p class="prt-inputs">
                                <i class="ti-email"></i>
                                <input type="email" name="email" class="email form-control" placeholder="Enter email" required>
                            </p>
                            <p class="prt-inputs">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <input type="password" name="password" class="password form-control" placeholder="Enter password" required>
                            </p>
                            <p class="cookies">
                                <span><input type="checkbox" name="cookies-consent" id="cookies-consent2">
                                <label for="cookies-consent2"></label>
                                Keep me signed in  
                                </span><a href="#">Lost your password?</a>
                            </p>
                            <p><button type="submit" name="login" class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white">Login</button></p>
                            <p class="mb-15">By signing up you agree to the <a href="#">‘terms & conditions’</a></p>
                        </form>
                        <ul class="social-icons model-social">
                            <li><a target="_blank" href="https://www.facebook.com/preyantechnosys19" rel="noopener" aria-label="facebook"><i class="ti-facebook"></i></a></li>
                            <li><a target="_blank" href="#" rel="noopener" aria-label="linkedin"><i class="ti-google"></i></a></li>
                            <li><a target="_blank" href="https://twitter.com/PreyanTechnosys" rel="noopener" aria-label="twitter"><i class="flaticon flaticon-twitter"></i></a></li>
                        </ul>
                        <?php
                        if ($message && isset($_POST['login'])) {
                            echo "<div class='alert alert-danger'>$message</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// Check if login is required and trigger the modal
// if (isset($_GET['login']) && $_GET['login'] == 'true') {
//     echo "<script>
//             document.addEventListener('DOMContentLoaded', function() {
//                 var loginModal = new bootstrap.Modal(document.getElementById('modal-login'));
//                 loginModal.show();
//             });
//           </script>";
// }
?>

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
                                        <li><a href="mailto:info@example.com">wiceprice.com</a></li>
                                       
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
                                                    <h1><a class="home-link" href="index.php" title="Qmoto" rel="home">
                                                        <img id="logo-img" height="30" width="100" class="img-fluid auto_size" src="images/logo.png" alt="logo-img">
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
                                                            <li class="mega-menu-item active"><a href="index.php" class="mega-menu-link">Home</a>
                                                            <li class="mega-menu-item "><a href="services.html" class="mega-menu-link">Services</a>
                                                            <li class="mega-menu-item "><a href="add-post.php" class="mega-menu-link">Add Post</a>
                                                            <li class="mega-menu-item "><a href="car-details.php" class="mega-menu-link">Car Details</a>    
                                                            <li class="mega-menu-item "><a href="about-us.html" class="mega-menu-link">About</a>
                                                            <li class="mega-menu-item "><a href="contact-us.php" class="mega-menu-link">Contact</a>                  
                                                        </ul>
                                                    </nav><!-- menu end -->
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

            <!-- START Slider 1 REVOLUTION SLIDER 6.5.9 --><p class="rs-p-wp-fix"></p>
            <rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery">
                <rs-module id="rev_slider_1_1"  data-version="6.5.9">
                    <rs-slides>

                        <rs-slide data-key="rs-1" data-title="Slide" data-thumb="images/slides/slider-mainbg-001.webp" data-anim="ei:d;eo:d;s:d;r:0;t:fade;sl:d;">

                            <img src="images/slides/slider-mainbg-001.webp" title="slider-img-01.webp" width="1920" height="890" class="rev-slidebg tp-rs-img" data-no-retina><!--

                                --><rs-layer
                                    id="slider-1-slide-1-layer-0" 
                                    class="rs-selectable"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:l,l,l,c;xo:15px,15px,15px,-40px;yo:275px,275px,120px,105px;"
                                    data-text="w:normal;s:115,115,65,40;l:125,125,75,46;fw:400;"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:12;font-family:'Anton', sans-serif; text-transform: uppercase;"
                                       
                                >Accurate Car  Price                        
                                </rs-layer><!--

                            
                                --><rs-layer
                                    id="slider-1-slide-1-layer-3" 
                                    class="rs-selectable"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:l,l,l,c;xo:15px,15px,15px,-65px;yo:405px,405px,210px,165px;"
                                    data-text="w:normal;s:104,104,65,40;l:114,114,65,46;fw:400;"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:13;font-family:'Anton', sans-serif; font-size:10px; text-transform: uppercase;"
                                >Predictions Instantly                          
                                </rs-layer><!--

                                

                                --><rs-layer
                                    id="slider-1-slide-1-layer-5" 
                                    class="rs-selectable"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:l,l,l,c;xo:15px,15px,0,0;yo:550px,550px,250px,180px;"
                                    data-text="w:normal;s:14,14,14,14;l:24,24,24,24;fw:400;"
                                    data-vbility="t,t,f,f"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:15;font-family:'Anton', sans-serif; text-transform: uppercase; letter-spacing: 0.6rem;"
                                ><span class="slider-text">Make your ride better </span>          
                                </rs-layer><!--

                                --><rs-layer
                                    id="slider-1-slide-1-layer-6" 
                                    class="rs-selectable"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:l,l,l,c;xo:15px,15px,15px,0;yo:605px,605px,295px,225px;"
                                    data-text="w:normal;s:18,18,18,18;l:28,28,28,28;fw:400;a:left,left,left,center;"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:16;font-family:'Urbanist', sans-serif"
                                >Explore the ultimate rental experience with<br> the best cars available today 
                                </rs-layer><!--

                                --><a
                                    id="slider-1-slide-1-layer-7" 
                                    class="rs-layer rs-selectable prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white"
                                    href="contact-us.html"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:l,l,l,c;xo:15px,15px,15px,0;yo:700px,700px,375px,295px;"
                                    data-text="w:normal;s:16,16,14,14;l:26,26,16,14;fw:400"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                >Contact us
                                </a><!--

                                --><rs-layer
                                    id="slider-1-slide-1-layer-8" 
                                    class="rs-selectable"
                                    data-type="image"
                                    data-rsp_ch="on"
                                    data-xy="x:r,r,r,c;xo:-280px,-280px,-200px,0;yo:235px,235px,150px,142px;"
                                    data-text="w:normal;s:20,20,12,7;l:0,0,15,9;"
                                    data-dim="w:1165,1165,682,1165;h:664px,664px,350px,664px;"
                                    data-vbility="t,t,t,f"
                                    data-frame_0="x:4%;"
                                    data-frame_0_mask="u:t;"
                                    data-frame_1="st:0;sp:1000;sR:0;"
                                    data-frame_1_mask="u:t;"
                                    data-frame_999="o:0;st:w;sR:7120;"
                                    style="z-index:0;"
                                ><img src="images/slides/img-01.webp" width="1165" height="664" alt="img"> 
                            </rs-layer><!--
                                
                            --><rs-layer
                                    id="slider-1-slide-1-layer-9" 
                                    class="rs-selectable banner-light-wrapper"
                                    data-type="image"
                                    data-rsp_ch="on"
                                     data-xy="x:r,r,c,c;xo:0px,0px,0,0;yo:500px,500px,111px,122px;"
                                    data-text="w:normal;s:20,20,12,7;l:0,0,15,9;"
                                    data-dim="w:857,857,877,877;h:216px,216px,236px,236px;"
                                    data-vbility="t,t,f,f"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:2900;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:10;object-fit: cover;"
                                ><img src="images/slides/car-light-01.webp" width="877" height="236" alt="img"> 
                                </rs-layer><!--
 
                        --></rs-slide>

                        <rs-slide data-key="rs-4" data-title="Slide" data-thumb="images/slides/sslider-mainbg-001.webp" data-anim="ei:d;eo:d;s:d;r:0;t:fade;sl:d;">

                            <img src="images/slides/slider-mainbg-002.webp" title="slider-img-02.webp" width="1920" height="890" class="rev-slidebg tp-rs-img" data-no-retina>
                            <!--

                                --><rs-layer
                                    id="slider-1-slide-4-layer-0" 
                                    class="rs-selectable"
                                    data-type="image"
                                    data-rsp_ch="on"
                                    data-xy="x:l,l,l,c;xo:-290px,-200px,-100,0;yo:0px,0px,0px,122px;"
                                    data-text="w:normal;s:20,20,12,7;l:0,0,15,9;"
                                    data-dim="w:1398,1398,850,1398;h:890px,890px,500px,890px;"
                                    data-vbility="t,t,t,f"
                                    data-frame_0="z:-50;"
                                    data-frame_0_mask="u:t;"
                                    data-frame_1="st:0;sp:1200;sR:0;"
                                    data-frame_1_mask="u:t;"
                                    data-frame_999="o:0;st:w;sR:2120;"
                                    style="z-index:9;object-fit: cover;"
                                ><img src="images/slides/img-02.webp" width="1398" height="890" alt="img"> 
                                </rs-layer><!--

                                --><rs-layer
                                    id="slider-1-slide-4-layer-1" 
                                    class="rs-selectable"
                                    data-type="image"
                                    data-rsp_ch="on"
                                     data-xy="x:l,l,c,c;xo:-280px,-185px,0,0;yo:440px,440px,111px,122px;"
                                    data-text="w:normal;s:20,20,12,7;l:0,0,15,9;"
                                    data-dim="w:974,974,974,974;h:210px,210px,210px,210px;"
                                    data-vbility="t,t,f,f"
                                    data-frame_0="z:-50;"
                                    data-frame_0_mask="u:t;"
                                    data-frame_1="st:0;sp:2900;sR:0;"
                                    data-frame_1_mask="u:t;"
                                    data-frame_999="o:0;st:w;sR:0;"
                                    style="z-index:10;object-fit: cover;"
                                ><img src="images/slides/car-light-02.webp" width="1004" height="226" alt="img"> 
                                </rs-layer><!--

                                --><rs-layer
                                    id="slider-1-slide-4-layer-2" 
                                    class="rs-selectable"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:r,r,r,c;xo:463px,463px,15px,0;yo:280px,280px,145px,120px;"
                                    data-text="w:normal;s:50,50,40,40;l:60,60,50,46;fw:400;"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:11;font-family:'Anton', sans-serif; text-transform: uppercase;"
                                >Get the                             
                                </rs-layer><!--

                                --><rs-layer
                                    id="slider-1-slide-4-layer-3" 
                                    class="rs-selectable"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:r,r,r,c;xo:295px,295px,150px,-55px;yo:350px,350px,215px,183;"
                                    data-text="w:normal;s:180,180,40,40;l:190,190,50,46;fw:400;"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:12;font-family:'Anton', sans-serif; text-transform: uppercase;"
                                >BEST                           
                                </rs-layer><!--

                                --><rs-layer
                                    id="slider-1-slide-4-layer-4" 
                                    class="rs-selectable"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:r,r,r,c;xo:75px,75px,15px,55px;yo:400px,400px,215px,183;"
                                    data-text="w:normal;s:80,80,40,40;l:90,90,50,46;fw:400;"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:13;font-family:'Anton', sans-serif; text-transform: uppercase;"
                                ><span class="slider-text-2">Cars </span>                         
                                </rs-layer><!--

                                --><rs-layer
                                    id="slider-1-slide-4-layer-5" 
                                    class="rs-selectable"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:r,r,r,c;xo:164px,164px,15px,0;yo:548px,548px,300px,245px;"
                                    data-text="w:normal;s:80,80,50,40;l:90,90,50,46;fw:400;"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:14;font-family:'Anton', sans-serif; text-transform: uppercase;"
                                >For Buy Today                          
                                </rs-layer><!--

                               --><a
                                    id="slider-1-slide-4-layer-6" 
                                    class="rs-layer rs-selectable prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white"
                                    href="about-us.html"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:r,r,r,c;xo:446px,446px,15px,0;yo:677px,677px,375px,305px;"
                                    data-text="w:normal;s:16,16,16,16;l:26,26,26,16;fw:400"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:15;"
                                >View more
                                </a><!--   

                                --><rs-layer
                                    id="slider-1-slide-4-layer-7" 
                                    class="rs-selectable"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:r,r,c,c;xo:-110px,-110px,0,0;yo:452px,452px,170px,136px;"
                                    data-text="w:normal;s:50,50,65,40;l:60,60,75,46;fw:400;"
                                    data-vbility="t,f,f,f"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:16;font-family:'Anton', sans-serif; text-transform: uppercase;"
                                ><span class="slider-offter-text">50%</span>               
                                </rs-layer><!-- 

                                --><rs-layer
                                    id="slider-1-slide-4-layer-8" 
                                    class="rs-selectable"
                                    data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:r,r,c,c;xo:-100px,-100px,0,0;yo:414px,414px,170px,136px;"
                                    data-text="w:normal;s:40,40,65,40;l:50,50,75,46;fw:400;"
                                    data-vbility="t,f,f,f"
                                    data-frame_0="sX:0.9;sY:0.9;"
                                    data-frame_1="e:power2.inOut;sp:1000;"
                                    data-frame_999="o:0;st:w;"
                                    style="z-index:17;font-family:'Anton', sans-serif; text-transform: uppercase;"
                                ><span class="slider-offter-text-2">OFF</span>               
                                </rs-layer><!--                            

                    --></rs-slide>
                        
                    </rs-slides>
                </rs-module>
            </rs-module-wrap>
            <!-- END REVOLUTION SLIDER -->

        </div>
        
        <!-- site-main start -->
        <div class="site-main">

            <!-- category-section -->
            <section class="prt-row category-section clearfix">
                <div class="container">
                    <div class="row" data-aos="fade-up" data-aos-duration="1500">
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-01.svg" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-01.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-02.svg" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-02.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-03.svg" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-03.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-04.svg" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-01.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-05.svg" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-02.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-06.svg" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-03.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-07.png" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-01.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-08.png" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-02.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-09.png" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-03.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-10.png" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-01.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-11.svg" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-02.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4">
                            <!-- featured-imagebox-category -->
                            <a href="listing.php">
                                <div class="featured-imagebox featured-imagebox-category">
                                    <div class="featured-category-icon">
                                        <img width="50" height="50" class="img-fluid" src="images/category/icon-12.png" alt="icon">
                                    </div>
                                    <div class="featured-thumbnail">
                                        <img width="99" height="44" class="img-fluid" src="images/category/car-img-03.svg" alt="icon">
                                    </div>
                                </div>
                            </a>
                            <!-- featured-imagebox-category end -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="category-text text-center mt-20">
                                <a
                                id="slider-1-slide-1-layer-7" 
                                class="rs-layer rs-selectable prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white"
                                href="services.html"
                                data-type="text"
                                data-rsp_ch="on"
                                data-xy="x:l,l,l,c;xo:15px,15px,15px,0;yo:700px,700px,375px,295px;"
                                data-text="w:normal;s:16,16,14,14;l:26,26,16,14;fw:400"
                                data-frame_0="sX:0.9;sY:0.9;"
                                data-frame_1="e:power2.inOut;sp:1000;"
                                data-frame_999="o:0;st:w;"
                            >Services
                            </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
            <!-- category-section end-->

            <!-- service-section -->
            <section class="prt-row service-section padding_top_zero-section animation clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-12">
                            <div class="section-title">
                                <div class="title-header">
                                    <h2 class="title">Our services</h2>
                                    <div class="title-overlay" data-aos="fade-up" data-aos-duration="1500"> How it work</div>
                                </div>
                                <div class="title-desc">
                                    <p>Streamlined the car process by the efficiency from selection to ownership satisfaction</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-12">
                            <div class="pl-60 res-1199-pl-0" data-aos="fade-left" data-aos-duration="1500">
                                <div class="row row-equal-height prt-boxes-spacing-10px">
                                    <div class="col-lg-6 col-md-6 col-sm-12 prt-box-col-wrapper">
                                        <!--featured-icon-box-->
                                        <div class="featured-icon-box icon-align-top-content style1">
                                            <div class="featured-icon">
                                                <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-color-whitecolor prt-icon_element-size-lg">
                                                    <i class="flaticon flaticon-brand"></i>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3><a href="services.html">Wide range of brands</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Diverse selection with wide range of reputable brands</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--featured-icon-box end-->
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 prt-box-col-wrapper">
                                        <!--featured-icon-box-->
                                        <div class="featured-icon-box icon-align-top-content style1">
                                            <div class="featured-icon">
                                                <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-color-whitecolor prt-icon_element-size-lg">
                                                    <i class="flaticon flaticon-public-relation"></i>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3><a href="services.html">Trusted clients</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>A confidence in service and trusted by clients</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--featured-icon-box end-->
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 prt-box-col-wrapper">
                                        <!--featured-icon-box-->
                                        <div class="featured-icon-box icon-align-top-content style1">
                                            <div class="featured-icon">
                                                <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-color-whitecolor prt-icon_element-size-lg">
                                                    <i class="flaticon flaticon-hand"></i>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3><a href="services.html">Easy finance</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Simplify ownership with easy, accessible financing</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--featured-icon-box end-->
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 prt-box-col-wrapper">
                                        <!--featured-icon-box-->
                                        <div class="featured-icon-box icon-align-top-content style1">
                                            <div class="featured-icon">
                                                <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-color-whitecolor prt-icon_element-size-lg">
                                                    <i class="flaticon flaticon-rating"></i>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3><a href="services.html">Easy insurance</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Seamless coverage and simplify with easy insurance</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--featured-icon-box end-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="service-single-image ml_310 mt_60 res-1199-mt-30 res-991-ml_15">
                                <!-- prt_single_image-wrapper -->
                                <div class="prt_single_image-wrapper" data-aos="fade-right" data-aos-duration="1500">
                                    <img width="1121" height="460" class="img-fluid" src="images/single-img-01.webp" alt="image">
                                    <div class="prt-light-wrapper">
                                        <img width="835" height="263" class="img-fluid" src="images/car-focus-01.webp" alt="image">
                                    </div>
                                </div>
                                <!-- prt_single_image-wrapper end-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- service-section end -->

            <!-- cardetails-section -->
            <section class="prt-row prt-bg bg-base-lightgrey cardetails-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title title-style-center_text">
                                <div class="title-header">
                                    <h2 class="title">Most searched used car</h2>
                                    <div class="title-overlay style2" data-aos="fade-up" data-aos-duration="1500">Our vehicles</div>
                                </div>
                                <div class="title-desc style2">
                                    <p>We can help with your financing plan, we can offer some </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="swiper-container-wrapper-main mt-20 res-767-pt-0 res-767-mt-0">
                                <div class="swiper-overlay-box box-1" data-aos="zoom-in" data-aos-duration="1500"></div>
                                <div class="swiper-overlay-box box-2" data-aos="zoom-in" data-aos-duration="1500"></div>
                                <div class="swiper-overlay-box box-3" data-aos="zoom-in" data-aos-duration="1500"></div>
                                <div class="swiper-overlay-box box-4" data-aos="zoom-in" data-aos-duration="1500"></div>
                                <div class="swiper-container-wrapper">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <!-- swiper-slide -->
                                            <div class="swiper-slide">
                                                <div class="prt-cardetails-wrapper">
                                                    <div class="prt-header-content">
                                                        <div class="prt-header">
                                                            <h3 class="title"><a href="car-details.html">Ferrari portofino 2023</a></h3>
                                                            <ul class="prt-list prt-rating-list">
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prt-body-content position-relative pt-40">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <p>8.8 kmpl speed automatic<br>2.5 liter 4-cylinder 204 HP </p>
                                                                <ul class="prt-list prt-cardeatils-list">
                                                                    <li><span>Stock#:</span> KU680564</li>
                                                                    <li><span>Model#:</span> Portofino M</li>
                                                                    <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                </ul>
                                                                <div class="prt-car-price">$920,000</div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="swiper-slide-image" data-aos="zoom-in" data-aos-duration="1500">
                                                                    <img width="637" height="289" class="img-fluid" src="images/car-image/img-01.webp" alt="image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- swiper-slide end -->
                                            <!-- swiper-slide -->
                                            <div class="swiper-slide">
                                                <div class="prt-cardetails-wrapper">
                                                    <div class="prt-header-content">
                                                        <div class="prt-header">
                                                            <h3 class="title"><a href="car-details.html">Mercedes-Benz C-Class-2023</a></h3>
                                                            <ul class="prt-list prt-rating-list">
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prt-body-content position-relative pt-40">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <p>2500 miles speed <br>2.5 liter 4-cylinder 204 HP </p>
                                                                <ul class="prt-list prt-cardeatils-list">
                                                                    <li><span>Stock#:</span> KU680564</li>
                                                                    <li><span>Model#:</span> 2532</li>
                                                                    <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                </ul>
                                                                <div class="prt-car-price">$24,500</div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="swiper-slide-image">
                                                                    <img width="637" height="289" class="img-fluid" src="images/car-image/img-02.webp" alt="image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- swiper-slide end -->
                                            <!-- swiper-slide -->
                                            <div class="swiper-slide">
                                                <div class="prt-cardetails-wrapper">
                                                    <div class="prt-header-content">
                                                        <div class="prt-header">
                                                            <h3 class="title"><a href="car-details.html">BMW 8-Series 2-door</a></h3>
                                                            <ul class="prt-list prt-rating-list">
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                                <li><i class="icon icon-star-empty-1"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prt-body-content position-relative pt-40">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <p>6-speed automatic <br>2.2 liter 4-cylinder 204 HP </p>
                                                                <ul class="prt-list prt-cardeatils-list">
                                                                    <li><span>Stock#:</span> KU680564</li>
                                                                    <li><span>Model#:</span> 2532</li>
                                                                    <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                </ul>
                                                                <div class="prt-car-price">$62,000</div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="swiper-slide-image">
                                                                    <img width="880" height="528" class="img-fluid" src="images/car-image/img-03.webp" alt="image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- swiper-slide end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- cardetails-section end-->

            <!-- about-section -->
            <section class="prt-row prt-bg prt-bgimage-yes bg-img1 about-section overflow-hidden animation clearfix">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-12">
                            <div class="section-title">
                                <div class="title-header">
                                    <h2 class="title">Why choose us</h2>
                                    <div class="title-overlay" data-aos="fade-up" data-aos-duration="1500">Car dealer</div>
                                </div>
                                <div class="title-desc">
                                    <p>Choose us for a seamless car-buying journey where expertise <br>meets trust. our commitment</p>
                                </div>
                            </div>
                            <div class="row align-items-center position-relative">
                                <div class="col-lg-5 col-md-12">
                                    <!--featured-content-box-->
                                    <div class="featured-content-box style1">
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3>Large deep shoulder lines</h3>
                                            </div>
                                            <div class="featured-desc">
                                                <p>Enhanced safety, stability ourtires with deep shoulder lines deliver.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--featured-content-box end-->
                                    <!--featured-content-box-->
                                    <div class="featured-content-box style1">
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3>Special tread compound</h3>
                                            </div>
                                            <div class="featured-desc">
                                                <p>Our tires excel a special compound, superior performance</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--featured-content-box end-->
                                    <!--featured-content-box-->
                                    <div class="featured-content-box style1">
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3>Massive block geometry</h3>
                                            </div>
                                            <div class="featured-desc">
                                                <p>Off-road mastery with massive blocks for exceptional traction</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--featured-content-box end-->
                                </div>
                                <div class="col-lg-7 col-md-12">
                                    <!-- prt_single_image-wrapper -->
                                    <div class="about-single-image position-relative" data-aos="zoom-in" data-aos-duration="1500">
                                        <div class="prt_single_image-wrapper">
                                            <img width="457" height="493" class="img-fluid" src="images/single-img-02.webp" alt="image">
                                        </div>
                                        <div class="single_image-overlay">
                                            <img width="400" height="124" class="img-fluid" src="images/single-img-02-overlay.webp" alt="image">
                                        </div>
                                        <div class="shap-image-wrapper shap-item01">
                                            <img width="226" height="41" class="img-fluid" src="images/shap-01.webp" alt="image">
                                        </div>
                                        <div class="shap-image-wrapper shap-item02">
                                            <img width="176" height="44" class="img-fluid" src="images/shap-02.webp" alt="image">
                                        </div>
                                        <div class="shap-image-wrapper shap-item03">
                                            <img width="133" height="35" class="img-fluid" src="images/shap-03.webp" alt="image">
                                        </div>
                                    </div>
                                    <!-- prt_single_image-wrapper end-->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-12">
                            <div class="row row-equal-height pl-40 res-1199-pl-0 res-991-mt-30">
                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="400">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-top-content style2">
                                        <div class="featured-icon">
                                            <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-color-whitecolor prt-icon_element-size-lg">
                                                <i class="flaticon flaticon-money-saving"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3><a href="about-us.html">Save on your next trip</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--featured-icon-box end-->
                                </div>
                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="800">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-top-content style2">
                                        <div class="featured-icon">
                                            <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-color-whitecolor prt-icon_element-size-lg">
                                                <i class="flaticon flaticon-tyre"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3><a href="services.html">Quality tyres for any season</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--featured-icon-box end-->
                                </div>
                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="1200">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-top-content style2">
                                        <div class="featured-icon">
                                            <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-color-whitecolor prt-icon_element-size-lg">
                                                <i class="flaticon flaticon-fuel"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3><a href="services.html">Free fuel for new clients</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--featured-icon-box end-->
                                </div>
                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="1600">
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-top-content style2">
                                        <div class="featured-icon">
                                            <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-color-whitecolor prt-icon_element-size-lg">
                                                <i class="flaticon flaticon-rating"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3><a href="contact-us.html">Customers ratings</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--featured-icon-box end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- about-section end-->

            <section class="prt-row prt-bg bg-base-grey prt-bgimage-yes bg-img2 testimonial-section clearfix">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- slick_slider -->
                            <div class="testimonial-main slick_slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows":false, "dots":false, "autoplay":true, "infinite":true, "responsive": [{"breakpoint":1199,"settings":{"slidesToShow": 1,"arrows":false,"autoplay":false}}, {"breakpoint":778,"settings":{"slidesToShow": 1,"arrows":false}}, {"breakpoint":611,"settings":{"slidesToShow": 1}}]}'>
                                <!-- testimonials -->
                                <div class="testimonials prt-testimonial-box style1">
                                    <div class="testimonial-avatar">
                                        <div class="testimonial-img" data-aos="zoom-in" data-aos-duration="1500">
                                            <img width="315" height="283" class="img-fluid" src="images/testimonial/testimonial-01.webp" alt="testimonial-img">
                                        </div>
                                    </div> 
                                    <div class="testimonial-content">
                                        <blockquote class="testimonial-text">"Fantastic service, found my perfect car. smooth process. Highly recommend this dealership to everyone!"</blockquote>
                                        <div class="testimonial-caption">
                                            <h3>Alex martin <span>- CEO founder</span></h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- testimonials end -->
                                <!-- testimonials -->
                                <div class="testimonials prt-testimonial-box style1">
                                    <div class="testimonial-avatar">
                                        <div class="testimonial-img" data-aos="zoom-in" data-aos-duration="1500">
                                            <img width="315" height="283" class="img-fluid" src="images/testimonial/testimonial-02.webp" alt="testimonial-img">
                                        </div>
                                    </div> 
                                    <div class="testimonial-content">
                                        <blockquote class="testimonial-text">"Excellent selection, friendly staff, hassle-free process. Couldn’t be happier with my purchase. Highly recommended."</blockquote>
                                        <div class="testimonial-caption">
                                            <h3>Nathan felix <span>- Manager & director</span></h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- testimonials end -->
                                <!-- testimonials -->
                                <div class="testimonials prt-testimonial-box style1">
                                    <div class="testimonial-avatar">
                                        <div class="testimonial-img" data-aos="zoom-in" data-aos-duration="1500">
                                            <img width="315" height="283" class="img-fluid" src="images/testimonial/testimonial-09.webp" alt="testimonial-img">
                                        </div>
                                    </div> 
                                    <div class="testimonial-content">
                                        <blockquote class="testimonial-text">"Exceptional customer service, transparent pricing, smooth transaction. Highly recommend this dealership"</blockquote>
                                        <div class="testimonial-caption">
                                            <h3>Lexamay cruz <span>- Manager</span></h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- testimonials end -->
                            </div>
                        </div>
                    </div><!-- row end -->
                </div>
            </section>
            <!--testimonial-section end-->

            <!-- recentcar-section -->
            <section class="prt-row recentcar-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title">
                                <div class="title-header">
                                    <h2 class="title">Recent launched car</h2>
                                    <div class="title-overlay" data-aos="fade-up" data-aos-duration="1500">Recent car</div>
                                </div>
                                <div class="title-desc">
                                    <p>We can help with your financing plan, we can offer some tips<br> and tricks. Drive off with this loremque laudantium </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="swiper-container-wrapper-main res-767-pt-0">
                                <!-- swiper-overlay -->
                                <div class="swiper-overlay-box box-1" data-aos="zoom-in" data-aos-duration="1500"></div>
                                <div class="swiper-overlay-box box-2" data-aos="zoom-in" data-aos-duration="1500"></div>
                                <div class="swiper-overlay-box box-3" data-aos="zoom-in" data-aos-duration="1500"></div>
                                <div class="swiper-overlay-box box-4" data-aos="zoom-in" data-aos-duration="1500"></div>
                                <!-- swiper-overlay end -->
                                <!-- prt-tabs -->
                                <div class="prt-tabs prt-tab-style-01">
                                    <ul class="tabs">
                                        <li class="tab active"><a href="#">Auction car</a></li>
                                        <li class="tab"><a href="#">New car</a></li>
                                        <li class="tab"><a href="#">Used car</a></li>
                                    </ul>
                                    <div class="content-tab res-1199-mt-30">
                                        <!-- content-inner -->
                                        <div class="content-inner active">
                                            <div class="swiper-container-wrapper">
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">Mercedes-benz c-class-2023</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                                            <p>2500 miles speed <br>2.5 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$24,500</div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                                            <div class="swiper-slide-image" data-aos="zoom-in" data-aos-duration="1500">
                                                                                <img width="637" height="289" class="img-fluid" src="images/car-image/img-02.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">Ferrari portofino 2023</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                                            <p>8.8 kmpl speed automatic<br>2.5 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> Portofino M</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$920,000</div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="637" height="289" class="img-fluid" src="images/car-image/img-01.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">BMW 8-series 2-door</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                                            <p>6-speed automatic <br>2.2 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$62,000</div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="880" height="528" class="img-fluid" src="images/car-image/img-03.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- content-inner end-->
                                        <!-- content-inner -->
                                        <div class="content-inner">
                                            <div class="swiper-container-wrapper">
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">BMW 8-Series 2-door coupe blue</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="prt-preview-car">
                                                                        <a href="images/comparecar/img-01.webp" rel="noopener" aria-label="image" target="_self" class="prt_prettyphoto">
                                                                            <i class="flaticon flaticon-gallery"></i> <span class="prt-view-num">1</span>
                                                                        </a>
                                                                        <a href="#"><span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></a>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                                            <p>6-speed automatic <br>2.2 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$62,000</div>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-7 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="880" height="528" class="img-fluid" src="images/car-image/img-03.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end-->
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">BMW 8-series 2-door coupe grey</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="prt-preview-car">
                                                                        <a href="images/comparecar/img-03.webp" rel="noopener" aria-label="image" target="_self" class="prt_prettyphoto">
                                                                            <i class="flaticon flaticon-gallery"></i> <span class="prt-view-num">1</span>
                                                                        </a>
                                                                        <a href="#"><span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></a>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                                            <p>8-Speed automatic <br>2.5 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$62,000</div>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-7 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="651" height="345" class="img-fluid" src="images/car-image/img-06.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">Subaru mini jumbo</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="prt-preview-car">
                                                                        <a href="images/comparecar/img-01.webp" rel="noopener" aria-label="image" target="_self" class="prt_prettyphoto">
                                                                            <i class="flaticon flaticon-gallery"></i> <span class="prt-view-num">1</span>
                                                                        </a>
                                                                        <a href="#"><span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></a>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                                            <p>6-Speed Automatic <br>2.5 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$25,000</div>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-7 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="637" height="289" class="img-fluid" src="images/car-image/img-07.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">Nissan altima-2022</a> </h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="prt-preview-car">
                                                                        <a href="images/comparecar/img-02.webp" rel="noopener" aria-label="image" target="_self" class="prt_prettyphoto">
                                                                            <i class="flaticon flaticon-gallery"></i> <span class="prt-view-num">1</span>
                                                                        </a>
                                                                        <a href="#"><span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></a>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                                            <p>8-Speed automatic <br>2.5 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$50,000</div>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-7 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="637" height="289" class="img-fluid" src="images/car-image/img-04.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">BMW 8-Series 2-door coupe grey</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="prt-preview-car">
                                                                        <a href="images/comparecar/img-03.webp" rel="noopener" aria-label="image" target="_self" class="prt_prettyphoto">
                                                                            <i class="flaticon flaticon-gallery"></i> <span class="prt-view-num">1</span>
                                                                        </a>
                                                                        <a href="#"><span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></a>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                                            <p>8-Speed automatic <br>2.5 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$62,000</div>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-7 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="637" height="289" class="img-fluid" src="images/car-image/img-01.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- content-inner end-->
                                        <!-- content-inner -->
                                        <div class="content-inner">
                                            <div class="swiper-container-wrapper">
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">Ferrari portofino 202</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="prt-preview-car">
                                                                        <a href="images/comparecar/img-04.webp" rel="noopener" aria-label="image" target="_self" class="prt_prettyphoto">
                                                                            <i class="flaticon flaticon-gallery"></i> <span class="prt-view-num">1</span>
                                                                        </a>
                                                                        <a href="#"><span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></a>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                                            <p>8.8 kmpl speed automatic<br>2.5 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> Portofino M</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$920,000</div>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-7 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="637" height="289" class="img-fluid" src="images/car-image/img-09.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">Mercedes-Benz C-Class-2023</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="prt-preview-car">
                                                                        <a href="images/comparecar/img-04.webp" rel="noopener" aria-label="image" target="_self" class="prt_prettyphoto">
                                                                            <i class="flaticon flaticon-gallery"></i> <span class="prt-view-num">1</span>
                                                                        </a>
                                                                        <a href="#"><span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></a>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                                            <p>2500 miles speed <br>2.5 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$24,500</div>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-7 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="637" height="289" class="img-fluid" src="images/car-image/img-02.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">BMW 8-Series 2-door coupe blue</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="prt-preview-car">
                                                                        <a href="images/comparecar/img-05.webp" rel="noopener" aria-label="image" target="_self" class="prt_prettyphoto">
                                                                            <i class="flaticon flaticon-gallery"></i> <span class="prt-view-num">1</span>
                                                                        </a>
                                                                        <a href="#"><span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></a>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                                            <p>6-speed automatic <br>2.2 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$62,000</div>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-7 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="880" height="528" class="img-fluid" src="images/car-image/img-03.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">Nissan altima-2022 </a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="prt-preview-car">
                                                                        <a href="images/comparecar/img-06.webp" rel="noopener" aria-label="image" target="_self" class="prt_prettyphoto">
                                                                            <i class="flaticon flaticon-gallery"></i> <span class="prt-view-num">1</span>
                                                                        </a>
                                                                        <a href="#"><span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></a>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                                            <p>8-Speed automatic <br>2.5 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$50,000</div>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-7 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="637" height="289" class="img-fluid" src="images/car-image/img-04.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                        <!-- swiper-slide -->
                                                        <div class="swiper-slide">
                                                            <div class="prt-cardetails-wrapper">
                                                                <div class="prt-header-content">
                                                                    <div class="prt-header">
                                                                        <h3 class="title"><a href="car-details.html">Subaru mini jumbo</a></h3>
                                                                        <ul class="prt-list prt-rating-list">
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                            <li><i class="icon icon-star-empty-1"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="prt-preview-car">
                                                                        <a href="images/comparecar/img-01.webp" rel="noopener" aria-label="image" target="_self" class="prt_prettyphoto">
                                                                            <i class="flaticon flaticon-gallery"></i> <span class="prt-view-num">1</span>
                                                                        </a>
                                                                        <a href="#"><span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></a>
                                                                    </div>
                                                                </div>
                                                                <div class="prt-body-content position-relative pt-40">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                                            <p>6-Speed automatic <br>2.5 liter 4-cylinder 204 HP </p>
                                                                            <ul class="prt-list prt-cardeatils-list">
                                                                                <li><span>Stock#:</span> KU680564</li>
                                                                                <li><span>Model#:</span> 2532</li>
                                                                                <li><span>Vin#:</span> 4T1B11HK1KU680564</li>
                                                                            </ul>
                                                                            <div class="prt-car-price">$25,000</div>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-7 col-sm-12">
                                                                            <div class="swiper-slide-image">
                                                                                <img width="637" height="289" class="img-fluid" src="images/car-image/img-05.webp" alt="image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- swiper-slide end -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- content-inner end-->
                                    </div>
                                </div>
                                <!-- prt-tabs end -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- recentcar-section end-->

            <!--comparecar-section-->
            <section class="prt-row prt-bg bg-base-lightgrey comparecar-section clearfix">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title title-style-center_text">
                                <div class="title-header">
                                    <h2 class="title">Compare car with brand</h2>
                                    <div class="title-overlay style2" data-aos="fade-up" data-aos-duration="1500">Compare car</div>
                                </div>
                                <div class="title-desc style2">
                                    <p>We can help with your financing plan, we can offer some </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                    <!-- row -->
                    <div class="row row-equal-height">
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="600">
                            <!-- compare-card -->
                            <div class="featured-compare-card">
                                <div class="featured-imagebox featured-imagebox-comparecar">
                                    <!-- prt-single-car -->
                                    <div class="prt-single-car">
                                        <div class="featured-thumbnail">
                                            <img width="155" height="80" class="img-fluid" src="images/comparecar/img-01.webp" alt="image">
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <span class="car-category">Tesla</span>
                                                <h3 class="title"><a href="car-details.html">Tesla model<br> X-2022</a></h3>
                                                <p class="price">$50,467</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- prt-single-car end -->
                                    <div class="vs"><span>VS</span></div>
                                    <!-- prt-single-car -->
                                    <div class="prt-single-car">
                                        <div class="featured-thumbnail">
                                            <img width="155" height="80" class="img-fluid" src="images/comparecar/img-02.webp" alt="image">
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <span class="car-category">Tesla</span>
                                                <h3 class="title"><a href="car-details.html">Tesla model 3<br>2023</a></h3>
                                                <p class="price">$55,345</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- prt-single-car end -->
                                </div>
                                <div class="compare-card-btn">
                                    <a class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white" href="special-offer.html">View all car</a>
                                </div>
                            </div>
                            <!-- compare-card end -->
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="1000">
                            <!-- compare-card -->
                            <div class="featured-compare-card">
                                <div class="featured-imagebox featured-imagebox-comparecar">
                                    <!-- prt-single-car -->
                                    <div class="prt-single-car">
                                        <div class="featured-thumbnail">
                                            <img width="155" height="80" class="img-fluid" src="images/comparecar/img-03.webp" alt="image">
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <span class="car-category">Toyota</span>
                                                <h3 class="title"><a href="car-details.html">Toyota 86<br> 2-door</a></h3>
                                                <p class="price">$79,854</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- prt-single-car end -->
                                    <div class="vs"><span>VS</span></div>
                                    <!-- prt-single-car -->
                                    <div class="prt-single-car">
                                        <div class="featured-thumbnail">
                                            <img width="155" height="80" class="img-fluid" src="images/comparecar/img-04.webp" alt="image">
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <span class="car-category">Toyota</span>
                                                <h3 class="title"><a href="car-details.html">Toyota prius<br> 2-door</a></h3>
                                                <p class="price">$82,154</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- prt-single-car end -->
                                </div>
                                <div class="compare-card-btn">
                                    <a class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white" href="special-offer.html">View all car</a>
                                </div>
                            </div>
                            <!-- compare-card end -->
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="1400">
                            <!-- compare-card -->
                            <div class="featured-compare-card">
                                <div class="featured-imagebox featured-imagebox-comparecar">
                                    <!-- prt-single-car -->
                                    <div class="prt-single-car">
                                        <div class="featured-thumbnail">
                                            <img width="155" height="80" class="img-fluid" src="images/comparecar/img-05.webp" alt="image">
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <span class="car-category">Ferrari</span>
                                                <h3 class="title"><a href="car-details.html">Ferrari superfast-2023</a></h3>
                                                <p class="price">$33,345</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- prt-single-car end -->
                                    <div class="vs"><span>VS</span></div>
                                    <!-- prt-single-car -->
                                    <div class="prt-single-car">
                                        <div class="featured-thumbnail">
                                            <img width="155" height="80" class="img-fluid" src="images/comparecar/img-06.webp" alt="image">
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <span class="car-category">Ferrari</span>
                                                <h3 class="title"><a href="car-details.html">Ferrari roma <br>2022</a></h3>
                                                <p class="price">$57,656.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- prt-single-car end -->
                                </div>
                                <div class="compare-card-btn">
                                    <a class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white" href="special-offer.html">View all car</a>
                                </div>
                            </div>
                            <!-- compare-card end -->
                        </div>
                    </div>
                     <!-- row end -->
                </div>
            </section>
            <!-- comparecar-section end -->

            <!-- cta-section -->
            <section class="prt-row cta-section clearfix">
                <div class="container">
                    <!-- row -->
                    <div class="row row-equal-height">
                        <div class="col-xl-6 col-lg-12" data-aos="fade-right" data-aos-duration="1500">
                            <div class="prt-cta-wrapper bg-base-secondskin spacing-2">
                                <div class="prt-cta-content-wrapper">
                                    <div class="prt-cta-title">
                                        <h2>Download our app</h2>
                                    </div>
                                    <div class="prt-cta-btn cta-add-btn mt-25 res-575-mt-10">
                                        <a class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white" href="https://themetechmount.com/"><img width="21" height="24" class="img-fluid" src="images/icon-02.svg" alt="image"> For iOS</a><br>
                                        <a class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white mt-15" href="https://themetechmount.com/"><img width="21" height="24" class="img-fluid" src="images/icon-03.svg" alt="image"> For android</a>
                                    </div>
                                </div>
                                <div class="prt-cta-form-wrapper-main">
                                    <div class="prt-cta-form-wrapper">
                                        <img width="98" height="19" class="img-fluid" src="images/form-image.webp" alt="image">
                                        <form action="#" class="query_form wrap-form clearfix"  method="post">
                                            <h3 class="cta-form-title">My car</h3>
                                            <p class="cta-form-desc">Find your dream car</p>
                                            <div class="row mt-25">
                                                <div class="col-md-12">
                                                    <label>
                                                        <span class="text-input"><input name="anycar" type="text" value="" placeholder="Any car" required="required"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>
                                                        <span class="text-input"><input name="minprice" type="text" value="" placeholder="Min price" required="required"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>
                                                        <span class="text-input"><input name="maxprice" type="text" value="" placeholder="Max price" required="required"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-12">
                                                   <button class="prt-btn prt-btn-size-sm prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white mt-10" type="submit">Search</button>
                                                </div>
                                            </div>
                                        </form>  
                                        <div class="cta-btn-link mt-5">
                                            <a class="prt-btn btn-inline" href="#">Advance search</a>
                                        </div>
                                        <div class="cta-form-image-wrapper" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="500">
                                            <img width="209" height="106" class="img-fluid" src="images/form-image-02.webp" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12" data-aos="fade-left" data-aos-duration="1500">
                            <div class="prt-cta-wrapper bg-base-skin res-1199-mt-30">
                                <div class="prt-cta-title">
                                    <h2>How to buy a new car?</h2>
                                    <div class="prt-cta-btn mt-30 res-575-mt-10">
                                        <a class="prt-btn prt-btn-size-md prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white" href="listing.php">View more</a>
                                    </div>
                                </div>
                                <div class="prt-cta-desc ml-30 res-767-ml-0 res-767-mt-20">
                                    <ul class="prt-list cta-list">
                                        <li>Best deals</li>
                                        <li>Sell your car</li>
                                        <li>Car book values</li>
                                        <li>Car dealers</li>
                                        <li>Compare prices</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                </div>
            </section>
            <!-- cta-section end-->

        </div><!-- site-main end-->

        <!-- footer start -->
        <footer class="footer widget-footer text-base-white overflow-hidden clearfix">
            <div class="second-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
                            <div class="pr-30 res-1199-pr-0" data-aos="fade-up" data-aos-duration="1500">
                                <div class="footer-cta-wappper">
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

    <!-- Revolution Slider -->    
    <script src='revolution/js/revolution.tools.min.js'></script>
    <script src='revolution/js/rs6.min.js'></script>
    <script src="revolution/js/slider.js"></script>
    <!-- Javascript end-->

</body>
</html>