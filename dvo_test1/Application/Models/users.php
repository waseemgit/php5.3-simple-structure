<?php
namespace Application\Models;
use Application\Db\db;
use PDO;
class users
{
    public function getAllUsers()
    {
        $db = db::getInstance();					
        $deleted=0;
        $sql_Users="SELECT * FROM ".USERS_TABLE." WHERE deleted=:deleted AND (created_by=:created_by OR id=:id) ORDER BY id";
        $stmt = $db->prepare($sql_Users);					
        $stmt->bindParam(":deleted"   , $deleted);
         $stmt->bindParam(":created_by"   , $_SESSION['id']);
         $stmt->bindParam(":id"           , $_SESSION['id']);
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }	
    public function getCountUser($username,$password)
    {
        $db = db::getInstance();
        $limit=1;
        $sql = "SELECT * FROM ".USERS_TABLE." WHERE username = :username AND password = :password LIMIT :limit";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":username"   , $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result=array(
                        'data'      =>	$stmt->fetchAll(PDO::FETCH_ASSOC),
                        'total'	=>	$stmt->rowCount()
                    );		
        return $result;

    }
    public function getSingleUser($user_id)
    {
            $db = db::getInstance();
            $sql = "SELECT * 							
                            FROM  ".USERS_TABLE."   WHERE id = :user_id  LIMIT :limit ";	
            $stmt = $db->prepare($sql);
            $limit=1;
            $stmt->bindParam(":user_id"   , $user_id);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);	
            $stmt->execute();	
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    }


    public function addUser()
    {	        
        $db = 	db::getInstance();
        $sql = "SELECT * FROM ".USERS_TABLE." WHERE username=:username LIMIT :limit";	
        $stmt = $db->prepare($sql);
        $limit=1;
        $stmt->bindParam(":username" , $_REQUEST['username']);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);			
        $stmt->execute();

        $total = $stmt->rowCount();

        if($total > 0)
        {
            return false;
        }


        $sql = "INSERT INTO ".USERS_TABLE." SET
                                        username    =:username,
                                        password    =:password,                                                       	
                                        created_by  =:created_by,								
                                        date_created= NOW(),
                                        updated_by  = :modified_by,
                                        date_updated = NOW()";
        $modified_by    =	$_SESSION['id'];
        $created_by	=	$_SESSION['id'];


        $stmt   = $db->prepare($sql);		
        $pwd    =   md5($_REQUEST['password']);
        $uname  =   $_REQUEST['username'];
        $stmt->bindParam(":username"   ,  $uname);		
        $stmt->bindParam(":password"   ,  $pwd);				
        $stmt->bindParam(":created_by" ,  $created_by);	
        $stmt->bindParam(":modified_by",  $modified_by);	
        return $stmt->execute();


    }


    public function editUser()
    {
        $db 		=   db::getInstance();
        $sql 		=   "SELECT * FROM ".USERS_TABLE." WHERE username = :username AND id <> :id LIMIT :limit";	
        $stmt 		=   $db->prepare($sql);
        $limit		=   1;
        $stmt->bindParam(":username" 	, $_REQUEST['username']);
        $stmt->bindParam(":id"   	, $_REQUEST['user_id']);
        $stmt->bindParam(':limit'	, $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total = $stmt->rowCount();

        if($total > 0)
        {
            return false;
        }

        $sql = "UPDATE ".USERS_TABLE." SET
                                    username    = :username,
                                    password    = :password,
                                    updated_by  = :modified_by,
                                    date_updated = NOW()
                                WHERE id= :user_id";


        $modified_by	=	$_SESSION['id'];
        $stmt = $db->prepare($sql);	
        $pwd=md5($_REQUEST['password']);
        $stmt->bindParam(":user_id"   ,  $_REQUEST['user_id']);
        $stmt->bindParam(":username"   ,  $_REQUEST['username']);		
        $stmt->bindParam(":password"   ,  $pwd);				
        $stmt->bindParam(":modified_by",  $modified_by);			
        return $stmt->execute();


    }
    public function deleteUser($id)
    {
        $db 	= 	db::getInstance();
        $sql 	= 	"UPDATE ".USERS_TABLE." SET
                                            deleted  	= :deleted,
                                            updated_by  = :modified_by,
                                            date_updated= NOW()
                                            WHERE id = :id LIMIT :limit
                                            ";
        $limit      =   1;
        $deleted    =   1;
        $modified_by=   $_SESSION['id'];
        $stmt = $db->prepare($sql);		
        $stmt->bindParam(":id"   		,  $id);		
        $stmt->bindParam(":deleted"   		,  $deleted);
        $stmt->bindParam(":modified_by"   	,  $modified_by);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);        
        return $stmt->execute();	
    }

    public function check()
    {
        $db=db::getInstance();
        $username=isset($_POST['username'])?$_POST['username'] : '';
        $password=isset($_POST['password'])?$_POST['password'] : '';
        $password   =   md5($password);
        $limit      =   1;
        $userArray  =   $this->getCountUser($username, $password);
        $total      =   $userArray['total'];
        if($total == 0)
        {
            return false;
        }
        else
        {
            return array(
                            'id'        =>  $userArray['data'][0]['id'],
                            'username'  =>  $userArray['data'][0]['username']
                        );                
        }

    }

}
?>
