<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lead Statuses</title>
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
        <h2>Lead Statuses</h2>
        
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="dateFrom" class="form-label">Date From</label>
                    <input type="date" class="form-control" id="dateFrom" name="dateFrom" 
                           value="<?php echo $_GET['dateFrom'] ?? ''; ?>">
                </div>
                <div class="col-md-4">
                    <label for="dateTo" class="form-label">Date To</label>
                    <input type="date" class="form-control" id="dateTo" name="dateTo"
                           value="<?php echo $_GET['dateTo'] ?? ''; ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block">Filter</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>FTD</th>
                </tr>
            </thead>
            <tbody>
                <?php

                require 'methods.php';

                $params = [];
                if (!empty($_GET['dateFrom'])) {
                    $params['dateFrom'] = $_GET['dateFrom'];
                }
                if (!empty($_GET['dateTo'])) {
                    $params['dateTo'] = $_GET['dateTo'];
                }
                if (!empty($_GET['page'])) {
                    $params['page'] = $_GET['page'];
                }
                if (!empty($_GET['limit'])) {
                    $params['limit'] = $_GET['limit'];
                }
                
                $queryString = !empty($params) ? '?' . http_build_query($params) : '';
                $response = makeApiRequest('getstatuses' . $queryString);
                
                if ($response['status']) {
                    if (isset($response['data']) && is_array($response['data'])) {
                        foreach ($response['data'] as $lead) {
                            echo "<tr>";
                            echo "<td>{$lead['id']}</td>";
                            echo "<td>{$lead['email']}</td>";
                            echo "<td>{$lead['status']}</td>";
                            echo "<td>{$lead['ftd']}</td>";
                            echo "</tr>";
                        }
                    }
                }
                else{
                    echo '<div class="alert alert-danger">Error code: '.$response['error'].'</div>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
