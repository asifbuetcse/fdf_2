<div class="suggestions index large-9 medium-8 columns content">
    <h3><?= __('Suggestions') ?></h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('product_name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suggestions as $suggestion): ?>
            <tr>
                <td><?= $this->Number->format($suggestion->id) ?></td>
                <td>
                    <?= $this->Html->link($suggestion->user->id, [
                        'controller' => 'Users',
                        'action' => 'view',
                        $suggestion->user->id])
                    ?>
                </td>
                <td><?= h($suggestion->product_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $suggestion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), [
                        'action' => 'delete',
                        $suggestion->id
                    ], [
                        'confirm' => __('Are you sure you want to delete # {0}?',
                        $suggestion->id)
                    ]) ?>
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
