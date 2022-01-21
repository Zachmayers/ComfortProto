<?php
//CHANGE THE NAME
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	

class Pop {

	
	function get_menu_items() {
		$database = new Database;
		
		$database->query('SELECT * FROM menu');

		$result = $database->resultset();
		
		return $result;	
	}
	
	function save_order($order_array) {
		$database = new Database;

		$database->query('INSERT INTO orders
									(date_created)
									VALUES (NOW())');
		$database->execute();
			
		$orderID = $database->lastInsertId();	
		
		foreach($order_array as $row) {
			//echo var_dump($row);
				$database->query('INSERT INTO cart
											(description, price, quantity, orderID)
											VALUES (:description, :price, :quantity, :orderID)');
											
				$database->bind(':description', $row['name']);
				$database->bind(':price', $row['price']);
				$database->bind(':quantity', $row['count']);
				$database->bind(':orderID', $orderID);
				$database->execute();
				
		}
		
		return $orderID;	
	}
	
	function check_orderID($orderID) {
		$database = new Database;
		
		$database->query('SELECT * FROM orders WHERE orderID = :orderID AND paid != :paid');
		$database->bind(':orderID', $orderID);
		$database->bind(':paid', 'Y');

		$result = $database->resultset();
		
		if (count($result) > 0) {
			return "Y";
		} else {
			return "N";
		}
		
	}
	
	function get_cart($orderID) {
		$database = new Database;
		
		$database->query('SELECT * FROM cart WHERE orderID = :orderID');
		$database->bind(':orderID', $orderID);

		$result = $database->resultset();

		return $result;		
	}
	
	function save_address($name, $email, $street, $zip, $phone, $notes, $day, $time, $orderID) {
		$database = new Database;
		
		//check to see if user is attached to order
		$database->query('SELECT * FROM orders WHERE orderID = :orderID');
		$database->bind(':orderID', $orderID);

		$result = $database->resultset();
		
		if (count($result) == 0) {}
		
		$database->query('INSERT INTO users
									(name, email, street, zip, phone, notes)
									VALUES (:name, :email, :street, :zip, :phone, :notes)');
									
		$database->bind(':name', $name);
		$database->bind(':email', $email);
		$database->bind(':street', $street);
		$database->bind(':zip', $zip);
		$database->bind(':phone', $phone);
		$database->bind(':notes', $notes);

		$database->execute();

		$userID = $database->lastInsertId();

		$database->query('UPDATE orders 
									SET userID = :userID, day = :day, time = :time							
									WHERE orderID = :orderID');
		$database->bind(':userID', $userID);
		$database->bind(':orderID', $orderID);
		$database->bind(':day', $day);
		$database->bind(':time', $time);
		
		$database->execute();
		
		$_SESSION['email'] = $email;

		//update order
		//return $result;		
	}
	

	function get_open_orders() {
		$database = new Database;
		
		$database->query('SELECT * FROM orders, users WHERE orders.paid = :paid AND delivered != :delivered AND orders.userID = users.userID');
		$database->bind(':paid', 'Y');
		$database->bind(':delivered', 'Y');

		$result = $database->resultset();

		return $result;		
	}

	function change_delivery_status($orderID) {
		$database = new Database;
		
		$database->query('UPDATE orders 
									SET delivered = :delivered, date_delivered = NOW()							
									WHERE orderID = :orderID');
		$database->bind(':delivered', "Y");
		$database->bind(':orderID', $orderID);
		$database->execute();

	}

	function mark_paid($orderID, $amount) {
		$database = new Database;
		
		$database->query('UPDATE orders 
									SET paid = :paid, amount = :amount							
									WHERE orderID = :orderID');
		$database->bind(':paid', "Y");
		$database->bind(':amount', $amount);
		$database->bind(':orderID', $orderID);
		
		$database->execute();
		
		//email new order
		   mail("jbhenschen@gmail.com","Pop Parlour Stripe Payment","New Order Paid - Check Admin Page");
		   mail("delivery@thepopparlour.com","Pop Parlour Stripe Payment","New Order Paid - Check Admin Page");

		  
	}
	
	function get_checkout_amount($orderID) {
		$database = new Database;
		
		$database->query('SELECT * FROM cart WHERE orderID = :orderID');
		$database->bind(':orderID', $orderID);

		$result = $database->resultset();
		$total = 0;
		foreach($result as $row) {
			$total = $total + $row['price'];
		}
		
		return $total;
	}
	
	
}

?>