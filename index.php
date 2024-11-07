<?php

session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lead Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Add Lead</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="statuses.php">Lead Statuses</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Add New Lead</h2>
        <?php
        require 'methods.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $leadData = [
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'email' => $_POST['email'] ?? '',
                'box_id' => 28,
                'offer_id' => 5,
                'countryCode' => 'GB',
                'language' => 'en',
                'password' => 'qwerty12',
                'ip' => $_SERVER['REMOTE_ADDR'],
                'landingUrl' => (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']
            ];
            
            $response = makeApiRequest('addlead', 'POST', $leadData);

            if (isset($response['success']) && $response['success']) {
                echo '<div class="alert alert-success">Lead is added!</div>';
            } else {
                echo '<div class="alert alert-danger">Error adding lead, error code: '.$response['error'].'</div>';
            }
        }
        ?>
        <form method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Lead</button>
        </form>
    </div>
</body>
</html>