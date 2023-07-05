<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inlcude header -->
    <?php include './partials/header.php'; ?>
    <title>Document</title>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top px-3">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-poo">Admin</I>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#zzzz">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="zzzz">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Books</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid py-2">
        <!-- <h2 class="text-center p-4">LIBRARY MANAGEMENT SYSTEM</h2> -->

        <div class="mb-2">
            <button class="btn btn-success">New Book</button>
            <button class="btn btn-primary">Return Book</button>
        </div>

        <table class="table table-bordered table-hover">
            <thead>

                <tr>
                    <th>ISBN</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>
    </div>

</body>

</html>