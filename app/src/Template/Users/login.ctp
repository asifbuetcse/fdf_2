<div class="users form">
	<?= $this->Flash->render('auth') ?>
	<?= $this->Form->create() ?>
		<fieldset>
			<legend>
				<?= __('please enter name and password') ?>
			</legend>
			<?= $this->Form->input('username') ?>
			<?= $this->Form->input('password') ?>
		</fieldset>
	<?= $this->Form->button(__('Login')) ?>
	<?= $this->Form->end() ?>
</div>
