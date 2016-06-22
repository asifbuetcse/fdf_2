<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ProductsController extends AppController
{
    var $components = ['FileUpload'];

    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['index', 'view'])) {
            return true;
        }
        return parent::isAuthorized($user);
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $products = $this->paginate($this->Products);
        $this->loadModel('Categories');
        $categories = $this->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        if ($this->request->is('post')) {
            $products = TableRegistry::get('Products');
            $query = $products->find();
            $query->where(['Products.name LIKE' => '%' . $this->request->data['name'] . '%']);
            $query->where(['Products.is_food IN' => [$this->request->data['food'], !$this->request->data['drinks']]]);
            if ($this->request->data['lowest_price']) {
                $query->where(['Products.price >= ' => $this->request->data['lowest_price']]);
            }
            if ($this->request->data['highest_price']) {
                $query->where(['Products.price <= ' => $this->request->data['highest_price']]);
            }
            if ($this->request->data['lowest_average_rating']) {
                $query->where(['Products.average_rating >= ' => $this->request->data['lowest_average_rating']]);
            }
            if ($this->request->data['highest_average_rating']) {
                $query->where(['Products.average_rating <= ' => $this->request->data['highest_average_rating']]);
            }
            if ($this->request->data['categories']) {
                $query->where(['Products.category_id' => $this->request->data['categories']]);
            }
            $products = $this->paginate($query);
        }

        $this->set(compact('products'));
        $this->set(compact('categories'));
        $this->set('_serialize', ['products', 'categories']);
    }

    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories', 'Carts', 'Comments', 'Ratings']
        ]);

        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }

    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if (!empty($this->request->data['image']['name'])) {
                $imageFileName = $this->FileUpload->uploadImageToStorage($this->request->data['image']);
                $product->image = $imageFileName;
            }
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $carts = $this->Products->Carts->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories', 'carts'));
        $this->set('_serialize', ['product']);
    }

    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Carts']
        ]);
        $imageFileName = $product->image;
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!empty($this->request->data['image']['name'])) {
                $imageFileName = $this->FileUpload->uploadImageToStorage($this->request->data['image']);
                $this->FileUpload->removeImageFromStorage($product->image);
            }
            $product = $this->Products->patchEntity($product, $this->request->data);
            $product->image = $imageFileName;
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $carts = $this->Products->Carts->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories', 'carts'));
        $this->set('_serialize', ['product']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
