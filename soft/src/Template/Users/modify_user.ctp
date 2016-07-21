<?php

echo "<div class = 'row text-center'>";
    echo "<div class='col-xs-12'>";
        echo"<h1>".'Modificar la información de '.$user['name']."</h1>";
    echo"</div>";
echo "</div>";

echo "<br>";
echo "<br>";
echo "<br>";

	echo $this->Form->create($user);
	echo "<div class='form-group'>";
    echo "<div class = 'row'>";
    	echo "<div class = 'col-xs-12 col-md-6'>";

    		echo "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de Usuario', 'value'=>$user['username'], 'maxlength'=> '0'])."</h4>";
				echo "<h4>".$this->Form->input('name', ['class' => 'form-control', 'label'=>'Nombre', 'value'=>$user['name'], 'maxlength'=> '20'])."</h4>";
		    echo "<h4>".$this->Form->input('last_name_1', ['class' => 'form-control','label'=>'Primer Apellido','value'=>$user['last_name_1'], 'maxlength'=> '20'])."</h4>";
				echo "<h4>".$this->Form->input('last_name_2', ['class' => 'form-control','label'=>'Segundo Apellido','value'=>$user['last_name_2'], 'maxlength'=> '20'])."</h4>";


        if($this->request->session()->read('Auth.User.role') == 'admin') {

            echo $this->Form->input('association_id', ['options' => $associations, 'label'=>'Asociación', 'class'=>'form-control']);
            echo $this->Form->input('role', ['options' => $role, 'class'=>'form-control', 'label'=>'Rol']);

        }
		    echo "<h4>".$this->Form->label('Users.blocked','Usuario Bloqueado ');

    	echo "</div>";
    echo "</div>";


    echo $this->Form->checkbox('state', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";

  echo "</div>";


	echo "<div class = 'row'>";
	    echo "<div class = 'col-xs-12'>";    echo "<h4>".$this->Form->submit('Guardar Usuario', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";
	    echo "</div>";
	echo "</div>";

  echo $this->Form->end();




if(($this->request->session()->read('Auth.User.role')) == 'admin'){
    echo "<br>";
    echo "<br>";
    echo "<div class = 'row'>";
    echo $this->Html->link('Cambiar contraseña',['action'=>'reset-password',$this->request->params['pass'][0]],['class'=>'btn btn-danger']);
    echo "</div>";
    echo "</div>";

    echo "<br>";
    echo "<div class='row text-center'>";
      echo "<div class='col-xs-12'>";
    
            echo $this->Html->link(
            'Atrás',
            ['controller' => 'Users', 'action' => 'modify', $user->association_id], ['class'=>'btn btn-primary']
            );

      echo "</div>";
    echo "</div>";
}

if(($this->request->session()->read('Auth.User.role')) == 'rep'){
echo "<br>";
echo "<div class='row text-center'>";
  echo "<div class='col-xs-12'>";

        echo $this->Html->link(
        'Atrás',
        ['controller' => 'Users', 'action' => 'modify'], ['class'=>'btn btn-primary']
        );

  echo "</div>";
echo "</div>";
}?>




<div class="row text-right">
	<div class="col-xs-12">
		<h4 id="callback" style="color:#01DF01"></h4>
	</div>

</div>
