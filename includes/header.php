<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Exit poll</title>
  </head>
  <body>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Exit Poll</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
        <?php if ( isset( $_SESSION['email'] ) && $_SESSION['is_admin'] == 1): ?>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/exit-poll/create-poll.php">Crea Votazione</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/exit-poll/show-polls.php">Votazioni</a>
            </li>
        </ul>
        <span class="navbar-text">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="#">Ciao <?php echo $_SESSION['name']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/exit-poll/admin.php">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/exit-poll/includes/login.php?logout=1">Logout</a>
                </li>
            </ul>
        </span>
        <?php elseif ( isset( $_SESSION['email'] ) && $_SESSION['is_admin'] == 0): ?>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/exit-poll/show-polls.php">Votazioni</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Ciao <?php echo $_SESSION['name']; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/exit-poll/includes/login.php?logout=1">Logout</a>
            </li>
        </ul>
        <?php else : ?>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/exit-poll/public-polls.php">Votazioni Pubbliche</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/exit-poll/login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/exit-poll/register.php">Registrati</a>
            </li>
         </ul>
        <?php endif; ?>
        </div>
    </div>
</nav>