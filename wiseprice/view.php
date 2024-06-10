<?php
include 'config.php';

$carID = intval($_GET['id']);
$car = null;

// Fetch the details of the car from the database
$sql = "SELECT c.CarID, c.ManufacturerID, m.Name as ManufacturerName, c.Model, c.Year, c.BasePrice, c.CarPicture 
        FROM cars c
        JOIN manufacturers m ON c.ManufacturerID = m.ManufacturerID
        WHERE c.CarID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $carID);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Autovis - Car Dealers HTML Template, Autovis - Car Dealers WordPress Theme, wordpress theme, premium wordpress theme, responsive wordpress theme, themeforest, envato, themes & templates, wordpress theme, unlimited colors available, ui/ux, ui/ux design, best wordpress theme, wordpress theme, JavaScript, best css theme,css3, elementor theme, latest premium themes 2024, latest premium templates 2024, Preyan Technosys Pvt.Ltd, cymol themes, themetech mount, Web 3.0, multi-theme, website theme and template, bootstrap template, web templates, responsive theme, services, web design and development, blog website, HTML template, Html5, auto, business, car dealer, car dealership, car listing, cars, listing, motors, automotive, car repair, cardealer, cars, directory, elementor, car inventory, vehicle, auto, auto dealer, auto shop, bike, buy car, car store, accessories shop, car ecommerce, car seller, car listing, auto dealer, auto parts, automobile, car rental, car repair, car shop, car wash, garage, marketplace, motor cycle, trucks">
    <meta name="description" content="Autovis - Car Dealers HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Car Details</title>

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
</head>
<body>
    <!-- (navbar and sidebar) -->
    <div class="content">
        <div class="container mt-5" style="padding:200px 20px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title title-style-center_text">
                        <div class="title-header">
                            <h2 class="title">Car Details</h2>
                            <div class="title-overlay style2" data-aos="fade-up" data-aos-duration="1500">Details</div>
                        </div>
                        <div class="title-desc style2">
                            <p>Details of the selected car.</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($car): ?>
                <div class="row">
                    <div class="col-md-6 mt">
                        <img src="<?php echo htmlspecialchars($car['CarPicture']); ?>" alt="Car Picture" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <h3><?php echo htmlspecialchars($car['ManufacturerName']); ?> <?php echo htmlspecialchars($car['Model']); ?> (<?php echo htmlspecialchars($car['Year']); ?>)</h3>
                        <p><strong>Base Price:</strong> $<?php echo number_format($car['BasePrice'], 2); ?></p>
                        <p><strong>Manufacturer:</strong> <?php echo htmlspecialchars($car['ManufacturerName']); ?></p>
                        <p><strong>Model:</strong> <?php echo htmlspecialchars($car['Model']); ?></p>
                        <p><strong>Year:</strong> <?php echo htmlspecialchars($car['Year']); ?></p>
                        <p><strong>Base Price:</strong> $<?php echo number_format($car['BasePrice'], 2); ?></p>
                    </div>
                </div>
            <?php else: ?>
                <p>No car details found.</p>
            <?php endif; ?>
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
    <script>
        AOS.init({
            offset: 0,
            duration: 400,
            delay: 0,
            once: true,
        });

        $(document).ready(function() {
            if ($('#message').length) {
                setTimeout(function() {
                    $('#message').fadeOut('slow', function() {
                        $(this).remove();
                        window.location.href = 'list.php';
                    });
                }, 3000);
            }
        });
    </script>
</body>
</html>
