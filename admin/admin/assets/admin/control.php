<?php
session_start();
include_once("model.php");

class control extends model
{
    function __construct()
    {
        model::__construct(); // db connection

        // URL get 
        $url = $_SERVER['PATH_INFO'] ?? '/dashboard';

        switch ($url) {

            // Admin Login
            case '/authentication-login':
                if (isset($_REQUEST['submit'])) {
                    $name = $_REQUEST['name'];
                    $password = $_REQUEST['password'];

                    $where = array(
                        "name" => $name,
                        "password" => md5($password)
                    );

                    $run = $this->select_where('admin', $where);

                    if ($run && $run->num_rows > 0) {
                        $fetch = $run->fetch_object();

                        $_SESSION['id']       = $fetch->id;
                        $_SESSION['name']     = $fetch->name;
                        $_SESSION['password'] = $fetch->password;

                        echo "<script>
                            alert('Login success');
                            window.location='dashboard';
                        </script>";
                        exit;
                    } else {
                        echo "<script>
                            alert('Login failed, wrong credentials');
                            window.location='admin-login';
                        </script>";
                        exit;
                    }
                }
                include("authentication-login.php");
                break;
				
				
				// Logout
				 case 'logout':	
				unset($_SESSION['a_id']);
				unset($_SESSION['a_name']);
				unset($_SESSION['a_password']);
				echo "<script>
				alert('Logout Success');
					window.location='authentication-login';
				</script>";
			break;
			
			  // Admin profile
			  case '/profile': 
             if(isset($_SESSION['name'])) {
             $username = $_SESSION['name'];            
             $admin = $this->fetchAdmin($username);        
             include('admin_profile.php');                 
             } else {
              echo "<script>
                alert('Please login first');
                window.location='authentication-login';
              </script>";
              exit;
			 }
             break; 
			
            // Dashboard
            case '/dashboard':
                $totalProducts = $this->countRows('products');
                $totalUsers    = $this->countRows('users');
                include('dashboard.php');
                break;

            // Products
            case '/products':
                $products_arr = $this->select('products');
                include('products.php');
                break;
				
                // add product
            case '/add_product':
                include('add_product.php');
                break;
				
				// dlt 
				case'/delete':
				if(isset($_REQUEST['dlt_products']))
				{
					$id=$_REQUEST['dlt_products'];
					$where=array("id"=>$id);
					$res=$this->delete_where('Products',$where);
					if($res)
					{
						echo"<script>
						alert('Products Delete success');
						window.location='manage_products';
						</script>";
					}
				}
				case '/categories':
            $categories_arr = $this->select('categories');
             include('categories.php');
             break;
			 // Show contact form
             case '/contact':
             include('contact.php');
              break;

              // Process form submission
              case '/contact_process':
              include('contact_process.php');
                 break;
				 
              // Orders
            case '/orders':
                $orders_arr = $this->select('orders');
                include('orders.php');
                break;

            // Customers
            case '/customer':
                $customer_arr = $this->select('customer');
                include('customer.php');
                break;

            // Users
            case '/users':
                $users_arr = $this->fetchUsers();
                include('users.php');
                break;

            // Default
            default:
                echo "Page Not Found!";
                break;
        }
    }

    // Count rows function
    function countRows($table)
    {
        $sql = "SELECT COUNT(*) as total FROM $table";
        $res = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($res);
        return $row['total'];
    }
}

$obj = new control();
?>
