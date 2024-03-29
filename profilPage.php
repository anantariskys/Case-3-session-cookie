<?php 
session_start();


if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
  
    header('Location: loginPage.php');
    exit;
}


$fullName = $_SESSION['name'];
$username = $_SESSION['username'];
$description = $_SESSION['description'];
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Profil Page</title>
</head>

<body class="bg-[#FEFDED]">

    <?php include ('navbar.php') ?>

    <main class="container p-20 bg-white mx-auto m-10 shadow-lg rounded-sm flex flex-col items-center gap-5">
        <img src="https://source.unsplash.com/random/900×700/?avatar" class="bg-black rounded-full w-1/4 shadow-xl  object-cover aspect-square" alt="profile_img">
        <h3 class="text-lg font-bold"><?php echo $_SESSION['name']?></h3>
        <h3 class="text-lg font-bold"><?php echo $_SESSION['username']?></h3>
         <h3 class="text-lg font-bold"><?php echo $_SESSION['description']?></h3>

    </main>
    
    <?php include ('footer.php') ?>
</body>

</html>