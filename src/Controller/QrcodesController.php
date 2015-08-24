<?php
namespace App\Controller;

use Cake\Network\Exception\BadRequestException;
use Cake\Routing\Router;

/**
 * Qrcodes Controller
 *
 * @property \App\Model\Table\QrcodesTable $Qrcodes
 */
class QrcodesController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['go']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => [
                'Qrcodes.user_id' => $this->Auth->user('id'),
            ]
        ];
        $this->set('qrcodes', $this->paginate($this->Qrcodes));
        $this->set('_serialize', ['qrcodes']);
    }

    /**
     * View method
     *
     * @param string|null $id Qrcode id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $qrcode = $this->Qrcodes->get(
            $id,
            [
                'contain' => ['Users']
            ]
        );

        // Generate image link
        $qrLink = Router::url(
            [
                'controller' => "qrcodes",
                'action' => 'qr',
                $id
            ]
        );
        $qrLinkDownload = Router::url(
            [
                'controller' => "qrcodes",
                'action' => 'qr',
                $id,
                'download' => 1
            ]
        );


        $this->set('qrLink', $qrLink);
        $this->set('qrLinkDownload', $qrLinkDownload);
        $this->set('qrcode', $qrcode);
        $this->set('_serialize', ['qrcode']);
    }

    /**
     * Displays a QR
     * @param $id
     */
    public function qr($id)
    {
        if (!is_numeric($id)) {
            throw new BadRequestException("Should be an integer.");
        }


        $png = $this->createPNGFile($id);

        /**
         * Have to set correct headers.
         */
        $this->response->type("png");
        $this->response->body($png);
        $this->autoRender = false;

        /**
         * Force download if requested
         */
        if ($this->request->query("download") !== null) {
            $this->response->download("qrcode-" . $id . ".png");
        }

    }

    /**
     * Displays a QR
     * @param $id
     */
    public function go($id)
    {
        $qrcode = $this->Qrcodes->get(
            $id,
            [
                'contain' => ['Users']
            ]
        );

        $this->redirect($qrcode->get("link"));
    }


    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $qrcode = $this->Qrcodes->newEntity();
        if ($this->request->is('post')) {
            $qrcode = $this->Qrcodes->patchEntity($qrcode, $this->request->data);
            $qrcode->user_id = $this->Auth->user('id');

            if ($this->Qrcodes->save($qrcode)) {
                $this->Flash->success(__('The qrcode has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The qrcode could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('qrcode', 'users'));
        $this->set('_serialize', ['qrcode']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Qrcode id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $qrcode = $this->Qrcodes->get(
            $id,
            [
                'contain' => []
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $qrcode = $this->Qrcodes->patchEntity($qrcode, $this->request->data);
            $qrcode->user_id = $this->Auth->user('id');

            if ($this->Qrcodes->save($qrcode)) {
                $this->Flash->success(__('The qrcode has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The qrcode could not be saved. Please, try again.'));
            }
        }
        $users = $this->Qrcodes->Users->find('list', ['limit' => 200]);
        $this->set(compact('qrcode', 'users'));
        $this->set('_serialize', ['qrcode']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Qrcode id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $qrcode = $this->Qrcodes->get($id);
        if ($this->Qrcodes->delete($qrcode)) {
            $this->Flash->success(__('The qrcode has been deleted.'));
        } else {
            $this->Flash->error(__('The qrcode could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * This function creates returns a PNG file.
     * @param $id
     * @return string
     */
    private function createPNGFile($id)
    {
        require_once APP . "libs" . DS . "phpqrcode" . DS . "qrlib.php";

        ob_start();
        $link = Router::url(
            [
                'controller' => "qrcodes",
                'action' => "go",
                $id
            ],
            true
        );

        \QRcode::png($link, false);

        return ob_get_clean();
    }


    /**
     * @param $user
     * @return bool
     */
    public function isAuthorized($user)
    {

        // check action
        $action = $this->request->params['action'];

        // Allows some pages
        if (in_array($action, ['go'])) {
            return true;
        }

        // Other needs authentication
        if (!$this->Auth->user()) {
            return false;
        }

        // Allows some logged pages
        if (in_array($action, ['index', 'add'])) {
            return true;
        }

        // Matchs owner
        $id = $this->request->params['pass'][0];
        $qrcode = $this->Qrcodes->get($id);

        if ($qrcode->user_id == $user['id']) {
            return true;
        }
        return parent::isAuthorized($user);
    }
}
