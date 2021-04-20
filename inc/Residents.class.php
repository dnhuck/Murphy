<?php 

class Residents {
    var $burialsData = array();    // hold data from array
    var $errors = array();          // for errors
    var $db = null;
    var $errMessage ="";
    var $message ="";



    function __construct() {
        // create a connection to our database
        $this->db = new PDO('mysql:host=localhost;dbname=murphy;charset=utf8', 
            'root', '');           
    }

    // takes a keyed array and sets our internal data representation to the array
    function set($dataArray)
    {
        $this->burialsData = $dataArray;
;
    }

    function logout() {
        session_start();	//provide access to the current session
        session_unset();	//remove all session variables related to current session
        session_destroy();	//remove current session
        $this->message = "You were logged out.";
    }// end logout



    function login($userName,$userPW) {
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE user_name = ? AND user_password = ?");
        $stmt->execute(array($userName, $userPW));
       
        if ($stmt->rowCount() == 1) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            
            if ($row['username'] === $userName) {
                $_SESSION['user'] = $row['userId'];				//this is a valid user so set your SESSION variable
                $_SESSION['validUser'] = true;	
                $this->message = "Welcome Back! $userName";	
            }
            else {
                $_SESSION['validUser'] = false;					
                $this->errMessage = "Sorry, there was a problem with your username or password. Please try again.";		
            }
        }
        else {
            $_SESSION['validUser'] = false;					
            $this->errMessage = "Sorry, there was a problem with your username or password. Please try again.";		
        }   
    }// end login



    // santize the data in the passed array, return the array
    function sanitize($dataArray) { // convert for residents
        // sanitize data based on rules  
        $this->residentData['burials-first-name']=filter_var($this->residentData['burials-first-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-middle-name']=filter_var($this->residentData['burials-middle-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-last-name']=filter_var($this->residentData['burials-last-name'],FILTER_SANITIZE_STRING);
        // $this->residentData['burials-dob']=filter_var($this->residentData['burials-dob'],FILTER_SANITIZE_ENCODED); 
        $this->residentData['burials-birth-year']=filter_var($this->residentData['burials-birth-year'],FILTER_VALIDATE_INT);
        $this->residentData['burials-birth-city']=filter_var($this->residentData['burials-birth-city'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-birth-state']=filter_var($this->residentData['burials-birth-state'],FILTER_SANITIZE_STRING);
        // $this->residentData['burials-date-of-death']=filter_var($this->residentData['burials-date-of-death'],FILTER_SANITIZE_ENCODED); 
        $this->residentData['burials-death-year']=filter_var($this->residentData['burials-death-year'],FILTER_VALIDATE_INT);
        $this->residentData['burials-plot-row']=filter_var($this->residentData['burials-plot-row'],FILTER_VALIDATE_INT);
        $this->residentData['burials-plot-number']=filter_var($this->residentData['burials-plot-number'],FILTER_VALIDATE_INT);
        // $this->residentData['burials-interment-date']=filter_var($this->residentData['burials-interment-date'],FILTER_SANITIZE_ENCODED); 
        $this->residentData['burials-interment-year']=filter_var($this->residentData['burials-interment-year'],FILTER_VALIDATE_INT);
        $this->residentData['burials-veteran']=filter_var($this->residentData['burials-veteran'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-veteran-branch']=filter_var($this->residentData['burials-veteran-branch'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-veteran-rank']=filter_var($this->residentData['burials-veteran-rank'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-veteran-service-time']=filter_var($this->residentData['burials-veteran-service-time'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-spouse-first-name']=filter_var($this->residentData['burials-spouse-first-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-spouse-middle-name']=filter_var($this->residentData['burials-spouse-middle-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-spouse-last-name']=filter_var($this->residentData['burials-spouse-last-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-children-names']=filter_var($this->residentData['burials-children-names'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-mother-first-name']=filter_var($this->residentData['burials-mother-first-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-mother-middle-name']=filter_var($this->residentData['burials-mother-middle-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-mother-last-name']=filter_var($this->residentData['burials-mother-last-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-father-first-name']=filter_var($this->residentData['burials-father-first-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-father-middle-name']=filter_var($this->residentData['burials-father-middle-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-father-last-name']=filter_var($this->residentData['burials-father-last-name'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-img-deceased']=filter_var($this->residentData['burials-img-deceased'],FILTER_SANITIZE_URL);
        $this->residentData['burials-img-grave1']=filter_var($this->residentData['burials-img-grave1'],FILTER_SANITIZE_URL);
        $this->residentData['burials-img-grave2']=filter_var($this->residentData['burials-img-grave2'],FILTER_SANITIZE_URL);
        $this->residentData['burials-obituary']=filter_var($this->residentData['burials-obituary'],FILTER_SANITIZE_STRING);
        $this->residentData['burials-family-notes']=filter_var($this->residentData['burials-family-notes'],FILTER_SANITIZE_STRING);


        return $dataArray;
    }// end sanitize



        // load a news article based on an id
        function load($burialsID) {
            // flag to track if the article was loaded
            $isLoaded = false;
    
            // load from database
            // create a prepared statement (secure programming)
            $stmt = $this->db->prepare("SELECT * FROM cemetery-burials WHERE burials-id = ?");
            
            // execute the prepared statement passing in the id of the article we 
            // want to load
            $stmt->execute(array($burialsID));
    
            // check to see if we loaded the article
            if ($stmt->rowCount() == 1) {
                // if we did load the article, fetch the data as a keyed array
                $dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
                //var_dump($dataArray);
                
                // set the data to our internal property            
                $this->set($dataArray);
                            
                // set the success flag to true
                $isLoaded = true;
            }
            //var_dump($stmt->rowCount());    
            return $isLoaded;  // return success or failure
        } // end load 



        function getList(
            $firstName = null
            // $middleName = null,
            // $lastName = null
        ) {
           
            $burialList = array();
            //var_dump($page,$filterColumn);
            // TODO: get the news articles and store into $articleList
           
            $sql = "SELECT * FROM cemetery-burials WHERE burials-first-name LIKE ?";
            $stmt->execute(array($firstName));
            if ($stmt->rowCount() >= 1) {
                $burialList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return $burialList;

            // if (isset($firstName)) {
            //     $sql .= " WHERE burials-first-name LIKE ?";
            //     if (isset($middleName)) {
            //         $sql .= " AND burials-middle-name LIKE ?";
            //     }
            //     if (isset($lastName)) {
            //         $sql .= " AND burials-last-name LIKE ?";
            //     }
            // } else {
            //     if (isset($middleName)) {
            //         $sql .= " WHERE burials-middle-name LIKE ?";
            //         if (isset($lastName)) {
            //             $sql .= " AND burials-last-name LIKE ?";
            //         }
            //     } else 
            //         if ((isset($lastName)) {
            //             $sql .= " WHERE burials-last-name LIKE ?";
            //         }
            // }
    
            
           
            $stmt = $this->db->prepare($sql);
            
            //$stmt->execute();
            
                
                $burialList = $stmt->fetchAll(PDO::FETCH_ASSOC);//var_dump(($userList));
            
                   
            // return the list of residents
            return $burialList;        
        }

        function saveImage($fileArray) {
            move_uploaded_file($fileArray['tmp_name'], dirname(__FILE__) . 
                    "/../public/images/" . $this->burialData['burials-id'] . "_resident.jpg");
        }// adjust this for various pictures to load

} // end class 