<?php
namespace App\Controller;

use App\Controller\AppController;

class ProductsController extends AppController
{
    var $components = ['FileUpload'];
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
        $this->set('_serialize', ['products']);
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
