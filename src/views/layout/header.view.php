<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">

    <script>
        function confirmDelete() { 
            return confirm("Are you sure you want to delete this hike?");
            }
    </script>
    <title>Hiking Lovers</title>
</head>
<body>
    <header>
        <nav>
            <a href="/"><strong>Hiking Lovers</strong></a>
                <?php if (!empty($_SESSION['user'])): ?>
                    <a href="/profil">Bonjour <?= $_SESSION['user']['nickname'] ?></a>
                    <a href="/addhike">Add a hike</a>
                    <a href="/logout">Logout</a>
                <?php else: ?>
                <div class="buttons">
                    <button><a href="/login">Login</a></button>
                    <button><a href="/register">Register</a></button>
                </div>
                <?php endif; ?>
            <a href="/userlist">All Users</a>
            <a href="/hikes-list">All hikes</a>
        </nav>
    </header>
    <main>

