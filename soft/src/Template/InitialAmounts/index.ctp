
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Administrá los montos iniciales!</h1>
    </div>

</div>
<br>
<br>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('amount',['label'=>'Monto']) ?></th>
            <th><?= $this->Paginator->sort('type',['label'=>'Tipo']) ?></th>
            <th><?= $this->Paginator->sort('date',['label'=>'Fecha de asignación']) ?></th>
            <th><?= $this->Paginator->sort('association_id', ['Asoaciación']) ?></th>
            <th><?= $this->Paginator->sort('tract_id', ['label'=>'Tracto']) ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($initialAmounts as $initialAmount): ?>
            <tr>
                <td><?= "¢ ".number_format($initialAmount->amount,2,".",",")?></td>
                <td><?= $initialAmount->type ? 'Ingresos Generados': 'Tracto' ;?></td>
                <td><?= h($initialAmount->date) ?></td>
                <td><?= $initialAmount->has('association') ? $this->Html->link($initialAmount->association->name, ['controller' => 'Associations', 'action' => 'view', $initialAmount->association->id]) : '' ?></td>
                <td><?= $initialAmount->has('tract') ? $this->Html->link($initialAmount->tract->date." - ".$initialAmount->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $initialAmount->tract->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'view', $initialAmount->id],['class'=>'glyphicon glyphicon-eye-open btn btn-info' ]) ?>
                    <?= $this->Html->link('', ['action' => 'edit', $initialAmount->id],['class'=>'glyphicon glyphicon-pencil btn btn-primary' ]) ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $initialAmount->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger','confirm' => __('Seguro que deseas borrar este monto # {0}?', $initialAmount->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>

