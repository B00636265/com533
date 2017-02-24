<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
use Slim\Slim;
    $app = new Slim();
    $app->get('/books', 'getBooks');
    $app->post('/books', 'addBook');
    $app->get('/books/:id', 'getBook');
    $app->put('/books/:id', 'updateBook');
    $app->delete('/books/:id', 'deleteBook');
    $app->run();


function getBooks() {
$sql = "select * FROM book ORDER BY bookID";  
try {
    $db = getConnection();
    $stmt = $db->query($sql);
    $books = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    responseJson('{"book":'.json_encode($books).'}',200);

}catch(PDOException $e) {
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



function responseJson($responseBody, $statusCode) {
    $app = Slim::getInstance();
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->status($statusCode);
    $response->body($responseBody);
        }



function addBook(){
    $request = Slim::getInstance()->request();
    $book = json_decode($request->getBody());
    $sql ="insert into book (bookName, bookAuthor, bookPrice) values (:bookName, :bookAuthor, :bookPrice)";

try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("bookName", $book->bookName);
    $stmt->bindParam("bookAuthor", $book->bookAuthor);
    $stmt->bindParam("bookPrice", $book->bookPrice);
    $stmt->execute();
    $book->bookID = $db->lastInsertId();
    $db = null;
    responseJson(json_encode($book),201);

    } catch(PDOException $e) {
        responseJson('{"error":{"text":'.$e->getMessage().'}}',500);
            }}



function getBook($id) {
$sql = "SELECT * FROM book WHERE bookID=:id";

try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $book = $stmt->fetchObject();
    $db = null;
    responseJson(json_encode($book),200);

    }catch(PDOException $e) {
        responseJson('{"error":{"text":'.$e->getMessage().'}}',500);
            }}
 


function updateBook($id){
    $request = Slim::getInstance()->request();
    $body = $request->getBody();
    $book = json_decode($body);
    $sql = "UPDATE book SET bookName=:bookName,bookAuthor=:bookAuthor, bookPrice=:bookPrice WHERE bookID=:bookID";

try {
    $db = getConnection();
    $stmt = $db->prepare($sql);      
    $stmt->bindParam("bookName",$book->bookName);
    $stmt->bindParam("bookAuthor",$book->bookAuthor);
    $stmt->bindParam("bookPrice",$book->bookPrice);
    $stmt->bindParam("bookID",$id);
    $stmt->execute();
    responseJson(json_encode($book),200);

    }catch(PDOException $e){
        responseJson('{"error":{"text":'.$e->getMessage().'}}',500);
            }}
	



function deleteBook($id){
    $sql = "DELETE FROM book WHERE bookID=:id";
    
try {
    $db = getConnection();
    $stmt = $db->prepare($sql); 
    $stmt->bindParam("id",$id); 
    $stmt->execute();    
    responseJson(json_encode($book),200);
        
    }catch(PDOException $e) {
        responseJson('{"error":{"text":'.$e->getMessage().'}}',500);
            }}


?>