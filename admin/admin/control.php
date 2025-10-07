<?php
session_start();
include_once("model.php");

class control extends model
{
    function __construct()
    {
        model::__construct(); 
		
        // Current URL (default: login page)
        $url = $_SERVER['PATH_INFO'] ?? '/authentication-login';

        switch ($url) {

            //  LOGIN 
            case '/authentication-login':
                if (isset($_POST['submit'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $where = [
                        "username" => $username,
                        "password" => md5($password)
                    ];

                    $run = $this->select_where('admin', $where);

                    if ($run && $run->num_rows > 0) {
                        $fetch = $run->fetch_object();
                        $_SESSION['a_id'] = $fetch->id;
                        $_SESSION['a_username'] = $fetch->username;

                        echo "<script>
                            alert('Login success');
                            window.location='dashboard';
                        </script>";
                        exit;
                    } else {
                        echo "<script>
                            alert('Login failed, wrong credentials');
                            window.location='authentication-login';
                        </script>";
                        exit;
                    }
                } else {
                    include("admin_login.php"); // login form file
                }
                break;

            //  LOGOUT 
            case '/admin_logout':	
				unset($_SESSION['a_id']);
				unset($_SESSION['a_username']);
				echo "<script>
					alert('Logout Success');
					window.location='authentication-login';
				</script>";
			break;

			

            //PROFILE 
            case '/profile':
                include('admin_profile.php');
                break;

            //  DASHBOARD 
            case '/dashboard':
                $totalProducts = $this->countRows('products');
                $totalUsers    = $this->countRows('users');
                $totalOrders   = $this->countRows('orders');
                include('dashboard.php');
                break;

            //  PRODUCTS 
            case '/products':
                $products_arr = $this->select('products');
                include('products.php');
                break;

            case '/add_product':
                include('add_product.php');
                break;

            case '/edit_product':
                if (isset($_REQUEST['btn_editproduct'])) {
                    $id = $_REQUEST['btn_editproduct'];
                    $where = ["id" => $id];
                    $run = $this->select_where('products', $where);
                    $fetch = $run->fetch_object();
                    $old_img = $fetch->image;

                    if (isset($_REQUEST['submit'])) {
                        $name = $_REQUEST['name'];
                        $price = $_REQUEST['price'];
                        $desc = $_REQUEST['description'];
                        $category = $_REQUEST['category'];

                        if ($_FILES['image']['size'] > 0) {
                            $image = time().'_'.$_FILES['image']['name'];
                            $path = 'assets/images/products/'.$image;
                            move_uploaded_file($_FILES['image']['tmp_name'], $path);

                            $arr = [
                                "name" => $name,
                                "price" => $price,
                                "description" => $desc,
                                "category" => $category,
                                "image" => $image
                            ];
                            $res = $this->update('products', $arr, $where);

                            if ($res) {
                                if(file_exists('assets/images/products/'.$old_img) && $old_img != ''){
                                    unlink('assets/images/products/'.$old_img);
                                }
                                echo "<script>alert('Product updated successfully'); window.location='products';</script>";
                            }
                        } else {
                            $arr = [
                                "name" => $name,
                                "price" => $price,
                                "description" => $desc,
                                "category" => $category
                            ];
                            $res = $this->update('products', $arr, $where);
                            if ($res) {
                                echo "<script>alert('Product updated successfully'); window.location='products';</script>";
                            }
                        }
                    }
                }
                include('edit_product.php');
                break;

            case '/delete_product':
                if (isset($_REQUEST['dlt_products'])) {
                    $id = $_REQUEST['dlt_products'];
                    $where = ["id" => $id];
                    $res = $this->delete_where('products', $where);
                    if ($res) {
                        echo "<script>
                            alert('Product deleted successfully');
                            window.location='products';
                        </script>";
                    }
                }
                break;

            //  CATEGORIES 
            case '/categories':
                $categories_arr = $this->select('categories');
                include('categories.php');
                break;
				// edit_category
				case '/edit_category':
               if(isset($_REQUEST['id'])){
               $id = intval($_REQUEST['id']);
               $where = ["id"=>$id];
               $run = $this->select_where('categories', $where);
               if($run && $run->num_rows > 0){
               $category = $run->fetch_assoc();
                } else {
               echo "<script>alert('Category not found'); window.location='control.php/categories';</script>";
             exit;
          }
               }
           include("edit_category.php");
                break;

            case '/delete_category':
                if (isset($_REQUEST['dlt_categories'])) {
                    $id = $_REQUEST['dlt_categories'];
                    $where = ["id" => $id];
                    $run = $this->select_where('categories', $where);
                    $fetch = $run->fetch_object();
                    $del_image = $fetch->categories_image;

                    $res = $this->delete_where('categories', $where);
                    if ($res) {
                        unlink('assets/images/categories/'.$del_image);
                        echo "<script>
                            alert('Category deleted successfully');
                            window.location='categories';
                        </script>";
                    }
                }
                break;

            // ORDERS 
            case '/orders':
                $orders_arr = $this->select('orders');
                include('orders.php');
                break;

            case '/delete_orders':
                if (isset($_REQUEST['dlt_orders'])) {
                    $id = $_REQUEST['dlt_orders'];
                    $where = ["id" => $id];
                    $res = $this->delete_where('orders', $where);
                    if ($res) {
                        echo "<script>
                            alert('Order deleted successfully');
                            window.location='orders';
                        </script>";
                    }
                }
                break;

            // CUSTOMERS 
            case '/customer':
                $customer_arr = $this->select('customer');
                include('customer.php');
                break;
				
				case '/edit_customer':
    // Session check
    if(!isset($_SESSION['a_id'])){
        echo "<script>alert('Please login first'); window.location='control.php/admin-login';</script>";
        exit;
    }

    if(isset($_GET['id'])){
        $id = intval($_GET['id']);
        $where = ["id"=>$id];
        $run = $this->select_where('customer', $where);

        if($run && $run->num_rows > 0){
            $customer = $run->fetch_assoc();
        } else {
            echo "<script>alert('Customer not found'); window.location='control.php/customers';</script>";
            exit;
        }

        // Form submit
        if(isset($_POST['submit'])){
            $name   = $_POST['name'];
            $email  = $_POST['email'];
            $mobile = $_POST['mobile'];
            $gender = $_POST['gender'];

            $updateData = [
                "name"   => $name,
                "email"  => $email,
                "mobile" => $mobile,
                "gender" => $gender
            ];

            $this->update('customer', $updateData, ["id"=>$id]);

            echo "<script>alert('Customer updated successfully'); window.location='control.php/customers';</script>";
            exit;
        }

        include('edit_customer.php'); 
    } else {
        echo "<script>alert('Invalid Customer ID'); window.location='control.php/customers';</script>";
        exit;
        }
      break;
				
                 // DELETE CUSTOMER
                    case '/delete_customer':
                   if(isset($_REQUEST['dlt_customer'])){
                   $id = intval($_REQUEST['dlt_customer']);
                    $where = ["id"=>$id];

                 // fetch image name
                  $run = $this->select_where('customer', $where);
                   if($run && $run->num_rows > 0){
                   $fetch = $run->fetch_object();
                  $del_image = $fetch->image;

                 // delete row
                 $res = $this->delete_where('customer',$where);
                   if($res){
                  if(!empty($del_image) && file_exists('assets/images/customers/'.$del_image)){
                    unlink('assets/images/customers/'.$del_image);
                 }

                  echo "<script>
                        alert('Customer deleted successfully');
                        window.location='customer';
                      </script>";
                exit;
                      }
                    } else {
                    echo "<script>alert('Customer not found'); window.location='customer';</script>";
                      exit;
                        }
                      }
                     break;
					 
					 
					 case '/status_customer':
                     if(isset($_REQUEST['status_customer'])) {
                     $id = intval($_REQUEST['status_customer']);
                       $where = ["id"=>$id];

                       $run = $this->select_where('customer', $where);
                       if($run && $run->num_rows > 0){
                       $fetch = $run->fetch_object();
                       $status = $fetch->status;

                      if($status == "Block") {
                       $arr = ["status"=>"Unblock"];
                       $res = $this->update('customer', $arr, $where);
                         if($res) {
                           echo "<script>
                        alert('Customer Unblocked Successfully');
                        window.location='customer';
                    </script>";
                    exit;
                }
            } else {
                $arr = ["status"=>"Block"];
                $res = $this->update('customer', $arr, $where);
                if($res){
                    unset($_SESSION['c_id']);
                    unset($_SESSION['c_name']);
                    unset($_SESSION['c_email']);
                    echo "<script>
                        alert('Customer Blocked Successfully');
                        window.location='customer';
                    </script>";
                    exit;
                }
            }
        } else {
            echo "<script>alert('Customer not found'); window.location='customer';</script>";
            exit;
        }
    }
	
break;	 

                // USERS
                case '/users':
                $users_arr = $this->fetchUsers();
                include('users.php');
				break;
				
				
				case 'edit_user':
             if(!isset($_SESSION['a_id'])){
                echo "<script>
            alert('Please login first'); 
            window.location='control.php?page=authentication-login';
           </script>";
        exit;
    }

    $id = intval($_GET['id'] ?? 0);

    if($id <= 0){   
        echo "<script>alert('Invalid User ID'); window.location='control.php?page=users';</script>";
        exit;
    }

    $where = ["id" => $id];
    $run = $this->select_where('users', $where);
    if($run && $run->num_rows > 0){
        $user = $run->fetch_assoc();
    } else {
        echo "<script>alert('User not found'); window.location='control.php?page=users';</script>";
        exit;
    }

    if(isset($_POST['update'])){
        $updateData = [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "mobile" => $_POST['mobile']
        ];
        $this->update('users', $updateData, ["id"=>$id]);
        echo "<script>alert('User updated successfully'); window.location='control.php?page=users';</script>";
        exit;
    }

     include('edit_user.php');
     break;
	                
              // DELETE USER
               case '/delete_user':
              if(isset($_REQUEST['dlt_user'])){
             $id = intval($_REQUEST['dlt_user']);
             $where = ["id"=>$id];

        // User fetch 
        $run = $this->select_where('users', $where);
        if($run && $run->num_rows > 0){
            $fetch = $run->fetch_object();
            $del_image = $fetch->image;

            // Record delete
            $res = $this->delete_where('users',$where);
            if($res){
                if(!empty($del_image) && file_exists('assets/images/user/'.$del_image)){
                    unlink('assets/images/user/'.$del_image);
                }

                echo "<script>
                    alert('User deleted successfully');
                    window.location='users';
                </script>";
                exit;
            }
        } else {
            echo "<script>alert('User not found'); window.location='users';</script>";
            exit;
        }
    }
    break;  
	          case '/status_user':
    if(isset($_REQUEST['status_user'])) {
        $id = intval($_REQUEST['status_user']);
        $where = ["id" => $id];

        $run = $this->select_where('users', $where);

        if($run && $run->num_rows > 0){
            $fetch = $run->fetch_object();
            $status = isset($fetch->status) ? $fetch->status : "Unblock";

            if($status == "Block") {
                $arr = ["status"=>"Unblock"];
                $res = $this->update('users', $arr, $where);
                if($res) {
                    echo "<script>
                        alert('User Unblocked Successfully');
                        window.location='users';
                    </script>";
                    exit;
                } else {
                    echo "<script>alert('Update failed'); window.location='users';</script>";
                    exit;
                }
            } else {
                $arr = ["status"=>"Block"];
                $res = $this->update('users', $arr, $where);
                if($res){
                    if(isset($_SESSION['u_id']) && $_SESSION['u_id'] == $id){
                        unset($_SESSION['u_id'], $_SESSION['u_name'], $_SESSION['u_email']);
                    }
                    echo "<script>
                        alert('User Blocked Successfully');
                        window.location='users';
                    </script>";
                    exit;
                } else {
                    echo "<script>alert('Update failed'); window.location='users';</script>";
                    exit;
                }
            }

        } else {
            echo "<script>alert('User not found'); window.location='users';</script>";
            exit;
        }
    }
break;

	           
			  
	         
            // FRONTEND 
            case '/home':
                $latestProducts = $this->select('products');
                include("home.php");
                break;

            case '/index':
                include("index.php");
                break;

            case '/shop':
                $shopProducts = $this->select('products');
                include("shop.php");
                break;

            case '/detail':
                if(isset($_GET['id'])){
                    $id = intval($_GET['id']);
                    $where = ["id"=>$id];
                    $run = $this->select_where('products',$where);
                    $product = $run->fetch_object();
                }
                include("detail.php");
                break;

            case '/cart':
                include("cart.php");
                break;

            case '/add_to_cart':
                include("add_to_cart.php");
                break;

            case '/remove_item':
                include("remove_item.php");
                break;

            case '/registration':
                include("registration.php");
                break;

            case '/login':
                include("login.php");
                break;

            case '/checkout':
                include("checkout.php");
                break;

            case '/place_order':
                include("place_order.php");
                break;

            case '/order_success':
                include("order_success.php");
                break;

            case '/contact':
                include("contact.php");
                break;

            case '/contact_process':
                include("contact_process.php");
                break;

            default:
                echo "Page Not Found!";
                break;
        }
    }

    // count rows
    function countRows($table){
        $sql = "SELECT COUNT(*) as total FROM $table";
        $res = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_assoc($res);
        return $row['total'];
    }

    // select with where
    function select_where($tbl, $where){
        $sql = "SELECT * FROM $tbl WHERE 1=1";
        foreach($where as $key=>$val){
            $sql .= " AND $key='".$this->conn->real_escape_string($val)."'";
        }
        $run = $this->conn->query($sql);
        return $run;
    }
}

$obj = new control();
?>       