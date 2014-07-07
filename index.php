<meta charset="utf-8" >
<?php
include('cfg/cfg.php');
include('model/WADB.cls.php');

$db = new WADB(db_address,db_name,db_username,db_password);
	if($_GET['action'] != '') {

		switch($_GET['action']){

			case 'add':
				if(count($_POST)>0){
			
					$sql = "insert into
							guestbook
							(
								name,
								email,
								sex,
								content,
								create_time,
								ip
							)
							values
							(
								'".$_POST['name']."',
								'".$_POST['email']."',
								'".$_POST['sex']."',
								'".$_POST['content']."',
								'".time()."',
								'".$_SERVER['REMOTE_ADDR']."'
							)";
				/*	另一種寫法
					$sql = "insert into guestbook (name,email,sex,content,create_time,ip) values (";
					$sql .= "'" . $_POST["name"] . "','" . $_POST["email"] . "',". $_POST["sex"] .",'" . $_POST["content"];
					$sql .= "','".time()."','" . $_SERVER["REMOTE_ADDR"] ."')";
				*/
					//echo $sql."<br />";
					$db->insertRecords($sql);
					//print_r($_POST);
					}else{
					//echo 111;
				}			
				include('view/header.php');
				include('view/add.php');
				
				break;
				case 'delete':
					$sql = "delete
							from
							 guestbook
							where
							 id = '" . $_GET['id'] . "'";
					$db->deleteRecords($sql);
					//刪除完之後跳回到 主頁面 
					header('location:index.php');
					exit();
				break;
				default:
					$sql = "select
							*
							from
							guestbook
							order by 
							id desc";
					$data = $db->selectRecords($sql);
					print_r($data);
					include('view/header.php');
					include('view/show.php');
			}
		}else{
					$sql = "select
							*
							from
							guestbook
							order by 
							id desc";
					$data = $db->selectRecords($sql);
					print_r($data);
					include('view/header.php');
					include('view/show.php');
		}

include('view/footer.php');
?>