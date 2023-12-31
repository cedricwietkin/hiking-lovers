
<h2>My profile</h2>

<div class=hike_container>

    <p>First Name: <?= isset($user['firstname']) ? htmlspecialchars($user['firstname']) : '' ?></p>
    <p>Last Name: <?= isset($user['lastname']) ? htmlspecialchars($user['lastname']) : '' ?></p>
    <p>Username: <?= isset($user['nickname']) ? htmlspecialchars($user['nickname']) : '' ?></p>
    <p>Email: <?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?></p>

        <?php if (isset($user['photo'])) : ?>
    <img src="profile_photos/<?= htmlspecialchars($user['photo']) ?>" alt="Profile Photo">
    <?php endif; ?>
</div>

<div class="buttons">
    <button><a href="/editprofile">Edit my profile</a></button>
</div>




<div class="buttons">
    <button><a href="/myhikes">View my hikes</a></button>
</div>
