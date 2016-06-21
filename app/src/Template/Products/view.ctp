<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->name) ?></h3>
    <table class="table table-bordered">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Category') ?></th>
            <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <?php if (!empty($product->image)): ?>
                <td><?= $this->Html->image($product->image, ['width' => '300px', 'height' => '200px']); ?></td>
            <?php else: ?>
                <td><?= __('No Image Available') ?></td>
            <?php endif; ?>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($product->price) ?></td>
        </tr>
        <tr>
            <th><?= __('Average Rating') ?></th>
            <td><?= $this->Number->format($product->average_rating) ?></td>
        </tr>
        <tr>
            <th><?= __('Number') ?></th>
            <td><?= $this->Number->format($product->number) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Food') ?></th>
            <td><?= $product->is_food ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Comments') ?></h4>
        <?php if (!empty($product->comments)): ?>
        <table class="table table-bordered" cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Product Id') ?></th>
                <th><?= __('Body') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->comments as $comments): ?>
            <tr>
                <td><?= h($comments->id) ?></td>
                <td><?= h($comments->user_id) ?></td>
                <td><?= h($comments->product_id) ?></td>
                <td><?= h($comments->body) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Ratings') ?></h4>
        <?php if (!empty($product->ratings)): ?>
        <table class="table table-bordered" cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Product Id') ?></th>
                <th><?= __('Value') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->ratings as $ratings): ?>
            <tr>
                <td><?= h($ratings->id) ?></td>
                <td><?= h($ratings->user_id) ?></td>
                <td><?= h($ratings->product_id) ?></td>
                <td><?= h($ratings->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ratings', 'action' => 'view', $ratings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ratings', 'action' => 'edit', $ratings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ratings', 'action' => 'delete', $ratings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
