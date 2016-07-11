<div class="suggestions view large-9 medium-8 columns content">
    <h3><?= h($suggestion->id) ?></h3>
    <table class="table table-bordered">
        <tr>
            <th><?= __('User') ?></th>
            <td>
                <?= $this->Html->link($suggestion->user->id, [
                    'controller' => 'Users',
                    'action' => 'view',
                    $suggestion->user->id])
                ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Product Name') ?></th>
            <td><?= h($suggestion->product_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($suggestion->id) ?></td>
        </tr>
    </table>
</div>
