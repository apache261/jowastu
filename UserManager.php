<?php

/**
 * Class UserManager
 * 
 * This class is responsible for managing users.
 */
class UserManager
{

    // @var object $dbCon The database connection
    private $dbCon;

    public function __construct($myDbCon)
    {
        $this->dbCon = $myDbCon;
    }
    /**
     * Inserts user data into the database.
     *
     * @param string $firstname The user's first name.
     * @param string $lastname The user's last name.
     * @param string $gender The user's gender.
     * @return bool True if the data was inserted successfully, false otherwise.
     */
    public function insertData($firstname, $lastname, $gender)
    {
        $isSuccess = false;
        try{
            $sql = "INSERT INTO user_table (first_name, last_name, gender) VALUE (:first_name, :last_name,:gender)";
            $stmt = $this->dbCon->prepare($sql);
            $insert = $stmt->execute(['first_name' => $firstname, 'last_name' => $lastname, 'gender' => $gender]);
            if($insert){
                $isSuccess = true;
            }
        }catch(PDOException $e){
            echo 'Failed to insert'. $e->getMessage();
        }
        return $isSuccess;
    }

   
    /**
     * Updates the user with the given name and id.
     *
     * @param string $name The name of the user to update.
     * @param int $id The id of the user to update.
     * @return bool True if the user was updated successfully, false otherwise. 
     */
    public function update($name, $id)
    {
        $isSuccess = false;
        try{
            $sql = "UPDATE user_table SET `name` = ? WHERE id = ?";
            $stmt = $this->dbCon->prepare($sql);
            $update = $stmt->execute([$name, $id]);
            if($update){
                $isSuccess = $stmt->rowCount() > 0;
            }
        }catch(PDOException $e){
            echo 'Failed to insert'. $e->getMessage();
        }
        return $isSuccess;
    }
    /**
     * Removes a user with the given ID.
     *
     * @param int $idToDelete The ID of the user to remove.
     * @return bool True if the user was removed successfully, false otherwise.
     */
    public function remove($idToDelete)
    {
        $isSuccess = false;
        try{
            $sql = "DELETE FROM user_table WHERE id = ?";
            $stmt = $this->dbCon->prepare($sql);
            $delete = $stmt->execute([$idToDelete]);
            if($delete){
                $isSuccess = true;
            }
        }catch(PDOException $e){
            echo 'Failed to delete'. $e->getMessage();
        }

        return $isSuccess;
    }

    /**
     * Fetches all users from the database.
     *
     * @return array An array of user objects.
     */
    public function fetchAll()
    {
        $rows = [];

        try{
            $sql = "SELECT * FROM user_table";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();
        }catch(PDOException $e){
            echo 'Failed to display'. $e->getMessage();
        }
        return $rows;
     
    }
      /**
     * Fetches all users from the database.
     *
     * @return array An array of user objects.
     */
    public function fetchUser($id)
    {
        $rows = [];

        try{
            $sql = "SELECT * FROM user_table WHERE id = ? LIMIT 1" ;
            $stmt = $this->dbCon->prepare($sql);
            $stmt->execute([$id]);
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo 'Failed to display'. $e->getMessage();
        }
        return $rows;
     
    }
  

}
