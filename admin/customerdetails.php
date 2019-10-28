<?php include '../classes/Customer.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if (!isset($_GET['cid']) || $_GET['cid'] == NULL) {
    echo "<script>window.location = 'inbox.php';</script>";
}else{
    $cid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['cid']);
}
$customer = new Customer();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name       = $_POST['name'];
    $updateCat  = $customer->updateCustomer($cid,$name);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['back'])) {
    echo "<script>window.location = 'inbox.php';</script>";
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer Details</h2>
        <div class="block copyblock"> 
            <form action="" method = 'post'>
                <table class="form">					
                        <?php
                            $getCustomer  = $customer->getCustomerById($cid);
                            if ($getCustomer) {
                                $customerVal= $getCustomer->fetch_assoc();
                            }

                        ?>
                    <tr>
                        <td width="20%">Name</td>
                        <td width="10%">:</td>
                        <td width="70%">
                            <input type="text" value="<?php echo $customerVal['name']; ?>" class="large" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>
                            <input type="text" value="<?php echo $customerVal['email']; ?>" class="large" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>Cell</td>
                        <td>:</td>
                        <td>
                            <input type="text" value="<?php echo $customerVal['phone']; ?>" class="large" readonly/>
                        </td>
                    </tr>


                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td>
                            <input type="text" value="<?php echo $customerVal['city']; ?>" class="large" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>Zip</td>
                        <td>:</td>
                        <td>
                            <input type="text" value="<?php echo $customerVal['zip']; ?>" class="large" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td>
                            <input type="text" value="<?php echo $customerVal['country']; ?>" class="large" readonly/>
                        </td>
                    </tr>

                    <tr> 
                        <td></td>
                        <td></td>
                        <td>
                            <input type="submit" name="back" Value="Ok" />
                        </td>
                        
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>