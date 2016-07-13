<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->username) ?></h3>
    <table class="table table-bordered">
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Admin') ?></th>
            <td><?= $user->is_admin ? __('Admin') : __('Member'); ?></td>
        </tr>
    </table>
    <p><?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?></p>
    <?php if ($this->request->Session()->read('Auth.User.is_admin') === true): ?>
        <p><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?></p>
    <?php endif; ?>
</div>
