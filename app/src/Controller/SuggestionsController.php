<?php
namespace App\Controller;

use App\Controller\AppController;

class SuggestionsController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['add'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function index()
    {
        $this->paginate = ['contain' => ['Users']];
        $suggestions = $this->paginate($this->Suggestions);

        $this->set(compact('suggestions'));
    }

    public function view($id = null)
    {
        $suggestion = $this->Suggestions->get($id, ['contain' => ['Users']]);

        $this->set('suggestion', $suggestion);
    }

    public function add()
    {
        $suggestion = $this->Suggestions->newEntity();
        if ($this->request->is('post')) {
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            $suggestion['user_id'] = $this->Auth->user('id');
            if ($this->Suggestions->save($suggestion)) {
                $this->Flash->success(__('The suggestion has been saved.'));

                return $this->redirect(['controller' => 'pages', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The suggestion could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('suggestion'));
        $this->set('_serialize', ['suggestion']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $suggestion = $this->Suggestions->get($id);
        if ($this->Suggestions->delete($suggestion)) {
            $this->Flash->success(__('The suggestion has been deleted.'));
        } else {
            $this->Flash->error(__('The suggestion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

