<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CommentsController extends AppController
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
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comments = TableRegistry::get('Comments');
            $prevComment = $comments->find()->where([
                'Comments.user_id' => $this->Auth->user('id'),
                'Comments.product_id' => $productId,
            ]);
            if (!$prevComment->first()) {
                $comment = $this->Comments->patchEntity($comment, $this->request->data);
                $comment['product_id'] = $productId;
                $comment['user_id'] = $this->Auth->user('id');
                if ($this->Comments->save($comment)) {
                    $this->Flash->success(__('The comment has been saved.'));

                    return $this->redirect(['controller' => 'Products', 'action' => 'index']);
                } else {
                    $this->Flash->error(__('The comment could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->success(__('Sorry, You have already commented in this product.'));

                return $this->redirect(['controller' => 'Products', 'action' => 'index']);
            }
        }

        $this->set(compact('comment', 'users', 'products'));
        $this->set('_serialize', ['comment']);
    }
}
