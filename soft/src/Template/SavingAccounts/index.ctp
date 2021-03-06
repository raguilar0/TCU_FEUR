
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Administrá las cuentas de ahorro!</h1>
    </div>

</div>
<br>
<br>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('amount',['label'=>'Monto']) ?></th>
            <th><?= $this->Paginator->sort('date',['label'=>'Fecha de asignación']) ?></th>
            <th><?= $this->Paginator->sort('bank',['label'=>'Banco']) ?></th>
            <th><?= $this->Paginator->sort('account_owner',['label'=>'Dueño de la cuenta']) ?></th>
            <th><?= $this->Paginator->sort('card_number',['label'=>'Número de cuenta']) ?></th>
            <th><?= $this->Paginator->sort('association_id',['label'=>'Asociación']) ?></th>
            <th><?= $this->Paginator->sort('tract_id', ['label'=>'Tracto']) ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($savingAccounts as $savingAccount): ?>
            <tr>
                <td><?= "¢ ".number_format($savingAccount->amount,2,".",",") ?></td>
                <td><?= h($savingAccount->date) ?></td>
                <td><?= h($savingAccount->bank) ?></td>
                <td><?= h($savingAccount->account_owner) ?></td>
                <td><?= h($savingAccount->card_number) ?></td>
                <td><?= $savingAccount->has('association') ? $this->Html->link($savingAccount->association->name, ['controller' => 'Associations', 'action' => 'view', $savingAccount->association->id]) : '' ?></td>
                <td><?= $savingAccount->has('tract') ? $this->Html->link($savingAccount->tract->date." - ".$savingAccount->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $savingAccount->tract->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'view', $savingAccount->id],['class'=>'glyphicon glyphicon-eye-open btn btn-info' ]) ?>
                    <?= $this->Html->link('', ['action' => 'edit', $savingAccount->id],['class'=>'glyphicon glyphicon-pencil btn btn-primary' ]) ?>
                    <?= (($this->request->session()->read('Auth.User.role')) == 'admin') ? $this->Form->postLink('', ['action' => 'delete', $savingAccount->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger','confirm' => __('Seguro que desea borrar la cuenta de ahorro # {0}?', $savingAccount->id)]) : '' ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>


</div>
