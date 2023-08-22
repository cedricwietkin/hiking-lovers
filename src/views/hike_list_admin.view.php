

<?php if (!empty($hikes)): ?>
  
    <ul>
        <?php foreach($hikes as $hike): ?>
            <div class="hike_container">
            <li>
                <a href="/hike?id=<?= $hike['id'] ?>">
                    <?= $hike['name'] ?><br>
                    Distance: <?= $hike['distance'] ?><br>
                    Duration: <?= $hike['duration'] ?><br>
                    Elevation Gain: <?= $hike['elevation_gain'] ?><br>
                </a>
            </li>

            <div class="buttons">
    <button><a href="/editHike?hike_id=<?= $hike['id']?>">Edit this hike</a> </button>
    <button><a href="/deletehike?id=<?= $hike['id'] ?>" >Delete Hike</a>
</button>
            </div>
            
</div>
        <?php endforeach; ?>

    </ul>
    
    
<?php endif; ?>
