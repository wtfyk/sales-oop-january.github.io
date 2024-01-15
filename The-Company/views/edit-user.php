<?php
session_start();

require "../classes/User.php";

$user_obj = new User;
$user = $user_obj->getUser($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../assets/css/style.css">
    
    <title>Edit User</title>
</head>
<body>

    <nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom: 80px;">
            <div class="container">
                <a href="dashboard.php" class="navbar-brand">
                    <h1 class="h3">The Company</h1>
                </a>
                <div class="navbar-nav">
                    <span class="navbar-text"><?= $_SESSION['full_name']?></span>
                    <form action="../actions/logout.php" class="d-flex ms-2" method="post">
                        <button type="submit" class="text-danger bg-transparent border-0">Log out</button>
                    </form>
                </div>
            </div>
        </nav>

<main class="row justify-content-center gx-0">
        <div class="col-4">
            <h2 class="text-center mb-4">EDIT USER</h2>

        <form action="../actions/edit-user.php" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center mb-3">
                <div class="col-6">
                <?php
                    if($user['photo']){
                ?>
                <img src="../assets/images/<?= $user['photo']?>" alt="<?= $user['photo']?>" class="d-block mx-auto edit-photo">
                <?php
                } else {
                ?>
                <i class="fa-solid fa-user text-secondary d-block text-center edit-icon"></i>
                <?php
                }
                ?>

                <input type="file" name="photo" class="form-control mt-2" accept="image/*">
            </div>
        </div>
        

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first-name" class="form-control" value="<?= $user['first_name']?>">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last-name" class="form-control" value="<?= $user['last_name']?>">
        </div>
        <div class="mb-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= $user['username']?>">
        </div>

        <div class="text-end">
            <a href="dashboard.php" class="btn btn-secondary btn-sm">Cancel</a>
            <button type="submit" class="btn btn-warning btn-sm px-5">Save</button>
        </div>

        </div>
    </form>
</main>
</body>
</html>