<?php


namespace App\Controllers;

use App\Controller, App\Models\Article;
use App\MultiException, App\Exceptions\NotFoundException;

class Admin extends Controller
{
    protected function actionDefault()
    {

        $this->view->display('/Admin/Default.html');
    }

    protected function actionEdit($id)
    {

        $this->view->display('/Admin/Edit.html');
    }

    protected function actionNew()
    {

        $this->view->display('/Admin/Edit.html');
    }

    protected function actionSave($id = null)
    {

    }

    protected function actionDelete($id)
    {

        header('Location: /admin/default');
        exit;
    }
}