<?php
namespace App\Controllers;

use \Core\View;
use App\Models\Task;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $perPage = 3;
        $totalRows = Task::getCount();
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $perPage;
        $totalPages = ceil($totalRows / $perPage);
        $tasks = Task::getAll($offset,$perPage);
        $adminLogged = (!empty($_SESSION['adminLogged'])) ? 1 : 0;
        View::renderTemplate('Home/index.html',['tasks'=>$tasks,'totalPages'=>$totalPages,'adminLogged'=>$adminLogged]);
    }

    /**
     * saves task
     * depending on id it adds or edits the tasks
     */
    public function saveTaskAction() 
    {
        $data = [];
        foreach($_POST['form_data'] as $post) {
            $data[$post['name']] = $post['value'];
        }
        $task = new Task;
        if(empty($data['id'])) {
            $id = $task->add($data);
        }else{
            $task->edit($data);
            $id = $data['id'];
        }
        echo json_encode(Task::getOne($id));
    }

    /**
     * makes complete or new task action
     */
    public function completeTaskAction()
    {
        if(!empty($_POST)) {
            $task = new Task;
            $task->edit($_POST);
        }
    }

    /**
     * removes tasks action
     */
    public function removeTaskAction()
    {
        $id = $_POST['id'];
        if(!empty($id)) {
            $task = new Task;
            $task->delete($id);
            echo 1;
        }
    }

    /**
     * login with admin
     */
    public function adminLoggedAction(){
        if($_POST['login'] === 'admin' && $_POST['password'] === '123'){
            $_SESSION['adminLogged'] = true;
            header('Location:index.php');
        }
    }

    /**
     * admin logout
     */
    public function adminLogoutAction(){
        session_destroy();
        header('Location:index.php');
    }
}
