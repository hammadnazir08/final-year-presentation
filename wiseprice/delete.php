<?php
include 'config.php';

$carID = intval($_GET['id']);
$successMessage = "";
$errorMessage = "";

// Fetch the current details of the car from the database
$sql = "SELECT c.CarID, c.ManufacturerID, m.Name as ManufacturerName, c.Model, c.Year, c.BasePrice, c.CarPicture 
        FROM cars c
        JOIN manufacturers m ON c.ManufacturerID = m.ManufacturerID
        WHERE c.CarID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $carID);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();

if (!$car) {
    $errorMessage = "No car found with the given ID.";
}

// Handle the deletion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch the current details of the car to get the picture path
    $sql = "SELECT CarPicture FROM cars WHERE CarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $carID);
    $stmt->execute();
    $result = $stmt->get_result();
    $car = $result->fetch_assoc();

    if ($car) {
        // Delete the car record from the database
        $sql = "DELETE FROM cars WHERE CarID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $carID);

        if ($stmt->execute()) {
            // Delete the picture file if it exists
            if (file_exists($car['CarPicture'])) {
                unlink($car['CarPicture']);
            }
            $successMessage = "The record has been deleted successfully.";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'list.php';
                    }, 3000);
                  </script>";
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }
    } else {
        $errorMessage = "No car found with the given ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="Autovis - Car Dealers HTML Template, Autovis - Car Dealers WordPress Theme, wordpress theme, premium wordpress theme, responsive wordpress theme, themeforest, envato,  themes & templates, wordpress theme, unlimited colors available, ui/ux, ui/ux design, best wordpress theme, wordpress theme, JavaScript, best css theme,css3, elementor theme, latest premium themes 2024, latest premium templates 2024, Preyan Technosys Pvt.Ltd, cymol themes, themetech mount, Web 3.0, multi-theme, website theme and template, bootstrap template, web templates, responsive theme, services, web design and development, blog website, HTML template, Html5, auto, business, car dealer, car dealership, car listing, cars, listing, motors, automotive, car repair, cardealer, cars, directory, elementor, car inventory, vehicle, auto, auto dealer, auto shop, bike, buy car, car store, accessories shop, car ecommerce, car seller, car listing, auto dealer, auto parts, automobile, car rental, car repair, car shop, car wash, garage, marketplace, motor cycle, trucks">
<meta name="description" content="Autovis - Car Dealers HTML Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Delete Car</title>

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
    .alert-success {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        padding: 15px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 4px;
    }
    .alert-danger {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        padding: 15px;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
    }
</style>
</head>
<body>
<div class="container mt-5" style="padding: 200px 20px;">
    <h3 style="font-size: 40px">Delete Car</h3>
    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php endif; ?>
    <?php if ($car): ?>
        <div class="row">
            <div class="col-md-12">
                <label>Car ID:</label>
                <span><?php echo htmlspecialchars($car['CarID']); ?></span>
            </div>
            <div class="col-md-12">
                <label>Manufacturer:</label>
                <span><?php echo htmlspecialchars($car['ManufacturerName']); ?></span>
            </div>
            <div class="col-md-12">
                <label>Model:</label>
                <span><?php echo htmlspecialchars($car['Model']); ?></span>
            </div>
            <div class="col-md-12">
                <label>Year:</label>
                <span><?php echo htmlspecialchars($car['Year']); ?></span>
            </div>
            <div class="col-md-12">
                <label>Base Price:</label>
                <span><?php echo htmlspecialchars($car['BasePrice']); ?></span>
            </div>
            <div class="col-md-12">
                <label>Picture:</label>
                <img src="<?php echo htmlspecialchars($car['CarPicture']); ?>" alt="Car Picture" style="width:100px;height:auto;">
            </div>
        </div>
        <div class="mt-4">
            <form method="post" action="delete.php?id=<?php echo $carID; ?>">
                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($car['CarID']); ?>">
                <button class="btn btn-danger" type="submit">Delete</button>
                <a href="list.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    <?php endif; ?>
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

    // Auto-hide the alert message after 3 seconds
    setTimeout(function() {
        var alert = document.querySelector('.alert-success');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000);
</script>
</body>
</html>

<?php $conn->close(); ?>
