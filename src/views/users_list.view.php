<div class="container">
    <h1>User List</h1>

    <form method="GET" action="/user">
        <div class="form-group">
            <input type="text" name="search" placeholder="Search by First Name or Nickname">
            <button type="submit">Search</button>
        </div>
    </form>

    <?php if (!empty($users)): ?>
        <ul>
            <?php foreach ($users as $user): ?>
                <li>
                    Firstname: <?= $user['firstname']; ?><br>
                    Lastname: <?= $user['lastname']; ?><br>
                    Nickname: <?= $user['nickname']; ?><br>
                    Email: <?= $user['email']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>