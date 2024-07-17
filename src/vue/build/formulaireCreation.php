<form id="build-form">
    <section>
        <label for="build-name">Build Name</label>
        <input type="text" id="build-name" name="build-name" required>
    </section>
    <section>
        <label for="tags">Tags</label>
        <input type="text" id="tags" name="tags" placeholder="Add Tags">
    </section>
    <section>
        <label>Equipment</label>
        <div class="equipment">
            <div class="equipment-category">
                <h3>Main Hand</h3>
                <input type="file" id="main-hand" name="main-hand">
            </div>
            <div class="equipment-category">
                <h3>Off Hand</h3>
                <input type="file" id="off-hand" name="off-hand">
            </div>
            <div class="equipment-category">
                <h3>Gear</h3>
                <input type="file" id="gear" name="gear">
            </div>
            <div class="equipment-category">
                <h3>Talismans</h3>
                <input type="file" id="talismans" name="talismans">
            </div>
        </div>
    </section>
    <section>
        <label>Stats</label>
        <div class="stats">
            <div>
                <label for="vigor">VIG</label>
                <input type="number" id="vigor" name="vigor" min="1" max="99" value="10">
            </div>
            <div>
                <label for="mind">MIND</label>
                <input type="number" id="mind" name="mind" min="1" max="99" value="10">
            </div>
            <div>
                <label for="endurance">END</label>
                <input type="number" id="endurance" name="endurance" min="1" max="99" value="10">
            </div>
            <!-- Ajoutez d'autres statistiques de la même manière -->
        </div>
    </section>
    <section>
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5"></textarea>
    </section>
    <button type="submit">Save</button>
</form>