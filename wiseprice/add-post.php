<?php
    include 'config.php';




    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        $current_page = basename($_SERVER['PHP_SELF']);
        var_dump($_SESSION['loggedin']); die();
        header("Location: index.php?login=true&redirect=" . urlencode($current_page));
        exit;
    }

    
    
    


    
$message = '';

// Fetch all manufacturers for the dropdown
$manufacturers_sql = "SELECT ManufacturerID, Name FROM manufacturers";
$manufacturers_result = $conn->query($manufacturers_sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $manufacturer_id = $_POST['manufacturer_id'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $baseprice = $_POST['baseprice'];
    $city = $_POST['city'];
    $city_area = $_POST['city_area'];
    $car_info = $_POST['car_info'];
    $registered_in = $_POST['registered_in'];
    $exterior_color = $_POST['exterior_color'];
    $mileage = $_POST['mileage'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Check if the manufacturer ID exists in the manufacturers table
    $check_manufacturer = $conn->prepare("SELECT * FROM manufacturers WHERE ManufacturerID = ?");
    $check_manufacturer->bind_param("i", $manufacturer_id);
    $check_manufacturer->execute();
    $result = $check_manufacturer->get_result();

    if ($result->num_rows > 0) {
        // Manufacturer ID exists, proceed with insertion
        // Ensure the uploads directory exists
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Get the file name and generate a unique name to avoid conflicts
        $original_file_name = basename($_FILES["car_picture"]["name"]);
        $file_extension = pathinfo($original_file_name, PATHINFO_EXTENSION);
        $unique_file_name = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $unique_file_name;

        $uploadOk = 1;
        $imageFileType = strtolower($file_extension);

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["car_picture"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $message = "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["car_picture"]["size"] > 500000) {
            $message = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            // Optionally, handle file name conflict
            // Generate a unique file name if file already exists
            $unique_file_name = uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $unique_file_name;
        }

        // If everything is ok, try to upload file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["car_picture"]["tmp_name"], $target_file)) {
                // Prepare and bind
                $stmt = $conn->prepare("INSERT INTO cars (ManufacturerID, Model, Year, BasePrice, CarPicture, status, city, city_area, car_info, registered_in, exterior_color, mileage, price, description) VALUES (?, ?, ?, ?, ?, 'pending', ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issdssssssisds", $manufacturer_id, $model, $year, $baseprice, $target_file, $city, $city_area, $car_info, $registered_in, $exterior_color, $mileage, $price, $description);

                // Execute the query
                if ($stmt->execute()) {
                    $message = "The record has been added successfully and is pending approval.";
                } else {
                    $message = "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $message = "Manufacturer ID does not exist.";
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
</head>
<body>
    <div class="d-flex justify-content-center">
        <div class="col-lg-8 col-md-12 mt-4">
            <section>
                <aside class="widget car-widget widget-contact-form with-title bg-base-grey border-rad_20">
                    <h3 class="title">Add Your Car</h3>
                    <?php if ($message): ?>
                        <div id="message" class="alert alert-success"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <form id="carForm" class="query_form-1 wrap-form clearfix" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Manufacturer*</label>
                                <span class="text-input">
                                    <select name="manufacturer_id" required="required" class="form-control" style="height: 41px;">
                                        <?php if ($manufacturers_result->num_rows > 0): ?>
                                            <?php while($manufacturer = $manufacturers_result->fetch_assoc()): ?>
                                                <option value="<?php echo $manufacturer['ManufacturerID']; ?>"><?php echo $manufacturer['Name']; ?></option>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <option value="">No manufacturers available</option>
                                        <?php endif; ?>
                                    </select>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label>Model*</label>
                                <span class="text-input"><input name="model" type="text" value="" placeholder="Model" required="required"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Year*</label>
                                <span class="text-input"><input name="year" type="number" value="" placeholder="Year" required="required" min="0"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Base Price*</label>
                                <span class="text-input"><input name="baseprice" type="number" step="0.01" value="" placeholder="Base Price" required="required" min="0"></span>
                            </div>
                            <div class="col-md-6">
                                <label>City*</label>
                                <span class="text-input"><input name="city" type="text" value="" placeholder="City" required="required"></span>
                            </div>
                            <div class="col-md-6">
                                <label>City Area</label>
                                <span class="text-input"><input name="city_area" type="text" value="" placeholder="City Area"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Car Info*</label>
                                <span class="text-input"><textarea name="car_info" placeholder="Car Info" required="required"></textarea></span>
                            </div>
                            <div class="col-md-6">
                                <label>Registered In</label>
                                <span class="text-input"><input name="registered_in" type="text" value="" placeholder="Registered In"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Exterior Color*</label>
                                <span class="text-input"><input name="exterior_color" type="text" value="" placeholder="Exterior Color" required="required"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Mileage* (km)</label>
                                <span class="text-input"><input name="mileage" type="number" value="" placeholder="Mileage (km)" required="required" min="0"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Price* (Rs.)</label>
                                <span class="text-input"><input name="price" type="number" step="0.01" value="" placeholder="Price (Rs.)" required="required" min="0"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Description*</label>
                                <span class="text-input"><textarea name="description" placeholder="Description" required="required"></textarea></span>
                            </div>
                            <div class="col-md-12">
                                <label>Upload Picture*</label>
                                <input name="car_picture" type="file" accept="image/*" required="required">
                            </div>
                            <div class="col-md-12">
                                <button class="prt-btn prt-btn-size-sm prt-btn-shape-rounded prt-btn-style-border prt-btn-color-white mt-15" type="submit">Submit</button>
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
