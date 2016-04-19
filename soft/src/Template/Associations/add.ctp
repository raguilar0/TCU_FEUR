<div class = 'row text-center'>
    <div class='col-xs-12'>
        <h1>¡<b>Agregá</b> una nueva Asociación!</h1>
    </div>
</div>

<br>
<br>

<?php

	echo $this->Form->create($association, ['id'=>'submit1']);
	echo "<div class='form-group'>";




    echo "<div class = 'row'>";

    echo "<div class = 'col-xs-12 col-md-4'>";
     echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Asociación', 'maxlength'=> '256', 'placeholder'=>'Ejemplo: Asociación de Estudiantes de Matemáticas'])."</h4>";
    echo "</div >";

    echo "<div class = 'col-xs-6 col-md-4'>";

    echo "<div class='form-group'>";
    echo "<label for='sel1' id = 'sedes_label'>Sedes:</label>";
       echo "<select class='form-control' name = 'headquarter_id' >";

            $headquarter = $association['headquarter'];

            foreach ($headquarter as $key => $value) {
                echo "<option>".$value['name']."</option>"."<br>";
            }
            
        echo "</select>";
    echo "</div>";



    echo "</div >";    

    echo "<div class = 'col-xs-6 col-md-4'>";
      echo $this->Form->button('',['type'=>'button' ,'data-toggle'=>'collapse', 'data-target'=>'#form_headquarter', 'class'=>'glyphicon glyphicon-plus btn btn-success', 'id'=>'addHeadquartersBtn']);
    echo "</div >";


    echo "</div>";






    echo "<h4>".$this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla', 'maxlength'=> '256', 'placeholder'=>'Ejemplo: AEMA'])."</h4>";

   


    //echo "<h4>".$this->Form->input('headquarters', ['class' => 'form-control','label'=>'Sede', 'maxlength'=> '100'])."</h4>";

    echo "<h4>".$this->Form->input('location', ['class' => 'form-control','label'=>'Localización', 'maxlength'=> '1024', 'placeholder'=>'Ejemplo: San Pedro, San José, Costa Rica'])."</h4>";

    echo "<h4>".$this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario', 'maxlength'=> '512', 'placeholder'=>'Ejemplo: 7:00 am - 10:00 pm'])."</h4>";
    

    echo "<h4>".$this->Form->label('Associations.authorized_card','Tarjeta Autorizada ');
    echo "  ";
    echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";


    echo "<div class = 'row'>";

        echo "<div class = 'col-xs-12 text-center col-md-1'>";
            echo $this->Form->button('Asociar Montos',['type'=>'button' ,'data-toggle'=>'collapse', 'data-target'=>'#form_amounts', 'class'=>'btn btn-success', 'id'=>'addAmountsBtn']);
        echo "</div>";
    echo "</div>";





echo "<div class='collapse' id='form_amounts'>";

   echo " <br><br>";

   echo " <h3 style='text-align: center;'> ¡Asociá la información de los <b> montos</b>!</h3><br><br>";
    



        echo "<div class='form-group'>";

        echo "<h4>".$this->Form->input('amount', ['class' => 'form-control','label'=>'Monto','type'=>'number','min'=> '0', 'placeholder'=>'Cantidad a Asignar'])."</h4>";

        echo "<h4>".$this->Form->input('amount_saving', ['class' => 'form-control','label'=>'Monto de Ahorro','type'=>'number','min'=> '0', 'placeholder'=>'Monto a Asignar'])."</h4>";

        echo "<h4>".$this->Form->input('date', ['class' => 'form-control', 'label'=>'Fecha de Inicio de Tracto', 'type'=> 'date', 'id'=>'date_input', 'value'=>$association['date']['date']])."</h4>";

        echo "<h4>".$this->Form->input('deadline', ['class' => 'form-control', 'label'=>'Fecha de Cierre de Tracto', 'type'=> 'date', 'id'=>'date_input', 'value'=>$association['date']['deadline']])."</h4>";        


        echo "</div>";

echo "</div>";









    echo "<div class = 'row'>";
        echo "<div class = 'col-xs-12'>";    echo "<h4>".$this->Form->submit('Guardar Asociación', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";
        echo "</div>";
    echo "</div>";

    echo "</div>";

    echo $this->Form->end();

?>






<div class="collapse" id="form_headquarter">

    <br><br>

    <h3 style="text-align: center;"> ¡Agregá una nueva <b>Sede</b>!</h3><br><br>
    
    <?php

        echo $this->Form->create(null,['url' => ['controller'=>'headquarters', 'action' =>'add'], 'id'=>'submit2']);

        echo "<div class='form-group'>";

        echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Sede', 'maxlength'=> '100', 'placeholder'=>'Ejemplo: Sede Rodrigo Facio'])."</h4>";

        echo "<h4>".$this->Form->input('image_name', ['class' => 'form-control', 'label'=>'Nombre de la imagen', 'maxlength'=> '100', 'placeholder'=>'Ejemplo: facio.jpg'])."</h4>";

        echo "<h4>".$this->Form->submit('Guardar Sede', ['class' => 'form-control', 'id' => 'sede_id'])."</h4>";

        echo "</div>";

        echo $this->Form->end();



    ?>  

</div>




<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"></h4>   
    </div>

</div>

<br>

<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/associations/', ['class'=>'btn btn-primary']);?>
  </div>
</div>

