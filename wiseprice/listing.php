<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $fuel_type = $_POST['fuel_type'];
    $transmission = $_POST['transmission'];
    $registered_in = $_POST['registered_in'];
    $color = $_POST['color'];
    $assembly = $_POST['assembly'];
    $body_type = $_POST['body_type'];
    $model_year = $_POST['model_year'];
    $mileage = $_POST['mileage'];
    $engine_capacity = $_POST['engine_capacity'];

    $command = escapeshellcmd("C:\\Python312\\python.exe C:\\Python312\\project\\Load_model.py" . 
        escapeshellarg($make) . " " . 
        escapeshellarg($model) . " " . 
        escapeshellarg($fuel_type) . " " . 
        escapeshellarg($transmission) . " " . 
        escapeshellarg($registered_in) . " " . 
        escapeshellarg($color) . " " . 
        escapeshellarg($assembly) . " " . 
        escapeshellarg($body_type) . " " . 
        escapeshellarg($model_year) . " " . 
        escapeshellarg($mileage) . " " . 
        escapeshellarg($engine_capacity));

    // Log the command being executed
    error_log("Executing command: " . $command);

    $output = shell_exec($command);

    // Log the output of the Python script
    error_log("Python script output: " . $output);

    $result = json_decode($output, true);

    if ($result !== null && isset($result['predicted_price'])) {
        $predicted_price = $result['predicted_price'];
    } else {
        // Handle the error gracefully
        $predicted_price = "Error: Unable to retrieve the predicted price.";
        if ($result !== null && isset($result['error'])) {
            $predicted_price .= " " . $result['error'];
        }
        error_log("Error: Unable to decode the Python script output or 'predicted_price' not set. Output: " . $output);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Autovis - Car Dealers HTML Template, Autovis - Car Dealers WordPress Theme, wordpress theme, premium wordpress theme, responsive wordpress theme, themeforest, envato, themes & templates, wordpress theme, unlimited colors available, ui/ux, ui/ux design, best wordpress theme, wordpress theme, JavaScript, best css theme,css3, elementor theme, latest premium themes 2024, latest premium templates 2024, Preyan Technosys Pvt.Ltd, cymol themes, themetech mount, Web 3.0, multi-theme, website theme and template, bootstrap template, web templates, responsive theme, services, web design and development, blog website, HTML template, Html5, auto, business, car dealer, car dealership, car listing, cars, listing, motors, automotive, car repair, cardealer, cars, directory, elementor, car inventory, vehicle, auto, auto dealer, auto shop, bike, buy car, car store, accessories shop, car ecommerce, car seller, car listing, auto dealer, auto parts, automobile, car rental, car repair, car shop, car wash, garage, marketplace, motor cycle, trucks">
    <meta name="description" content="Autovis - Car Dealers HTML Template">
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
        .form-group {
            margin-bottom: 1rem;
        }
        .text-input {
            display: block;
        }
        .text-input input {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .row .col-md-6 {
            padding-left: 10px;
            padding-right: 10px;
        }
        .widget {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center">
        <div class="col-lg-8 col-md-12 mt-4">
            <section>
                <aside class="widget car-widget widget-contact-form with-title bg-base-grey border-rad_20">
                    <h3 class="title">Price Prediction</h3>
                    <form action="" method="post" class="query_form-1 wrap-form clearfix">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Make*</label>
                                <span class="text-input"><input name="make" type="text" value="" placeholder="Make" required="required"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Model*</label>
                                <span class="text-input"><input name="model" type="text" value="" placeholder="Model" required="required"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Fuel Type*</label>
                                <span class="text-input"><input name="fuel_type" type="text" value="" placeholder="Fuel Type" required="required"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Transmission*</label>
                                <span class="text-input"><input name="transmission" type="text" value="" placeholder="Transmission" required="required"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Registered In*</label>
                                <span class="text-input"><input name="registered_in" type="text" value="" placeholder="Registered In" required="required"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Color*</label>
                                <span class="text-input"><input name="color" type="text" value="" placeholder="Color" required="required"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Assembly*</label>
                                <span class="text-input"><input name="assembly" type="text" value="" placeholder="Assembly" required="required"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Body Type*</label>
                                <span class="text-input"><input name="body_type" type="text" value="" placeholder="Body Type" required="required"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Model Year*</label>
                                <span class="text-input"><input name="model_year" type="text" value="" placeholder="Model Year" required="required"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mileage*</label>
                                <span class="text-input"><input name="mileage" type="text" value="" placeholder="Mileage" required="required"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Engine Capacity*</label>
                                <span class="text-input"><input name="engine_capacity" type="text" value="" placeholder="Engine Capacity" required="required"></span>
                            </div>
                            <div class="col-md-12">
                                <button class="prt-btn prt-btn-size-sm prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white mt-15" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div id="predicted-price" class="mt-3">
                        <?php if (isset($predicted_price)) echo "Predicted Price: $predicted_price"; ?>
                    </div>
                </aside>
            </section>
        </div>
    </div>

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
</body>
</html>
