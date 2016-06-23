<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class RatingsController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['add'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function add($productId)
    {
        $rating = $this->Ratings->newEntity();
        if ($this->request->is('post')) {
            $ratings = TableRegistry::get('Ratings');
            $prevRating = $ratings->find()->where([
                'Ratings.user_id' => $this->Auth->user('id'),
                'Ratings.product_id' => $productId,
            ]);
            if (!$prevRating->first()) {
                $rating = $this->Ratings->patchEntity($rating, $this->request->data);
                $rating['product_id'] = $productId;
                $rating['user_id'] = $this->Auth->user('id');
                if ($this->Ratings->save($rating)) {
                    $this->Flash->success(__('The rating has been saved.'));
                    $productsTable = TableRegistry::get('Products');
                    $product = $productsTable->find()->where(['Products.id' => $productId])->first();
                    $product->average_rating = ($product->average_rating + $rating->value) / 2;
                    $productsTable->save($product);

                    return $this->redirect(['controller' => 'Products', 'action' => 'index']);
                } else {
                    $this->Flash->error(__('The rating could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->success(__('Sorry, You have already given rating in this product.'));

                return $this->redirect(['controller' => 'Products', 'action' => 'index']);
            }
        }

        $this->set(compact('rating', 'users', 'products'));
        $this->set('_serialize', ['rating']);
    }
}
