
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá la Sede!</h1>
    </div>


</div>
<br>
<br>


<?= $this->Form->create($headquarters,['enctype'=>'multipart/form-data']) ?>
<div class="form-group">
    <?php
    echo $this->Form->input('name', ['label'=>'Nombre', 'class'=>'form-control']);
    echo $this->Form->input('file', ['type'=>'file', 'label'=>'Imagen de la sede']);
    ?>
</div>
<br>
<br>
<?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
<?= $this->Form->end() ?>