<?php if (!$this->request->Session()->read('Auth.User.is_admin') === true): ?>
    <div class = "panel panel-default">
        <div class = "panel-heading">
            Filters
        </div>
        <div class = "panel-body">
            <div class="products index large-9 medium-8 columns content">
                <?= $this->Form->create() ?>
                <?= $this->Form->input('name') ?>
                <?= $this->Form->input('food', ['type' => 'checkbox']); ?>
                <?= $this->Form->input('drinks', ['type' => 'checkbox']); ?>
                <?= $this->Form->input('lowest_price') ?>
                <?= $this->Form->input('highest_price') ?>
                <?= $this->Form->input('categories', ['options' => $categories, 'empty' => 'Please Select']) ?>
                <?= $this->Form->input('lowest_average_rating') ?>
                <?= $this->Form->input('highest_average_rating') ?>
                <?= $this->Form->button('Submit') ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
    <table class="table tbale-bordered" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('food/drinks') ?></th>
                <th><?= $this->Paginator->sort('price') ?></th>
                <th><?= $this->Paginator->sort('category_id') ?></th>
                <th><?= $this->Paginator->sort('average_rating') ?></th>
                <th><?= $this->Paginator->sort('number') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>
                <td><?= h($product->name) ?></td>
                <?php if($product->is_food): ?>
                    <td><?= h('Food') ?></td>
                <?php else: ?>
                    <td><?= h('Drinks') ?></td>
                <?php endif; ?>
                <td><?= $this->Number->format($product->price) ?></td>
                <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
                <td><?= $this->Number->format($product->average_rating) ?></td>
                <td><?= $this->Number->format($product->number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                    <?php if ($this->request->Session()->read('Auth.User.is_admin') === true): ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
    </div>
</div>
