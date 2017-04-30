 <?php
// Author: Xuesen Tan 
// LAB 11
class DatabaseAdaptor {
  // The instance variable used in every one of the functions in class DatbaseAdaptor
  private $DB;
  // Make a connection to an existing data based named 'imdb_small' that has
  // table . In this assignment you will also need a new table named 'users'
  public function __construct() {
    $db = 'mysql:dbname=imdb_small;host=127.0.0.1;charset=utf8';
//  	$db = 'mysql:dbname=test;host=127.0.0.1;charset=utf8';
  	 
    $user = 'root';
    $password = '';
    
    try {
      $this->DB = new PDO ( $db, $user, $password );
      $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch ( PDOException $e ) {
      echo ('Error establishing Connection');
      exit ();
    }
  }
  
  // Return all movies records as an associative array.

  	public function getActors ($substring ) {
  	if(strpos($substring, " ") == false){
  	$stmt = $this->DB->prepare ( "SELECT first_name,last_name,id FROM actors WHERE first_name like '%"
  			. $substring . "%'");
  	}
  	else{
  		$space = strpos($substring, " ");
  		$arr = explode(" " , $substring);
  		$stmt = $this->DB->prepare ( "SELECT first_name,last_name,id FROM actors WHERE first_name like '%"
  				. $arr[0] . "%' and last_name like '%" . $arr[1] . "%'");
  	}
  	$stmt->execute ();
  	return $stmt->fetchAll ( PDO::FETCH_ASSOC );
  	}
	public function getMovies($id){
		$stmt = $this->DB->prepare ( "select movies.name,roles.role from roles join actors on actors.id = " .$id. " and roles.actor_id = " .$id. " join movies on movies.id = roles.movie_id");
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		
	}
 
} // End class DatabaseAdaptor

// Testing code that should not be run when a part of MVC
$theDBA = new DatabaseAdaptor ();

?>