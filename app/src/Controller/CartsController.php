<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class CartsController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['index', 'view', 'orderNow', 'remove'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function index()
    {
        $carts = TableRegistry::get('Carts');
        $query = $carts->find();
        if ($this->Auth->user('is_admin') === false) {
            $query->where(['Carts.user_id' => $this->Auth->user('id')]);
        }

        $this->paginate = ['contain' => ['Users']];
        $carts = $this->paginate($query);

        $this->set(compact('carts'));
        $this->set('_serialize', ['carts']);
    }

    public function view($id = null)
    {
        $cart = $this->Carts->get($id, ['contain' => ['Users', 'Products']]);

        $this->set('cart', $cart);
        $this->set('_serialize', ['cart']);
    }

    public function edit($id = null)
    {
        $cart = $this->Carts->get($id, ['contain' => ['Products']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cart = $this->Carts->patchEntity($cart, $this->request->data);
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('The cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cart could not be saved. Please, try again.'));
            }
        }

        $users = $this->Carts->Users->find('list', ['limit' => 200]);
        $products = $this->Carts->Products->find('list', ['limit' => 200]);
        $this->set(compact('cart', 'users', 'products'));
        $this->set('_serialize', ['cart']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cart = $this->Carts->get($id);
        if ($this->Carts->delete($cart)) {
            $this->Flash->success(__('The cart has been deleted.'));
        } else {
            $this->Flash->error(__('The cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function orderNow($id)
    {
        $cart = $this->Carts->get($id);
        $cart->is_ordered = 1;
        if ($this->Carts->save($cart)) {
            $this->Flash->success(__('Your Order has been Registered.'));
        } else {
            $this->Flash->error(__('The cart could not be ordered. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function removeProduct($cartId, $productId)
    {
        $connection = ConnectionManager::get('default');
        $cart = $this->Carts->get($cartId);
        if (!$cart->is_ordered) {
            $connection->delete('carts_products', ['cart_id' => $cartId, 'product_id' => $productId]);
            $this->Flash->success(__('Product removed from your cart.'));
        } else {
            $this->Flash->error(__('This product cannot be removed.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
