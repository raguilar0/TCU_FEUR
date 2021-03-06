<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Administrá las fechas tractos!</h1>
    </div>

</div>
<br>
<br>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('number',['Número de tracto']) ?></th>
                <th><?= $this->Paginator->sort('date',['Fecha de inicio']) ?></th>
                <th><?= $this->Paginator->sort('deadline',['Fecha de finalización']) ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tracts as $tract): ?>
                <tr>
                    <td><?= $this->Number->format($tract->number) ?></td>
                    <td><?= h($tract->date) ?></td>
                    <td><?= h($tract->deadline) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['action' => 'view', $tract->id],['class'=>'glyphicon glyphicon-eye-open btn btn-info' ]) ?>
                        <?= $this->Html->link('', ['action' => 'edit', $tract->id],['class'=>'glyphicon glyphicon-pencil btn btn-primary' ]) ?>
                        <?= $this->Form->postLink('', ['action' => 'delete', $tract->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger','confirm' => __('Estás seguro de que deseas borrar esta fechas # {0}?', $tract->id)]) ?>
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

