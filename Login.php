<?php
   
session_start(); 
include('connect.php'); 
include('function.php');
include('header.php');
        
$con=mysqli_connect($host,$user,$pass,$database);
    if (isset($_POST['btnlogin'])) 
    {
        $email=$_POST['txtEmail'];
        $password=$_POST['txtPassword'];

        $select=mysqli_query($con,"SELECT * from customer where AccountName='$email' and Password='$password'");
        $select_count=mysqli_num_rows($select);
        if ($select_count==0) 
        {
            $staff_select=mysqli_query($con,"SELECT * from staff where Email='$email' and Password='$password'");
            $staff_count=mysqli_num_rows($staff_select);
            if ($staff_count==0) 
            {
                echo "<script>alert('Something is incorrect, Please Try Again');
                      location.assign(Login.php);
                      </script>";
            }
            else
            {
                $staff_data=mysqli_fetch_array($staff_select);
                $staffid=$staff_data['StaffID'];
                $staffname=$staff_data['StaffName'];

                $_SESSION['StaffID']=$staffid;
                $_SESSION['StaffName']=$staffname;
                
                echo "<script>window.alert('Staff $staffname Loggedin!')</script>";
                echo "<script>location.assign('headerstaff.php')</script>";

            }
        }
        else
        {
            $data=mysqli_fetch_array($select);
            $customerid=$data['CustomerID'];
            $email=$data['AccountName'];
            $Surname=$data['Surname'];
            
            $_SESSION['CustomerID']=$customerid;
            $_SESSION['Surname']=$Surname;

            $_SESSION['Forename']=$data['Forename'];

            $_SESSION['AccountName']=$email;

            echo "<script>window.alert('Welcome [$Surname $_SESSION[Forename]]  Customer Loggedin!')</script>";

            echo "<script>location.assign('Customer_Home.php')</script>";
        }
    }

 ?>
<html>
<head>
    <title>Login Page</title>
</head>


<body>
              
            
            <form action="#" method="post">
            <fieldset>
                <legend align="center"><h2>Login To TechX </h2></legend>
            <table align="Center" cellpadding="8">
            <tr>
                <td> Account Name : </td>
                <td> 
                            <div class="key">
                                <i class="fa fa-envelope" aria-hidden="true"> </i>
                                     <input type="text" name="txtEmail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" placeholder="eg. xxxxx@gmil.com" required="">
                                <div class="clearfix"></div>
                            </div>
                </td>
            </tr>
            <tr>
                <td> Password : </td>
                <td>
                            <div class="key">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                 <input type="password" name="txtPassword" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" placeholder="Enter Your Password"required="">
                                <div class="clearfix"></div>
                            </div>
                 </td>
            </tr>
            <tr>
                <td colspan="2" align="right"> 
                            <input type="submit" name="btnlogin" class="btn_4" value="Login">
                        </form>
                    </div>
             </td>
            </tr>
            <tr>
                <td align="left">
                    
                        <a href="Staff.php"  class="btn_3">Staff Register</a></td>
                <td align="right">
                        <a href="Customer_Register.php" class="btn_3" >Customer Register</a>
                    
             </td>
            </tr>
            </table>
            </fieldset>
        </form>   
</body>

