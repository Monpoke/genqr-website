<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Qrcode'), ['action' => 'edit', $qrcode->id]) ?> </li>
        <li><?= $this->Form->postLink(
                __('Delete Qrcode'),
                ['action' => 'delete', $qrcode->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $qrcode->id)]
            ) ?> </li>
        <li><?= $this->Html->link(__('List Qrcodes'), ['action' => 'index']) ?> </li>
    </ul>
</div>
<div class="qrcodes view large-10 medium-9 columns">
    <h2><?= h($qrcode->link);?></h2></h2>

    <div class="row">
        <div class="large-12 columns strings">
            <h6 class="subheader"><?= __('Link') ?></h6>

            <p><?= h($qrcode->link) ?></p>

            <h6 class="subheader"><?= __('QR Code') ?></h6>

            <p>

                <?php echo $this->Html->image(
                    $qrLink,
                    ['alt' => "QRCode"]
                );?>

                <?= $this->Html->link(
                    "Download as PNG",
                    $qrLinkDownload
                ) ?>
            </p>

        </div>

    </div>
</div>
