<?php if(!is_null($tract)):?>

<div class="row text-center">
    <div class="col-xs-12">
        <h1 id="association_name"></h1>

        <h3><?php
                echo "<h1>¡Agregá un nuevo monto!</h1>";
         ?>
         </h3>
    </div>
</div>

<br>
<br>

 <div class="row text-center">
     <?php


        echo $this->Form->create($amount);

     echo "<div class = 'col-xs-12'>";

         echo "<label'><h4><strong>Monto</strong></h4></label>";
         echo "<div class='input-group'>";
             echo "<span class='input-group-addon' >₡</span>";
                echo $this->Form->input('amount', ['class' => 'form-control','label'=>false, 'placeholder'=>'Ejemplo: 500000']);
             echo "<span class='input-group-addon'>.00</span>";
         echo "</div >";
     echo "</div >";

     ?>
 </div>


<br>
<br>
<br>
<br>

<?php

    echo "<div class='form-group'>";
        echo "<div class='row text-center'>";
            echo "<div class='col-xs-12'>";

                echo "<h4>".$this->Form->input('detail', ['class' => 'form-control', 'required', 'label'=>'Detalle'])."</h4>";
            echo "</div>";
        echo "</div>";
?>

<br>
<br>
<br>

<?php
         echo "<div class='row text-center'>";
            echo "<div class = 'col-xs-12'>";
                echo "<h4>".$this->Form->submit('Guardar Monto', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id'])."</h4>";
            echo "</div>";
        echo "</div>";


    echo "</div>";

    echo $this->Form->end();


?>

<?php endif; if(is_null($tract)){echo "<h2>Aún no se asigna la fecha del tracto actual. Comuníquese con la contraloría para mayor información.</h2>";}?>

<br>
<div class="row text-center">
    <div class="col-xs-12">
        <?php
        echo $this->Html->link(
            'Atrás',
            ['controller' => 'Amounts', 'action' => 'index'], ['class'=>'btn btn-primary']
        );
        ?>
    </div>
</div>
