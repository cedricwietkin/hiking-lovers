<form action="/updateprofile" method="post" class="hike_container">
    <div>

        <label for="firstname">First name</label>
        <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>"/>
    </div>
    <div>
        <label for="lastname">Last name</label>
        <input type="text" id="lastname" name="lastname"value="<?= htmlspecialchars($user['lastname']) ?>"/>
    </div>
    <div>
        <label for="nickname">Username</label>
        <input type="text" id="nickname" name="nickname" value="<?= htmlspecialchars($user['nickname']) ?>"/>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" />
    </div>
    <div>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    </div>

    <button type="submit">Update Profile</button>

</form>

