<?php
use Application\Models\users as um;
require_once '../../includes/config.php';
class usersTest extends PHPUnit_Framework_TestCase
{
    public function testLoginSuccess()
    {
        $_POST['username']  =   'waseem';
        $_POST['password']  =   'test'; 
        $objUsers           =   new um();
        $arr                =   $objUsers->check();
        if(!is_array($arr))
        {
            $login_msg='LOGINFAILED';
        }
        else
        {
            $login_msg='LOGINPASSED';
        }
        $this->assertEquals( 'LOGINPASSED', $login_msg );
        
    }
    
    public function testLoginFailure()
    {
        $_POST['username']='waseem';
        $_POST['password']='tedst'; 
        $objUsers=new um();
        $arr        =   $objUsers->check();        
        $this->assertTrue($arr==false);        
    }
    
    public function testaddUser()
    {
        $_REQUEST['username']  =   'waseemtestabc';
        $_REQUEST['password']  =   'test';                 
        $_REQUEST['user_id']   =   1; 
        $_SESSION['id']     =   $_REQUEST['user_id'];
        
        $objUsers   =   new um();
        $arr        =   $objUsers->addUser(); 
        
        if($arr==false)
        {
            $msg    =   'DUPLICATE';
        }
        else 
        {
            $msg    =   'SUCCESS';         
        }
        
        $this->assertEquals('SUCCESS',$msg);        
    }
    
    public function testeditUser()
    {
        $_REQUEST['username']  =   'waseem1';
        $_REQUEST['password']  =   'test';         
        $_REQUEST['user_id']   =   1; 
        $_SESSION['id']     =   $_REQUEST['user_id'];
        
        $objUsers   =   new um();
        $arr        =   $objUsers->editUser(); 
        
        if($arr==false)
        {
            $msg    =   'DUPLICATE';
        }
        else 
        {
            $msg    =   'SUCCESS';         
        }
        
        $this->assertEquals('SUCCESS',$msg);        
    }
    
    public function testdeleteUser()
    {
        $created_by             =   1;
        $_REQUEST['id']         =   3; 
        $_SESSION['id']         =   1;
        
        $execute=true;
        if($_REQUEST['id']==$_SESSION['id'])
        {
            $execute=false;
            $msg='YOU CANNOT DELETE YOURSELF';
        }
        
        if($_REQUEST['id']==$_SESSION['id'])
        {
            $execute=false;
            $msg='YOU CANNOT DELETE YOURSELF';
        }
        if($created_by!=$_SESSION['id'])
        {
            $execute=false;
            $msg='YOU CANNOT DELETE THIS ENTRY BECAUSE YOU DIDNT CREATE THIS';           
        }
        
        if($execute)
        {
            $objUsers   =   new um();
            $arr        =   $objUsers->deleteUser(); 

            if($arr==true)
            {
                 $msg    =   'SUCCESS';  
            }
            else 
            {
                 $msg    =   'ERROR';     
            }
        }        
        $this->assertEquals('SUCCESS',$msg);        
    }
    
    
}