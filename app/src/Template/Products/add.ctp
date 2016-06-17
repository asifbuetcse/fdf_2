<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product, array('type' => 'file')) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('is_food');
            echo $this->Form->input('price');
            echo $this->Form->input('category_id', ['options' => $categories]);
            echo $this->Form->input('image', array('type' => 'file'));
            echo $this->Form->input('number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
