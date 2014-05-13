<?php
class UploadController extends AppController {

    /**
     * Upload a file and set transport and transform settings.
     */
    public function index() {
        $data = $this->request->data;

        if ($this->request->is('post')) {
            $data['Upload']['user_id'] = $this->Auth->user('id');

            try {
                if ($this->Model->save($data, true)) {
                    $this->Model->set($data);
                    $this->AdminToolbar->logAction(ActionLog::CREATE, $this->Model, $this->Model->id);

                    $this->AdminToolbar->setFlashMessage(__d('admin', 'Successfully uploaded a new file'));
                    $this->request->data = array();

                    if ($data[$this->Model->alias]['redirect_to'] === 'read') {
                        $this->redirect(array('plugin' => 'admin', 'controller' => 'crud', 'action' => 'read', 'model' => $this->Model->urlSlug, $this->Model->id));
                    }
                }
            } catch (Exception $e) {
                $this->AdminToolbar->setFlashMessage($e->getMessage(), 'is-error');
            }
        }

        if (empty($this->request->data)) {
            $this->request->data['FileUpload'] = Configure::read('Admin.uploads');
        }
    }

    /**
     * Before filter.
     */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->Model = Admin::introspectModel('Admin.FileUpload');
    }

}