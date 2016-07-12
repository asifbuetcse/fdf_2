<div class="carts form large-9 medium-8 columns content">
    <?= $this->Form->create($cart) ?>
    <fieldset>
        <legend><?= __('Edit Cart') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('is_ordered');
            echo $this->Form->input('payment_method');
            echo $this->Form->input('products._ids', ['options' => $products]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
