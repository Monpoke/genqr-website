<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $qrcode->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $qrcode->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Qrcodes'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="qrcodes form large-10 medium-9 columns">
    <?= $this->Form->create($qrcode) ?>
    <fieldset>
        <legend><?= __('Edit Qrcode') ?></legend>
        <?php
            echo $this->Form->input('label');
            echo $this->Form->input('link');
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
