<?php
use Controllers\UserController;
$userController = New UserController();
?>

<h2><?= $hike['name'];?></h2>
<p>Description: <?= $hike['description'];?> </p>
<p>Distance: <?= $hike['distance'] ?></p>
<p>Duration: <?= $hike['duration']?></p>
<p>Elevation gain: <?= $hike['elevation_gain'] ?> </p>
<p>Created by: <?= $userController->findUsernameById($hike['user_id']) ?> </p>
<p>Created at: <?= $hike['created_at']?> </p>
<p>Updated at: <?= $hike['updated_at']?> </p>



<a href="/"> Back to Homepage </a>

