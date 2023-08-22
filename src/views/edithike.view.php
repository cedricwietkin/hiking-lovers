<form action="/updatehike" method="post" class="hike_container">
    <div>

        <label for="name">Hike name</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($hike['name']) ?>"/>
    </div>
    <div>
        <label for="distance">Distance</label>
        <input type="text" id="distance" name="distance"value="<?= htmlspecialchars($hike['distance']) ?>"/>
    </div>
    <div>
        <label for="duration">Duration</label>
        <input type="text" id="duration" name="duration" value="<?= htmlspecialchars($hike['duration']) ?>"/>
    </div>
    <div>
        <label for="elevation_gain">Elevation Gain</label>
        <input type="text" id="elevation_gain" name="elevation_gain" value="<?= htmlspecialchars($hike['elevation_gain']) ?>" />
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description" value="<?= htmlspecialchars($hike['description']) ?>" />
    </div>

    <div>
        <label for="id"></label>
        <input type="hidden" id="hike_id" name="hike_id" value="<?= htmlspecialchars($hike['id']) ?>" />
    </div>

    <div>

    <label for="tags">Select a tag</label>

        <select name="tags" id="tags">
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
             <option value="hard">Hard</option>
  
        </select>

    </div>
    

    <button type="submit">Update Hike</button>

</form>

