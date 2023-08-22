<form action="/addtag" method="POST">
    <input type="text" name="tagnameInput" placeholder="Nom du tag" required>
    <button type="submit">Ajouter le tag</button>
</form>

<ul>
    <?php foreach ($tags as $tag): ?>
        <li><?= $tag['name']; ?></li>
    <?php endforeach; ?>
</ul>