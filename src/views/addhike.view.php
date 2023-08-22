<form action="#" method="post">
    <div>

        <label for="hikename">Hike name</label>
        <input type="text" id="hikename" name="hikename"/>
    </div>
    <div>
        <label for="distance">Distance</label>
        <input type="text" id="distance" name="distance"/>
    </div>
    <div>
        <label for="duration">Duration</label>
        <input type="text" id="duration" name="duration"/>
    </div>
    <div>
        <label for="elevation_gain">Elevation gain</label>
        <input type="text" id="elevation_gain" name="elevation_gain"/>
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description"/>
    </div>

    <div>

    <label for="tags">Select a tag</label>

        <select name="tags" id="tags">
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
             <option value="hard">Hard</option>
  
        </select>

    </div>

    <button type="submit">Add Hike</button>

</form>