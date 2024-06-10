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

// Fetch manufacturers for the dropdown
$sql = "SELECT ManufacturerID, Name FROM manufacturers";
$manufacturers_result = $conn->query($sql);

// Handle the update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $manufacturerID = intval($_POST['manufacturer_id']);
    $model = $_POST['model'];
    $year = intval($_POST['year']);
    $basePrice = floatval($_POST['baseprice']);
    $carPicture = $car['CarPicture']; // Default to the current picture

    // Check if the manufacturer ID exists in the manufacturers table
    $check_manufacturer = $conn->prepare("SELECT * FROM manufacturers WHERE ManufacturerID = ?");
    $check_manufacturer->bind_param("i", $manufacturerID);
    $check_manufacturer->execute();
    $result = $check_manufacturer->get_result();

    if ($result->num_rows > 0) {
        if (isset($_FILES['car_picture']) && $_FILES['car_picture']['error'] == 0) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $original_file_name = basename($_FILES["car_picture"]["name"]);
            $file_extension = pathinfo($original_file_name, PATHINFO_EXTENSION);
            $unique_file_name = uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $unique_file_name;
            $imageFileType = strtolower($file_extension);
            $uploadOk = 1;

            $check = getimagesize($_FILES["car_picture"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $errorMessage = "File is not an image.";
                $uploadOk = 0;
            }

            if ($_FILES["car_picture"]["size"] > 500000) {
                $errorMessage = "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $errorMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                $unique_file_name = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $unique_file_name;
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["car_picture"]["tmp_name"], $target_file)) {
                    $carPicture = $target_file;
                } else {
                    $errorMessage = "Sorry, there was an error uploading your file.";
                }
            }
        }

        $sql = "UPDATE cars SET ManufacturerID = ?, Model = ?, Year = ?, BasePrice = ?, CarPicture = ? WHERE CarID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issdsi", $manufacturerID, $model, $year, $basePrice, $carPicture, $carID);

        if ($stmt->execute()) {
            $successMessage = "The record has been updated successfully.";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'list.php';
                    }, 3000);
                  </script>";
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }
    } else {
        $errorMessage = "Manufacturer ID does not exist.";
    }
}

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
    <title>Update Car Details</title>

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
    <div class="d-flex justify-content-center">
        <div class="col-lg-4 col-md-12 mt-4">
            <section>
                <aside class="widget car-widget widget-contact-form with-title bg-base-grey border-rad_20">
                    <h3 class="title">Update Car Details</h3>
                    <?php if ($successMessage): ?>
                        <div id="message" class="alert alert-success"><?php echo $successMessage; ?></div>
                    <?php endif; ?>
                    <?php if ($errorMessage): ?>
                        <div id="message" class="alert alert-danger"><?php echo $errorMessage; ?></div>
                    <?php endif; ?>
                    <form id="updateForm" class="query_form-1 wrap-form clearfix" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Manufacturer*</label>
                                <span class="text-input">
                                    <select name="manufacturer_id" required="required" class="form-control" style="height: 41px;">
                                        <?php if ($manufacturers_result->num_rows > 0): ?>
                                            <?php while($manufacturer = $manufacturers_result->fetch_assoc()): ?>
                                                <option value="<?php echo $manufacturer['ManufacturerID']; ?>" <?php if($car['ManufacturerID'] == $manufacturer['ManufacturerID']) echo 'selected'; ?>>
                                                    <?php echo $manufacturer['Name']; ?>
                                                </option>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <option value="">No manufacturers available</option>
                                        <?php endif; ?>
                                    </select>
                                </span>
                            </div>
                            <div class="col-md-12">
                                <label>Model*</label>
                                <span class="text-input"><input name="model" type="text" value="<?php echo htmlspecialchars($car['Model']); ?>" placeholder="Model" required="required"></span>
                            </div>
                            <div class="col-md-12">
                                <label>Year*</label>
                                <span class="text-input"><input name="year" type="number" value="<?php echo htmlspecialchars($car['Year']); ?>" placeholder="Year" required="required" min="0"></span>
                            </div>
                            <div class="col-md-12">
                                <label>Base Price*</label>
                                <span class="text-input"><input name="baseprice" type="number" step="0.01" value="<?php echo htmlspecialchars($car['BasePrice']); ?>" placeholder="Base Price" required="required" min="0"></span>
                            </div>
                            <div class="col-md-12">
                                <label>Current Picture</label>
                                <div>
                                    <img src="<?php echo htmlspecialchars($car['CarPicture']); ?>" alt="Current Car Picture" style="width: 100px; height: auto;">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Upload New Picture (Optional)</label>
                                <div>
                                    <input name="car_picture" type="file" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="prt-btn prt-btn-size-sm prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white mt-15" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
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

<?php $conn->close(); ?>
