<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información de la cuenta de ahorro #<?= h($savingAccount->id) ?></h1>
    </div>

</div>
<br>
<br>

<div class="table-responsive">

    <table class="table">
        <tr>
            <th><?= __('Banco') ?></th>
            <td><?= h($savingAccount->bank) ?></td>
        </tr>
        <tr>
            <th><?= __('Dueño de la tarjeta') ?></th>
            <td><?= h($savingAccount->account_owner) ?></td>
        </tr>
        <tr>
            <th><?= __('Número de cuenta') ?></th>
            <td><?= h($savingAccount->card_number) ?></td>
        </tr>
        <tr>
            <th><?= __('Asociación') ?></th>
            <td><?= $savingAccount->has('association') ? $this->Html->link($savingAccount->association->name, ['controller' => 'Associations', 'action' => 'view', $savingAccount->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tracto') ?></th>
            <td><?= $savingAccount->has('tract') ? $this->Html->link($savingAccount->tract->id, ['controller' => 'Tracts', 'action' => 'view', $savingAccount->tract->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($savingAccount->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Monto') ?></th>
            <td><?= $this->Number->format($savingAccount->amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha') ?></th>
            <td><?= h($savingAccount->date) ?></td>
        </tr>
    </table>
</div>