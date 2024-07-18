
<form id="build-form">
    <section>
        <h1><U>- New Build -</U></h1>
    </section>


    <!-- NOM -->
    <section>
        <label for="build-name">Build Name</label>
        <input type="text" id="build-name" name="build-name" required>
    </section>

    <!-- EQUIPEMENT -->
    <section>
        <label>Equipment</label>

        <div class="equipment">

            <div class="equipment-category">
                <h3>Main Hand</h3>
                <input type="button" id="main-hand" name="main-hand">
            </div>

            <div class="equipment-category">
                <h3>Offhand</h3>
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

    <!-- STATS -->
    <section>
        <label>Stats</label>

        <div class="stats">

            <div>
                <label for="vigor">Vigor</label>
                <input type="number" id="vigor" name="vigor" min="1" max="99" value="1">
            </div>

            <div>
                <label for="mind">Mind</label>
                <input type="number" id="mind" name="mind" min="1" max="99" value="1">
            </div>

            <div>
                <label for="endurance">Endurance</label>
                <input type="number" id="endurance" name="endurance" min="1" max="99" value="1">
            </div>

            <div>
                <label for="strength">Strength</label>
                <input type="number" id="strength" name="strength" min="1" max="99" value="1">
            </div>

            <div>
                <label for="dexterity">Dexterity</label>
                <input type="number" id="dexterity" name="dexterity" min="1" max="99" value="1">
            </div>

            <div>
                <label for="intelligence">Intelligence</label>
                <input type="number" id="intelligence" name="intelligence" min="1" max="99" value="1">
            </div>

            <div>
                <label for="faith">Faith</label>
                <input type="number" id="faith" name="faith" min="1" max="99" value="1">
            </div>

            <div>
                <label for="arcane">Arcane</label>
                <input type="number" id="arcane" name="arcane" min="1" max="99" value="1">
            </div>
        </div>
    </section>

    <!-- DESCRIPTION -->
    <section>
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="3"></textarea>
    </section>

    <button type="Save Build">Save</button>
</form>