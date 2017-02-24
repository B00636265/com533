<?php
    require 'Slim/Slim.php';
    \Slim\Slim::registerAutoloader();
    use Slim\Slim;
    $app = new Slim();
    $app->get('/staffs','getStaffs');
    $app->post('/staffs','addStaff');
    $app->get('/staffs/:id', 'getStaff');
    $app->put('/staffs/:id', 'updateStaff');
    $app->delete('/staffs/:id', 'deleteStaff');
    $app->run();


function getStaffs(){
    $sql = "select * FROM staff ORDER BY Staff_Id";
    try {    
    $db = getConnection();
    $stmt = $db->query($sql);
    $staffs = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    responseJson('{"staff":'.json_encode($staffs).'}',200);  
    }catch(PDOException $e){
    responseJson('{"error":{"text":'.$e->getMessage().'}}',500);
}}
       

function getConnection(){
    $dbhost="localhost";
    $dbuser="B00636265";
    $dbpass="R7X6j7gR";
    $dbname="B00636265";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $dbh;
}
  

function responseJson($responseBody, $statusCode){
    $app = Slim::getInstance();
    $response = $app->response();
    $response['Content-Type']='application/json';
    $response->status($statusCode);
    $response->body($responseBody);
}
    

function addStaff(){
    $request = Slim::getInstance()->request();
    $staff = json_decode($request->getBody());
    $sql = "insert into staff (FirstName,LastName,campus) values (:firstname,:lastname,:campus)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("firstname",$staff->firstname);
        $stmt->bindParam("lastname",$staff->lastname);
        $stmt->bindParam("campus",$staff->campus);
        $stmt->execute();
        $staff->Staff_Id = $db->lastInsertId();
        $db = null;
        responseJson(json_encode($staff),201);
    }catch(PDOException $e) {
        responseJson('{"error":{"text":'.$e->getMessage().'}}',500);
}}


function getStaff($id) {
    $sql = "SELECT * FROM staff WHERE staff_id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $staff = $stmt->fetchObject();
        $db = null;
        responseJson(json_encode($staff),200);
    }catch(PDOException $e) {
            responseJson('{"error":{"text":'.$e->getMessage().'}}',500);
}}





function updateStaff($id){
    $request = Slim::getInstance()->request();
    $body = $request->getBody();
    $staff = json_decode($body);
    $sql = "UPDATE staff SET firstname=:firstname,lastname=:lastname, campus=:campus WHERE staff_id=:staff_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);      
        
        $stmt->bindParam("lastname",$staff->LastName);
        $stmt->bindParam("firstname",$staff->FirstName);
        $stmt->bindParam("campus",$staff->Campus);
        $stmt->bindParam("staff_id",$id);
        
        $stmt->execute();
  
        responseJson(json_encode($staff),200);
        
    }catch(PDOException $e){
        responseJson('{"error":{"text":'.$e->getMessage().'}}',500);
}}






function deleteStaff($id){
    $sql = "DELETE FROM staff WHERE staff_id=:id";
    try {
        
        $db = getConnection();
        $stmt = $db->prepare($sql); 
        
        $stmt->bindParam("id",$id); 
        
        $stmt->execute();    
        
        responseJson(json_encode($staff),200);
        
    }catch(PDOException $e) {
        responseJson('{"error":{"text":'.$e->getMessage().'}}',500);
}}

        



 



?>

