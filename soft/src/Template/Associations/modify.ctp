

<div class = 'row text-center'>
    <div class='col-xs-12'>
        <h1>¡Acá podés <b>Modificar</b> la Asociación!</h1>
    </div>
</div>

<br>
<br>

<?php
	echo $this->Form->create($data, ['id'=>'submit3']);
	echo "<div class='form-group'>";



    echo "<div class = 'row'>";

   echo "<div class = 'col-xs-12 col-md-6'>";
    echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Asociación', 'value'=>$data['name'], 'maxlength'=> '256'])."</h4>";
    echo "</div>";


    echo "<div class = 'col-xs-6 col-md-4'>";

        echo "<div class='form-group'>";
        echo "<label for='sel1' id = 'sedes_label'>Sedes:</label>";
           echo "<select class='form-control' name = 'headquarter_id' onchange = 'evaluateOnchangeSelect()'>";

                $headquarter = $data['headquarter'];



                foreach ($headquarter as $key => $value) {
                    echo "<option>".$value['name']."</option>"."<br>";
                }
                
            echo "</select>";
        echo "</div>";
    echo "</div >";  


     echo "<div class = 'col-xs-6 col-md-2'>";
      echo $this->Form->button('',['type'=>'button' ,'data-toggle'=>'collapse', 'data-target'=>'#form_headquarter', 'class'=>'glyphicon glyphicon-pencil btn btn-primary collapsed', 'id'=>'addHeadquartersBtn', 'onclick'=>'evaluateOnclickPenciModify()']);
    echo "</div >";
    
    echo "</div>";

    echo "<h4>".$this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla', 'value'=>$data['acronym'], 'maxlength'=> '256'])."</h4>";



    echo "<h4>".$this->Form->input('location', ['class' => 'form-control','label'=>'Localización','value'=>$data['location'], 'maxlength'=> '1024'])."</h4>";

    echo "<h4>".$this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario','value'=>$data['schedule'], 'maxlength'=>'512'])."</h4>";

    echo "<h4>".$this->Form->label('Associations.authorized_card','Tarjeta Autorizada ');
    echo "  ";

    if($data['authorized_card'] == 0)
    {
    	echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";
    }
    else
    {
    	echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline', 'checked'])."</h4>";
    }


    echo "</div>";

 	echo "<h4>".$this->Form->submit('Actualizar Asociación', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";

    echo "<div class = 'col-xs-6 col-md-2'>";
      echo "Montos";
      echo $this->Form->button('',['type'=>'button' ,'data-toggle'=>'collapse', 'data-target'=>'#form_amounts', 'class'=>'glyphicon glyphicon-pencil btn btn-primary collapsed', 'id'=>'addAmountsBtn', 'onclick'=>'evaluateOnclickPenciModify()']);
    echo "</div >";

    echo $this->Form->end();
?>


<div class="collapse" id="form_headquarter">

    <br><br>

    <h3 style="text-align: center;"> ¡Podés <b>modificar la Sede</b> también!</h3><br><br>
    
    <?php

        echo $this->Form->create(null,['url'=>[ 'controller'=>'headquarters','action'=>'verify'], 'id'=>'submit4']);

        echo "<div class='form-group'>";

        echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Sede', 'maxlength'=> '100', 'id'=>'headquarter_name'])."</h4>";

        echo "<h4>".$this->Form->input('image_name', ['class' => 'form-control', 'label'=>'Nombre de la imagen', 'maxlength'=> '100', 'id'=>'image_name'])."</h4>";

        //echo "<h4>".$this->Form->submit('Guardar Sede', ['class' => 'form-control', 'id' => 'sede_id'])."</h4>";

        echo "<div class='row'>";
            echo "<div class = 'col-xs-12 col-md-6'>";
                echo "<h4>".$this->Form->submit('Actualizar', ['class' => 'form-control btn btn-primary', 'id' => 'sede_update_id_btn', 'onclick'=>'modifyHeadquarter()'])."</h4>";
            echo "</div>";

            echo "<div class = 'col-xs-12 col-md-6'>";
                echo "<h4>".$this->Form->submit('Eliminar', ['class' => 'form-control btn btn-danger', 'id' => 'sede_delete_id_btn', 'onclick'=>'deleteHeadquarter()'])."</h4>";
            echo "</div>";

        echo "</div>";

        echo "</div>";

        echo $this->Form->end();



    ?>  

</div>


<div class="collapse" id="form_amounts">

    <br><br>

    <h3 style="text-align: center;"> Modifica los montos</h3><br><br>
    
    <?php
    
    echo $this->Form->create($amount);
	
	/*
	echo "<div class='form-group'>";
	    echo "<div class = 'col-xs-6 col-md-4'>";
        echo "<div class='form-group'>";
        echo "<label for='sel1' id = 'sedes_label'>Sede:</label>";
        echo "<select class='form-control' name = 'headquarter_id' >";
            $headquarter = $association['headquarter'];
                foreach ($headquarter as $key => $value) {
                    echo "<option>".$value['name']."</option>"."<br>";
                }
            
        echo "</select>";
        echo "</div>";
    echo "</div >";    
    */
    echo "<h4>".$this->Form->input('amount', ['class' => 'form-control', 'label'=>'Monto Máximo'])."</h4>";
    echo "<h4>".$this->Form->input('date', ['class' => 'form-control','label'=>'fecha del tracto'])."</h4>";
    echo "<h4>".$this->Form->input('deadline', ['class' => 'form-control','label'=>'Fecha de cierre'])."</h4>";
    echo "<h4>".$this->Form->submit('Guardar Monto', ['class' => 'form-control', 'id' => 'amount_id'])."</h4>";
    echo "</div>";

    echo $this->Form->end();


    ?>  

</div>

<!--Carga las respuestas del JQuery en el callback-->
<div class="row text-right">
	<div class="col-xs-12">
		<h4 id="callback" style="color:#01DF01"></h4>	
	</div>

</div>


<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/associations/show_associations/3', ['class'=>'btn btn-primary']);?>
  </div>
</div>