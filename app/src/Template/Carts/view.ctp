<div class="carts view large-9 medium-8 columns content">
    <h3><?= h($cart->id) ?></h3>
    <table class="table table-bordered">
        <tr>
            <th><?= __('User') ?></th>
            <td>
                <?= $this->Html->link($cart->user->id, [
                    'controller' => 'Users',
                    'action' => 'view', $cart->user->id
                ]) ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($cart->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Payment Method') ?></th>
            <td><?= $this->Number->format($cart->payment_method) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Ordered') ?></th>
            <td><?= $cart->is_ordered ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <?php if (!$cart->is_ordered): ?>
        <?= $this->Html->link('Order Now', ['controller' => 'Carts', 'action' => 'orderNow', $cart->id]); ?>
    <?php endif; ?>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($cart->products)): ?>
        <table class="table table-bordered">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Is Food') ?></th>
                <th><?= __('Price') ?></th>
                <th><?= __('Category Id') ?></th>
                <th><?= __('Average Rating') ?></th>
                <th><?= __('Image') ?></th>
                <th><?= __('Number') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($cart->products as $products): ?>
            <tr>
                <td><?= h($products->id) ?></td>
                <td><?= h($products->name) ?></td>
                <td><?= $products->is_food ? __('Food') : __('Drinks'); ?></td>
                <td><?= h($products->price) ?></td>
                <td><?= h($products->category_id) ?></td>
                <td><?= h($products->average_rating) ?></td>
                <td><?= h($products->image) ?></td>
                <td><?= h($products->number) ?></td>
                <td class="actions">
                    <?= $this->Html->link('Remove', [
                        'controller' => 'Carts',
                        'action' => 'removeProduct', $cart->id, $products->id
                    ]); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
