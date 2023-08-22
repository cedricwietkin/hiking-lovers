<form action="/updateprofile" method="post" enctype="multipart/form-data">
    <div>
        <label for="firstname">First name</label>
        <input type="text" id="firstname" name="firstname"/>
    </div>
    <div>
        <label for="lastname">Last name</label>
        <input type="text" id="lastname" name="lastname"/>
    </div>
    <div>
        <label for="nickname">Username</label>
        <input type="text" id="nickname" name="nickname"/>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email"/>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"/>
    </div>
    div>
    <label for="photo">Profile Photo:</label>
    <input type="file" id="photo" name="photo" accept="image/*">
    </div>

    <button type="submit">Update Profile</button>

    <button type="submit">Register</button>

</form>