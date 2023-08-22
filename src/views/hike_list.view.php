<ul>
    <?php foreach($hikes as $hike): ?>
        <li>
            <a href="/hike?id=<?= $hike['id'] ?>">
                <?= $hike['name'] ?><br>
                Distance: <?= $hike['distance'] ?><br>
                Duration: <?= $hike['duration'] ?><br>
                Elevation Gain: <?= $hike['elevation_gain'] ?><br>
                <ul>
                    <li>Tags:
                        <?php
                        foreach ($hike['tags'] as $tag => $count) {
                            echo $tag . ' (' . $count . '), ';
                        }
                        ?>
                    </li>
                </ul>
            </a>
        </li>
    <?php endforeach; ?>
</ul>