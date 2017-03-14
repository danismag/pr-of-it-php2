<?php


namespace App\Controllers;


use App\Controller;
use App\Models\TagsExtractor;

class Index extends Controller
{
    protected function actionDefault()
    {

    }

    protected function actionFirstTask()
    {
        if (isset($_POST['text'])) {
            $extractor =  new TagsExtractor($_POST['text']);
            $this->view->arrayValues = $extractor->getTagsValue();
            $this->view->arrayTags = $extractor->getTagsDescription();
            $this->view->text = $_POST['text'];
        }
    }

    protected function actionSecondTask()
    {
        if (isset($_POST['text'])) {
            $extractor =  new TagsExtractor($_POST['text']);
            $this->view->keyValues = $extractor->getKeysValue();
            $this->view->text = $_POST['text'];
        }
        
    }

    protected function action404($message = 'Страница не найдена')
    {
        header("Not Found", true, 404);
        $this->view->message = $message;
    }

    protected function action403($message = 'Доступ закрыт')
    {
        header("Access Denied", true, 403);
        $this->view->message = $message;
    }

    protected function actionError($message = 'Ошибка приложения')
    {
        $this->view->message = $message;
    }

}