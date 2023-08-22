<h2>My Hikes</h2>
<?php if (!empty($hikes)): ?>

   

<div>
<?php foreach($hikes as $hike): ?>
    <div class=hike_container>


    <p>Name: <?= isset($hike['name']) ? htmlspecialchars($hike['name']) : '' ?></p>
    <p>Distance: <?= isset($hike['distance']) ? htmlspecialchars($hike['distance']) : '' ?></p>
    <p>Duration: <?= isset($hike['duration']) ? htmlspecialchars($hike['duration']) : '' ?></p>
    <p>Elevation Gain: <?= isset($hike['elevation_gain']) ? htmlspecialchars($hike['elevation_gain']) : '' ?></p>
    <p>Description: <?= isset($hike['description']) ? htmlspecialchars($hike['description']) : '' ?></p>
    <p>Tags: <?= isset($hike['tags']) ? htmlspecialchars($hike['tags']) : '' ?></p>

    

    <div class="buttons">
    <button><a href="/editHike?hike_id=<?= $hike['id']?>">Edit this hike</a> </button>
    <button><a href="/deletehike?id=<?= $hike['id'] ?>" >Delete Hike</a>
</button>
</div>




    
</div>
<?php endforeach; ?> 
<?php endif ?>
</div>



