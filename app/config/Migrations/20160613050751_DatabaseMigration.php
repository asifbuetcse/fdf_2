<?php
use Migrations\AbstractMigration;

class DatabaseMigration extends AbstractMigration
{
    public function up()
    {

        $this->table('carts')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('is_ordered', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('payment_method', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $this->table('carts_products')
            ->addColumn('cart_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('product_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('quantity', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'cart_id',
                ]
            )
            ->addIndex(
                [
                    'product_id',
                ]
            )
            ->create();

        $this->table('categories')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 42,
                'null' => false,
            ])
            ->create();

        $this->table('comments')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('product_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('body', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'product_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $this->table('products')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('is_food', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('price', 'float', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('category_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('average_rating', 'float', [
                'default' => 0,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('image', 'string', [
                'default' => null,
                'limit' => 60,
                'null' => false,
            ])
            ->addColumn('number', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'category_id',
                ]
            )
            ->create();

        $this->table('ratings')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('product_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'product_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $this->table('suggestions')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('product_name', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $this->table('users')
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 42,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 42,
                'null' => false,
            ])
            ->addColumn('is_admin', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('carts')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('carts_products')
            ->addForeignKey(
                'cart_id',
                'carts',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'product_id',
                'products',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('comments')
            ->addForeignKey(
                'product_id',
                'products',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('products')
            ->addForeignKey(
                'category_id',
                'categories',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('ratings')
            ->addForeignKey(
                'product_id',
                'products',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('suggestions')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('carts')
            ->dropForeignKey(
                'user_id'
            );

        $this->table('carts_products')
            ->dropForeignKey(
                'cart_id'
            )
            ->dropForeignKey(
                'product_id'
            );

        $this->table('comments')
            ->dropForeignKey(
                'product_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('products')
            ->dropForeignKey(
                'category_id'
            );

        $this->table('ratings')
            ->dropForeignKey(
                'product_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('suggestions')
            ->dropForeignKey(
                'user_id'
            );

        $this->dropTable('carts');
        $this->dropTable('carts_products');
        $this->dropTable('categories');
        $this->dropTable('comments');
        $this->dropTable('products');
        $this->dropTable('ratings');
        $this->dropTable('suggestions');
        $this->dropTable('users');
    }
}
