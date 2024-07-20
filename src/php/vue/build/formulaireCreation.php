
<form id="build-form">
    <section>
        <h1><U>- New Build -</U></h1>
    </section>


    <!-- NOM -->
    <section>
        <h2><label for="build-name">Build Name</label></h2>
        <input type="text" id="build-name" name="build-name" required>
    </section>

    <!-- EQUIPEMENT -->
    <section>
        <h2><label>Equipment</label></h2>

        <div class="equipment">

            <div class="equipment-category">
                <h3>Main Hand</h3>
                <input type="button" id="main-hand" name="main-hand">
                <input type="button" id="main-hand" name="main-hand">
                <input type="button" id="main-hand" name="main-hand">
                <input type="button" id="main-hand" name="main-hand">
                <input type="button" id="main-hand" name="main-hand">
                <input type="button" id="main-hand" name="main-hand">
                <input type="button" id="main-hand" name="main-hand">
            </div>

            <div class="equipment-category">
                <h3>Offhand</h3>
                <input type="button" id="off-hand" name="off-hand">
                <input type="button" id="off-hand" name="off-hand">
                <input type="button" id="off-hand" name="off-hand">
                <input type="button" id="off-hand" name="off-hand">
                <input type="button" id="off-hand" name="off-hand">
                <input type="button" id="off-hand" name="off-hand">
            </div>

            <div class="equipment-category">
                <h3>Gear</h3>
                <input type="button" id="gear" name="gear">
                <input type="button" id="gear" name="gear">
                <input type="button" id="gear" name="gear">
                <input type="button" id="gear" name="gear">
            </div>

            <div class="equipment-category">
                <h3>Talismans</h3>
                <input type="button" id="talismans" name="talismans">
                <input type="button" id="talismans" name="talismans">
                <input type="button" id="talismans" name="talismans">
                <input type="button" id="talismans" name="talismans">
            </div>

        </div>

    </section>

    <!-- STATS -->
    <section>
        <h2><label>Stats</label></h2>

        <div class="stats">

            <div>
                <h4><label for="vigor">Vigor</label></h4>
                <input type="number" id="vigor" name="vigor" min="1" max="99" value="1">
            </div>

            <div>
                <h4><label for="mind">Mind</label></h4>
                <input type="number" id="mind" name="mind" min="1" max="99" value="1">
            </div>

            <div>
                <h4><label for="endurance">Endurance</label></h4>
                <input type="number" id="endurance" name="endurance" min="1" max="99" value="1">
            </div>

            <div>
                <h4><label for="strength">Strength</label></h4>
                <input type="number" id="strength" name="strength" min="1" max="99" value="1">
            </div>

            <div>
                <h4><label for="dexterity">Dexterity</label></h4>
                <input type="number" id="dexterity" name="dexterity" min="1" max="99" value="1">
            </div>

            <div>
                <h4><label for="intelligence">Intelligence</label></h4>
                <input type="number" id="intelligence" name="intelligence" min="1" max="99" value="1">
            </div>

            <div>
                <h4><label for="faith">Faith</label></h4>
                <input type="number" id="faith" name="faith" min="1" max="99" value="1">
            </div>

            <div>
                <h4><label for="arcane">Arcane</label></h4>
                <input type="number" id="arcane" name="arcane" min="1" max="99" value="1">
            </div>
        </div>
    </section>

    <!-- DESCRIPTION -->
    <section>
        <h2><label for="description">Description</label></h2>
        <textarea id="description" name="description" rows="5"></textarea>
    </section>

    <button type="Save Build">Save</button>
</form>