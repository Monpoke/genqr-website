<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Qrcode'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</div>
<div class="qrcodes index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('label') ?></th>
            <th><?= $this->Paginator->sort('link') ?></th>
            <th><?= $this->Paginator->sort('date', __("Modified")) ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($qrcodes as $qrcode): ?>
        <tr>
            <td><?= $this->Number->format($qrcode->id) ?></td>
            <td><?= (empty($qrcode->label) ? "<em>n/a</em>" :  h($qrcode->label)); ?></td>
            <td><?= h($qrcode->link) ?></td>
            <td><?= h($qrcode->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $qrcode->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $qrcode->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $qrcode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $qrcode->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
