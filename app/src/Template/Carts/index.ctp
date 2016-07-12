<div class="carts index large-9 medium-8 columns content">
    <h3><?= __('Carts') ?></h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('is_ordered') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carts as $cart): ?>
            <tr>
                <td><?= $this->Number->format($cart->id) ?></td>
                <td>
                    <?= $this->Html->link($cart->user->id, [
                        'controller' => 'Users',
                        'action' => 'view', $cart->user->id,
                    ]) ?>
                </td>
                <td><?= $cart->is_ordered ? __('Yes') : __('No'); ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cart->id]) ?>
                    <?php if ($this->request->Session()->read('Auth.User.is_admin') === true): ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cart->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), [
                            'action' => 'delete', $cart->id
                        ],
                        [
                            'confirm' => __('Are you sure you want to delete # {0}?', $cart->id)
                        ]) ?>
                    <?php endif; ?>
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
