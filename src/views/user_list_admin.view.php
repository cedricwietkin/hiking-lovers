


    <?php foreach ($users as $user): ?>
    <div class="hike_container">

    
    <p>First Name: <?= isset($user['firstname']) ? htmlspecialchars($user['firstname']) : '' ?></p>
    <p>Last Name: <?= isset($user['lastname']) ? htmlspecialchars($user['lastname']) : '' ?></p>
    <p>Username: <?= isset($user['nickname']) ? htmlspecialchars($user['nickname']) : '' ?></p>
    <p>Email: <?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?></p>

    <div class="buttons">
    <button><a href="/editprofile">Edit  profile</a></button>
</div>

<div class="buttons">
    <button><a href="/">Delete profile</a></button>
</div>

    </div>
    <?php endforeach; ?>
    



