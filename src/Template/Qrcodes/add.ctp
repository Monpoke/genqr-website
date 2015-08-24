<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Qrcodes'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="qrcodes form large-10 medium-9 columns">
    <?= $this->Form->create($qrcode) ?>
    <fieldset>
        <legend><?= __('Add Qrcode') ?></legend>
        <?php
            echo $this->Form->input('label');
            echo $this->Form->input('link');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
