<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS (for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        /* Adjust sidebar colors and icons */
        #sidebar {
            background-color: #f8f9fa;
            width: 250px;
            height: 100%;
            position: fixed;
            top: 7%;
            /* left: 0; */
            padding-top: 60px;
            padding-left: 30px;
            z-index: 1;
        }

        #sidebar a {
            text-decoration: none;
            padding: 10px;
            font-size: 18px;
            display: block;
            color: #444;
        }

        #sidebar a:hover {
            background-color: #e9ecef;
            color: #000;
        }

        /* .main-content {
            margin-left: 250px;
            padding: 20px;
        } */
        

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            border-bottom-width: 2px;
        }

        td {
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['username'] ?? 'Menu'; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/educational-management-systems/public/admin/profile">Edit Profile</a>
                            <a class="dropdown-item" href="/educational-management-systems/public/admin/logout">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="row mt-3">
            <div class="col-md-3">
                <div class="sidebar" id="sidebar">
                    <!-- Side Navigation -->
                    <a href="/educational-management-systems/public/admin"><i class="fas fa-tachometer-alt mr-2"></i> Dashboard</a>
                    <a href="/educational-management-systems/public/admin/students"><i class="fas fa-user-graduate mr-2"></i> Students</a>
                    <a href="/educational-management-systems/public/admin/file/upload"><i class="fas fa-file-upload mr-2"></i> Upload Excel</a>
                    <!-- Add more navigation options with icons -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <!-- Main Content Area -->
                    <div class="container mt-5">
                        <h1>Students</h1>
                        <!-- Students table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <!-- Add more columns based on your student table schema -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Populate this table with student data from your database -->
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>john@example.com</td>
                                    <!-- Add more cells with student information -->
                                </tr>
                                <!-- Repeat this row structure for each student -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom scripts -->
    <script>
        // Add your custom scripts here
    </script>
</body>
</html>
