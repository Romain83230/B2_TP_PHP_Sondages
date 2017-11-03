<form method="post" action="index.php?action=Search" class="modal">
    <div class="modal-header">
        <h3>Chercher un ou plusieurs sondages</h3>
    </div>
    <div class="form-horizontal modal-body">

        <div class="control-group">
            <label class="control-label" for="keyword">Mot clé</label>
            <div class="controls">
                <input type="text" name="keyword" placeholder="Mot clé">
            </div>
            <div class="controls">
                <select class="control-label" name="category" style="width: 150px">
                    <?php
                    echo '<option id="categoryFirst" value="category"> --Categorie-- </option>';
                    for ($i = 0; $i < sizeof($this->list); $i++) {

                        echo '<option id="' . $this->list[$i] . '" name="category"  value="' . $this->list[$i] . '"> ' . $this->list[$i] . ' </option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input class="btn btn-danger" type="submit" value="Rechercher"/>
    </div>
</form>
