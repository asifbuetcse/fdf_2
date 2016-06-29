<div class="ratings form large-9 medium-8 columns content">
    <?= $this->Form->create($rating) ?>
    <fieldset>
        <legend><?= __('Add Rating') ?></legend>
        <?php
            echo $this->Form->input('value', [
			    'label' => 'Rating Value',
			    'type' => 'radio',
			    'multiple' => 'checkbox',
			    'options' => [
			    	1 => 'Very Poor',
			    	2 => 'Poor',
			    	3=> 'Moderate',
			    	4=> 'Good',
			    	5 => 'Very Good'
			    ],
			    'selected' => '1',
			    'hiddenField' => false,
		  	]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
