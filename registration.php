<?php
session_start();
require_once "database.php"; // Assuming database.php contains your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $lastName = $_POST["lastName"];
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $country = $_POST["country"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $lot_blk_street = $_POST["lot_blk_street"];
    $barangay = $_POST["barangay"];
    $province = $_POST["province"];
    $cityMunicipality = $_POST["cityMunicipality"];
    $zipcode = $_POST["zipcode"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    // Check if the email already exists in the database
    $check_sql = "SELECT * FROM user_data WHERE email = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "s", $email);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    // Check if any rows were returned
    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        // Email already exists in the database, add error message
        $errors[] = "Email address already exists.";
        echo '<script>alert("Email address already exists.");</script>';
        mysqli_stmt_close($check_stmt);
    } else {
        // Proceed with inserting the new user
        $sql = "INSERT INTO user_data (lastName, firstName, middleName, email, password, country, phone_number, address, lot_blk_street, barangay, province, cityMunicipality, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssssssss", $lastName, $firstName, $middleName, $email, $passwordHash, $country, $phone_number, $address, $lot_blk_street, $barangay, $province, $cityMunicipality, $zipcode);
        if (mysqli_stmt_execute($stmt)) {
            // Registration successful
            echo '<script>alert("You have registered successfully.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
            exit; // Stop further execution
        } else {
            // Error during registration
            echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
        }
        mysqli_stmt_close($stmt);
    }

    // Output errors
    foreach ($errors as $error) {
        echo '<script>alert("' . $error . '");</script>';
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registration.css">
    <title>Form Design</title>
</head>
<body>
<div class="container-fluid  text-light py-3">
    <header class="text-center">
        <h1 class="display-6">Personal Space</h1>
    </header>
</div>

<section class="container my-2 k w-50 text-light p-2">
<form class="row g-3 p-3" action="login.php" method="POST">

        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="validationDefault01" name="lastName" placeholder="Enter your last name" >
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">First Name</label>
            <input type="text" class="form-control" id="validationDefault02" name="firstName" placeholder="Enter your First Name" >
        </div>
        <div class="col-md-4">
            <label for="validationDefaultUsername" class="form-label">Middle Name</label>
            <div class="input-group">
            <input type="text" class="form-control" id="validationDefaultUsername" name="middlename" placeholder="Enter your middle name" aria-describedby="inputGroupPrepend2">
            </div>
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="juandelacruz@gmail.com">
        </div>

        



  <!-- Country Dropdown -->
  <div class="col-md-6">
    <div class="dropdown">
        <label for="country" class="form-label">Country</label>
        <div class="input-group mb-3">
            <select id="country" class="form-select" required>
                <option value="" disabled selected>Select Country</option>
                <!-- Add country options here -->
            </select>
        </div>
    </div>
</div>

        <div class="col-md-6">
            <label for="inputPhoneNumber" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="inputPhoneNumber" name="phone_number" placeholder="Enter your phone number">
        </div>

        
        </div>
        <div class="col-md-6">
        <label for="inputAddress" class="form-label">Address</label>
        <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Apartment, studio, or floor">
        </div>
        <div class="col-md-6">
        <label for="inputAddress2" class="form-label">Lot/Blk/Street</label>
        <input type="text" class="form-control" id="inputAddress2" name="street" placeholder="1234 Main Street">
        </div>

        <div class="col-6">
        <label for="inputBarangay" class="form-label">Barangay</label>
        <input type="text" class="form-control" id="inputBarangay" name="barangay" placeholder="Enter your Barangay">
        </div>

        <div class="col-md-6">
        <label for="inputProvince" class="form-label">Province</label>
        <select id="inputProvince" class="form-select" name="province">
                <option selected>Choose...</option>
                <option>Abra</option>
                <option>Agusan del Norte</option>
                <option>Aklan</option>
                <option>Albay</option>
                <option>Antique</option>
                <option>Apayao</option>
                <option>Aurora</option>
                <option>Basilan</option>
                <option>Bataan</option>
                <option>Batanes</option>
                <option>Batangas</option>
                <option>Benguet</option>
                <option>Biliran</option>
                <option>Bohol</option>
                <option>Bukidnon</option>
                <option>Bulacan</option>
                <option>Cagayan</option>
                <option>Camarines Norte</option>
                <option>Camarines Sur</option>
                <option>Camiguin</option>
                <option>Capiz</option>
                <option>Catanduanes</option>
                <option>Cavite</option>
                <option>Cebu</option>
                <option>Compostela Valley</option>
                <option>Cotabato</option>
                <option>Davao del Norte</option>
                <option>Davao del Sur</option>
                <option>Davao Occidental</option>
                <option>Davao Oriental</option>
                <option>Dinagat Islands</option>
                <option>Eastern Samar</option>
                <option>Guimaras</option>
                <option>Ifugao</option>
                <option>Ilocos Norte</option>
                <option>Ilocos Sur</option>
                <option>Iloilo</option>
                <option>Isabela</option>
                <option>Kalinga</option>
                <option>La Union</option>
                <option>Laguna</option>
                <option>Lanao del Norte</option>
                <option>Lanao del Sur</option>
                <option>Leyte</option>
                <option>Maguindanao Del Norte</option>
                <option>Maguindanao Del Sur</option>
                <option>Marinduque</option>
                <option>Masbate</option>
                <option>Metro Manila</option>
                <option>Quezon City</option>
                <option>Misamis Occidental</option>
                <option>Misamis Oriental</option>
                <option>Mountain Province</option>
                <option>Negros Occidental</option>
                <option>Negros Oriental</option>
                <option>Northern Samar</option>
                <option>Nueva Ecija</option>
                <option>Nueva Vizcaya</option>
                <option>Occidental Mindoro</option>
                <option>Oriental Mindoro</option>
                <option>Palawan</option>
                <option>Pampanga</option>
                <option>Pangasinan</option>
                <option>Quezon</option>
                <option>Quirino</option>
                <option>Rizal</option>
                <option>Romblon</option>
                <option>Samar (Western Samar)</option>
                <option>Sarangani</option>
                <option>Siquijor</option>
                <option>Sorsogon</option>
                <option>South Cotabato</option>
                <option>Southern Leyte</option>
                <option>Sultan Kudarat</option>
                <option>Sulu</option>
                <option>Surigao del Norte</option>
                <option>Surigao del Sur</option>
                <option>Tarlac</option>
                <option>Tawi-Tawi</option>
                <option>Zambales</option>
                <option>Zamboanga del Norte</option>
                <option>Zamboanga del Sur</option>
                <option>Zamboanga Sibugay</option>
 
            </select>
        </div>
        
        <div class="col-md-4">
        <label for="inputCity" class="form-label">City/Municipality</label>
        <select id="inputCity" class="form-select" name="cityMunicipality">
                <option value="">City/Municipality</option>
                <option value="Angeles">Angeles</option>
                <option value="Antipolo">Antipolo</option>
                <option value="Angono">Angono</option>
                <option value="Bacolod">Bacolod</option>
                <option value="Binangonan">Binangonan</option>
                <option value="Baras">Baras</option>
                <option value="Bacoor">Bacoor</option>
                <option value="Baguio">Baguio</option>
                <option value="Balanga">Balanga</option>
                <option value="Bais">Bais</option>
                <option value="Bago">Bago</option>
                <option value="Batac">Batac</option>
                <option value="Batangas City">Batangas City</option>
                <option value="Bayawan">Bayawan</option>
                <option value="Baybay">Baybay</option>
                <option value="Cabanatuan">Cabanatuan</option>
                <option value="Cadiz">Cadiz</option>
                <option value="Cainta">Cainta</option>
                <option value="Cagayan de Oro">Cagayan de Oro</option>
                <option value="Calapan">Calapan</option>
                <option value="Calbayog">Calbayog</option>
                <option value="Caloocan">Caloocan</option>
                <option value="Cardona">Cardona</option>
                <option value="Candon">Candon</option>
                <option value="Cavite City">Cavite City</option>
                <option value="Cebu City">Cebu City</option>
                <option value="Dagupan">Dagupan</option>
                <option value="Danao">Danao</option>
                <option value="Dasmarinas">Dasmarinas</option>
                <option value="Dasmariñas">Dasmariñas</option>
                <option value="Davao City">Davao City</option>
                <option value="Dumaguete">Dumaguete</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Escalante">Escalante</option>
                <option value="General Santos">General Santos</option>
                <option value="Gingoog">Gingoog</option>
                <option value="Guihulngan">Guihulngan</option>
                <option value="Iloilo City">Iloilo City</option>
                <option value="Imus">Imus</option>
                <option value="Kalibo">Kalibo</option>
                <option value="Kabankalan">Kabankalan</option>
                <option value="Jalajala">Jalajala</option>
                <option value="Laoag">Laoag</option>
                <option value="Lapu-Lapu">Lapu-Lapu</option>
                <option value="Las Piñas">Las Piñas</option>
                <option value="La Carlota">La Carlota</option>
                <option value="Legazpi">Legazpi</option>
                <option value="Lipa">Lipa</option>
                <option value="Lucena">Lucena</option>
                <option value="Mabalacat">Mabalacat</option>
                <option value="Makati">Makati</option>
                <option value="Malabon">Malabon</option>
                <option value="Malaybalay">Malaybalay</option>
                <option value="Malolos">Malolos</option>
                <option value="Mandaluyong">Mandaluyong</option>
                <option value="Mandaue">Mandaue</option>
                <option value="Manila">Manila</option>
                <option value="Marawi">Marawi</option>
                <option value="Marikina">Marikina</option>
                <option value="Masbate City">Masbate City</option>
                <option value="Mati">Mati</option>
                <option value="Meycauayan">Meycauayan</option>
                <option value="Muntinlupa">Muntinlupa</option>
                <option value="Morong">Morong</option>
                <option value="Muñoz">Muñoz</option>
                <option value="Naga">Naga</option>
                <option value="Navotas">Navotas</option>
                <option value="Olongapo">Olongapo</option>
                <option value="Ormoc">Ormoc</option>
                <option value="Oroquieta">Oroquieta</option>
                <option value="Ozamiz">Ozamiz</option>
                <option value="Pagadian">Pagadian</option>
                <option value="Palayan">Palayan</option>
                <option value="Pasay">Pasay</option>
                <option value="Pasig">Pasig</option>
                <option value="Passi">Passi</option>
                <option value="Pililla">Pililla</option>
                <option value="Puerto Princesa">Puerto Princesa</option>
                <option value="Quezon City">Quezon City</option>
                <option value="Roxas">Roxas</option>
                <option value="Sagay">Sagay</option>
                <option value="San Carlos">San Carlos</option>
                <option value="San Fernando (La Union)">San Fernando (La Union)</option>
                <option value="San Fernando (Pampanga)">San Fernando (Pampanga)</option>
                <option value="San Jose del Monte">San Jose del Monte</option>
                <option value="San Juan">San Juan</option>
                <option value="San Mateo">San Mateo</option>
                <option value="San Pablo">San Pablo</option>
                <option value="Santa Rosa">Santa Rosa</option>
                <option value="Santiago">Santiago</option>
                <option value="Silay">Silay</option>
                <option value="Sipalay">Sipalay</option>
                <option value="Sorsogon City">Sorsogon City</option>
                <option value="Surigao City">Surigao City</option>
                <option value="Rodriguez (formerly Montalban)">Rodriguez (formerly Montalban)</option>
                <option value="Tabaco">Tabaco</option>
                <option value="Tacloban">Tacloban</option>
                <option value="Tacurong">Tacurong</option>
                <option value="Tagaytay">Tagaytay</option>
                <option value="Tagbilaran">Tagbilaran</option>
                <option value="Taguig">Taguig</option>
                <option value="Talisay (Cebu)">Talisay (Cebu)</option>
                <option value="Talisay (Negros Occidental)">Talisay (Negros Occidental)</option>
                <option value="Tanay">Tanay</option>
                <option value="Tanauan">Tanauan</option>
                <option value="Teresa">Teresa</option>
                <option value="Taytay">Taytay</option>
                <option value="Tanjay">Tanjay</option>
                <option value="Tarlac City">Tarlac City</option>
                <option value="Tayabas">Tayabas</option>
                <option value="Toledo">Toledo</option>
                <option value="Trece Martires">Trece Martires</option>
                <option value="Tuguegarao">Tuguegarao</option>
                <option value="Urdaneta">Urdaneta</option>
                <option value="Valencia">Valencia</option>
                <option value="Valenzuela">Valenzuela</option>
                <option value="Victorias">Victorias</option>
                <option value="Vigan">Vigan</option>
                <option value="Zamboanga City">Zamboanga City</option>
            </select>
        </div>
        <div class="col-md-2">
        <label for="inputZip" class="form-label">Zip Code</label>
        <input type="text" class="form-control" id="inputZip" name="zipcode">
        </div>

        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Password">
        </div>
        <div class="col-md-6">
            <label for="inputPassword5" class="form-label">Retype Password</label>
            <input type="password" class="form-control" id="inputPassword5" name="confirm_password" placeholder="Retype Password" >
        </div>

   
        <button type="submit"  class="btn btn-primary">Submit</button>
    </div>
      <script src="registration.js"></script>
    </form>
   
</section>
</body>
</html>
