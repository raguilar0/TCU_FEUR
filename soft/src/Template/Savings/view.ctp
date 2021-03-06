<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información del monto de ahorro</h1>
    </div>

</div>
<br>
<br>


    <table class="table">

        <tr>
          <th><?php echo __('Asociación') ?></th>
          <td><?php echo $saving->has('association') ? $this->Html->link($saving->association->name, ['controller' => 'Associations', 'action' => 'view', $saving->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tracto') ?></th>
            <td><?= $saving->has('tract') ? $this->Html->link($saving->tract->date." - ".$saving->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $saving->tract->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Monto asignado') ?></th>
            <td><?= "¢ ".number_format($saving->amount,2,".",",") ?></td>
        </tr>
        <tr>
            <th><?= __('Estado (aprobado/rechazado)') ?></th>
            <td><?php
                switch ($this->Number->format($saving->state)) {
                    case 0:
                        echo "Pendiente";
                        break;
                    case 1:
                        echo "Aceptado";
                        break;
                    case 2:
                        echo "Rechazado";
                        break;
                }

                ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Fecha') ?></th>
            <td><?= h($saving->date) ?></td>
        </tr>

        <tr>
            <th><?= __('Carta') ?></th>
            <td><?= $this->Html->link( $saving->letter,['controller'=>'Savings', 'action'=>'download', $saving->letter]);?></td>
        </tr>
    </table>

    <br>

    <div class="row text-center">
      <div class="col-xs-12">
         <?php
            echo $this->Html->link(
            'Atrás',
            ['controller' => 'Savings', 'action' => 'index'], ['class'=>'btn btn-primary']
            );
          ?>
      </div>
    </div>
