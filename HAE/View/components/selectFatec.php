
<?php
    $fats = $prof->getFats($id);
    var_dump(($fats))
?>

<div class="container">
    <div class="">
        <select class="form-select-secondary" id="opcoes" name="opcoes" style="width: 200px;">
            <option selected disabled>Selecione a Fatec</option>
            <?php
            foreach ($fats as $key => $fat) {
                ?>
                <option value="<?=$fat["id_fat"]?>"><?=$fat["nome_fat"]?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>
