
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá una nueva fecha de tracto!</h1>
    </div>

</div>
<br>
<br>


    <?= $this->Form->create($tract) ?>

<div class="form-group">
    <?= $this->Form->input('number', ['class'=>'form-control', 'label'=>'Número de tracto', 'placeholder'=>'Números válidos: 2,3,4,1', 'id'=>'tract_number', 'min'=>'1', 'max'=>'4']); ?>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <label for=".date">Fecha de inicio</label><input type='date' name='date' class='form-control' id='date', onchange='setTractNumber(this)'>
        </div>
        <div class="col-xs-12 col-md-6">
            <label for=".deadline" style="margin-bottom: 15px;">Fecha de finalización</label>
            <input type='date' name='deadline' class='form-control' id='deadline' , onchange='setTractNumber(this)'>
        </div>
    </div>
</div>

<br>
<br>



    <?= $this->Form->button(__('Agregar'),['id'=>'asso_id', 'class'=>'form-control']) ?>
    <?= $this->Form->end() ?>


<?= $this->Html->script('tract_add'); ?>
