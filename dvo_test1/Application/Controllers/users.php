<?php
namespace Application\Controllers;
use Application\Lib\Template as T;
use Application\Models\users as UsersModel;
class users
{
    private $params = array();
    function __construct($params) 
    {
        $this->params   =   $params;
    }
    public function login()
    {
        $objT=new T($this->params);  
        $objT->show('login');
        
    }
    public function confirm()
    {
        $objUsersModel  =   new UsersModel();
        $result         =   $objUsersModel->check();
        if(!$result)
        {   
           header('Location:'.BASE_URL.'/users/login/Username or Password is wrong');exit;            
        }
        else
        {
            $_SESSION['id']         =	$result['id'];
            $_SESSION['username']   =	$result['username'];             
            header('Location:'.BASE_URL.'/users/listusers');exit;
        }
    }
    
    public function listusers()
    {  
        if(!isset($_SESSION['id']))
        {
            header('location:'.BASE_URL.'/users/login');exit;
        }
        $objUsersModel  =   new UsersModel();
        $usersArray=$objUsersModel->getAllUsers();
        if(isset($this->params[2]))
        {
            $usersArray[0]['msg']=$this->params[2];
        }
        $objT=new T($usersArray);
        $objT->main('users');        
    }
    public function edituserview()
    {   
        if(!isset($_SESSION['id']))
        {
            header('location:'.BASE_URL.'/users/login');exit;
        }
        $objUsersModel  =   new UsersModel();
        $usersArray	=   $objUsersModel->getSingleUser($this->params[2]);
        if(isset($this->params[3]))
        {
            $usersArray[0]['msg']=$this->params[3];
        }
        $objT           =   new T($usersArray);
        $objT->main('edituser');        
    }
    
    public function edituserindb()
    {  
        $objUsersModel  =   new UsersModel();
        if($objUsersModel->editUser()==false)
        {
            header('location:'.BASE_URL.'/users/edituserview/'.$_REQUEST['user_id'].'/Username Already Exists');exit;
        }
        else 
        {
           header('location:'.BASE_URL.'/users/listusers');exit; 
        }
     
    }
    
    public function adduserview()
    {   
        if(!isset($_SESSION['id']))
        {
            header('location:'.BASE_URL.'/users/login');exit;
        }
        $objT           =   new T($this->params);
        $objT->main('adduser');        
    }
    
    public function adduserindb()
    {  
        $objUsersModel  =   new UsersModel();
        if($objUsersModel->addUser()==false)
        {
            header('location:'.BASE_URL.'/users/adduserview/Username Already Exists');exit;
        }
        else 
        {
           header('location:'.BASE_URL.'/users/listusers');exit; 
        }
     
    }
    public function deleteuser()
    {
        $id     =   $this->params[2];        
        if($id==$_SESSION['id'])
        {
             header('location:'.BASE_URL.'/users/listusers/You Cannot delete yourself');exit; 
        }
        $objUsersModel	=	new UsersModel();
        $usersArray	=	$objUsersModel->getSingleUser($id);
        if($usersArray[0]['created_by']!=$_SESSION['id'])
        {
            header('location:'.BASE_URL.'/users/listusers/You Cannot delete this entry because you  didnt create it');exit; 
        }

        if($objUsersModel->deleteUser($id))
        {
           header('location:'.BASE_URL.'/users/listusers');exit;  
        }

    }
    
 
}
?>
