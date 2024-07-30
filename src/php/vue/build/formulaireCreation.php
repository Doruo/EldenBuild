
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
                <input type="button" id="slotMainHand1" name="slot main hand 1">
                <input type="button" id="slotMainHand2" name="slot main hand 2">
                <input type="button" id="slotMainHand3" name="slot main hand 3">
            </div>

            <div class="equipment-category">
                <h3>Offhand</h3>
                <input type="button" id="slotOffHand1" name="slot off hand 1">
                <input type="button" id="slotOffHand2" name="slot off hand 2">
                <input type="button" id="slotOffHand3" name="slot off hand 3">
            </div>

            <div class="equipment-category">
                <h3>Gear</h3>
                <input type="button" id="slotHelm" name="slot helm">
                <input type="button" id="slotChest" name="slot chest">
                <input type="button" id="slotGauntlet" name="slot gauntlet">
                <input type="button" id="slotLeg" name="slot leg">
            </div>

            <div class="equipment-category">
                <h3>Talismans</h3>
                <input type="button" id="slotTalisman1" class="slotTalisman" name="slot talisman 1">
                <input type="button" id="slotTalisman2" class="slotTalisman" name="slot talisman 2">
                <input type="button" id="slotTalisman3" class="slotTalisman" name="slot talisman 3">
                <input type="button" id="slotTalisman4" class="slotTalisman" name="slot talisman 4">
            </div>

        </div>

    </section>

    <!-- STATS -->
    <section>
        <h2><label>Stats</label></h2>

        <div class="stats">

            <div>
                <h4><label for="vigor">Vigor</label></h4>
                <input type="number" id="vigor" name="vigor" min="1" max="99" value="10">
            </div>

            <div>
                <h4><label for="mind">Mind</label></h4>
                <input type="number" id="mind" name="mind" min="1" max="99" value="10">
            </div>

            <div>
                <h4><label for="endurance">Endurance</label></h4>
                <input type="number" id="endurance" name="endurance" min="1" max="99" value="10">
            </div>

            <div>
                <h4><label for="strength">Strength</label></h4>
                <input type="number" id="strength" name="strength" min="1" max="99" value="10">
            </div>

            <div>
                <h4><label for="dexterity">Dexterity</label></h4>
                <input type="number" id="dexterity" name="dexterity" min="1" max="99" value="10">
            </div>

            <div>
                <h4><label for="intelligence">Intelligence</label></h4>
                <input type="number" id="intelligence" name="intelligence" min="1" max="99" value="10">
            </div>

            <div>
                <h4><label for="faith">Faith</label></h4>
                <input type="number" id="faith" name="faith" min="1" max="99" value="10">
            </div>

            <div>
                <h4><label for="arcane">Arcane</label></h4>
                <input type="number" id="arcane" name="arcane" min="1" max="99" value="10">
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