<?php 
	
	
	/*
	wkhtmltoimage-i386 --load-error-handling ignore --crop-h 144 --crop-w 144 http://dev.migranciudad.com/createlogos/logo.php?id=8 /home/harold/output/meme1.png
	*/

	/*
	
			$hostname = "localhost";
	$username = "root";
	$password = "Harold_0515";
	$db = "uconecta";

	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password) 
	or die("Unable to connect to MySQL");
	echo "Connected to MySQL<br>";

	//select a database to work with
	$selected = mysql_select_db($db, $dbhandle) 
	or die("Could not select examples");

	//execute the SQL query and return records
	$result = mysql_query("SELECT * FROM degree");

	//fetch tha data from the database 
	while ($row = mysql_fetch_array($result)) {
   echo "ID:".$row{'id'}." Name:".$row{'name'}."<br>";
	}	
	
	//close the connection
	mysql_close($dbhandle);

	*/

header('Content-Type: text/html; charset=utf-8');

	class connection {

		var $dbhandle;
		var $selected;

		public function __construct(){
			$hostname = "localhost";
			$username = "root";
			$password = "Harold_0515";
			$db = "uconecta";

	
			$this->dbhandle = mysql_connect($hostname, $username, $password); 			
			$this->selected = mysql_select_db($db, $this->dbhandle); 						
			
			session_start();
		}
		
		public function get_degree_with_tags($query){
			
			$result = mysql_query($query, $this->dbhandle);
			
			$json = array();		
			
			while ($row = mysql_fetch_array($result)) {
				$degree = array(
					'id' => $row{'id'}, 					
					'name' => $row{'name'},
					'status' => $row{'id'},
					'degree_id' => $row{'degree_id'},
					'degree_tags' => $row{'tags_degree'}
					);
			//	echo "ID:".$row{'id'}." Name:".$row{'tags_degree'}."<br>";
				array_push($json, $degree);
			}	
			mysql_close($this->dbhandle);	
			echo json_encode($json);
		}

		public function get_degree_tags(){

			$option = $_POST["option"];
			//$option = 2;
			$query = "SELECT degree_tags.*, degree.name FROM `degree_tags` inner join degree on degree_tags.degree_id = degree.id where degree_id = $option";

			$result = mysql_query($query, $this->dbhandle);
			
			$json = array();		
			
			while ($row = mysql_fetch_array($result)) {
				$degree = array(
					'id' => $row{'id'}, 										
					'degree_id' => $row{'degree_id'},
					'degree_tags' => $row{'tags_degree'},
					'name' => $row{'name'}
					);
			//	echo "ID:".$row{'id'}." Name:".$row{'tags_degree'}."<br>";
				array_push($json, $degree);
			}				
			$_SESSION = array();
			$_SESSION['data_image'] = $json;
			mysql_close($this->dbhandle);	
			echo json_encode($json);
			
		}



		private function get_random_message($tags){
			
			$array_tags = explode(",", $tags);
			$index = rand(0, count($array_tags) - 1);
			return $array_tags[$index];
		}

		public function download_image(){
			shell_exec(" wkhtmltoimage-i386 --load-error-handling ignore --crop-h 479 --crop-w 639  http://localhost/drupal/uconecta/connection.php?action=template /home/harold/output/meme1.png");
			//readfile('index.html');
			
		}

		/*public function save_image(){
			//var_dump($_FILES['file']);	
			print_r($_);	
			//$uploaddir = '/home/harold/output/';
			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/drupal/uconecta/files/';
			$uploadfile = $uploaddir . basename($_FILES['file']['name']);

			echo $uploadfile."<br><p>";

			if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
				echo "File is valid, and was successfully uploaded.\n";
			} else {
				echo "Upload failed";
			}

			echo "</p>";
			echo '<pre>';
			echo 'Here is some more debugging info:';
			print_r($_FILES);
			print "</pre>";
		}
*/
		public function save_image(){
			$img = $_POST['imgBase64'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);

			file_put_contents('/home/harold/output//image.png', $data);			
		}
		
		public function run_template(){					

			$data = $_SESSION['data_image'];
			
			$_SESSION['degree_name'] = $data[0]['name'];
			$_SESSION['tag'] = $data[0]['tag'];
			
			include 'template.php';	
		}

		public function get_name(){
			echo "hola harold";
		}

		public function get_degree(){
			echo "option 1";
		}
	}

	$obj = new connection();

	$function_name = $_GET['action'];

	switch ($function_name) {
		case 'get_degree':
			$query = "SELECT degree_tags.*, degree.name FROM degree_tags inner join degree on degree_tags.degree_id = degree.id";
			$obj->get_degree_with_tags($query);
			break;
		case 'get_message_image':		
			$json = $obj->get_degree_tags($option);
			
			break;
		case 'download_image':
			$obj->download_image();
			break;
		case 'template':
			$obj->run_template();
			break;
		case 'save_image':
			$obj->save_image();
			break;

		default:
			# code...
			break;
	}
	//$query = "SELECT degree_tags.*, degree.name FROM degree_tags inner join degree on degree_tags.degree_id = degree.id";


	//$obj->get_query($query);

?>
