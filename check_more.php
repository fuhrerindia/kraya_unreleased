<?php
//     include('cred.php');
//     $connect = mysqli_connect($server, $user, $pass, $db);
//     if ($_POST['data'] === "root"){
//         $sql = "SELECT * FROM `orders` WHERE `shop` LIKE '".base64_decode($_COOKIE['Id'])."' AND `deny` NOT LIKE '1' AND `deny` NOT LIKE '3' order by `id` desc";
//     }else{
//         $valu = intval($_POST['data']) + 1;
//         $sql = "SELECT * FROM `orders` WHERE `shop` LIKE '".base64_decode($_COOKIE['Id'])."' AND `deny` NOT LIKE '1' AND `deny` NOT LIKE '3' order by `id` desc LIMIT ".$valu.", 10";
//     }
//     if ($get = mysqli_query($connect, $sql)){
//         if (mysqli_num_rows($get) > 0){
//             while($row = mysqli_fetch_array($get)){
//                 ?>
//                 <tr>
// <td data-label="Select">
// <input type="checkbox" name="todel[]" value="<?php echo $row['id']; ?>" class="checkbox">
// </td>
// <td data-label="Name">
//     <?php echo base64_decode(base64_decode($row['name']))?>
//     </td>
//     <td data-label="Address">
//     <?php echo base64_decode($row['address']);?>
//     </td>
//     <td data-label="Phone">
//     <a href="tel:<?php echo base64_decode($row['phone']); ?>"><?php echo base64_decode($row['phone']); ?></a>
//     </td>
//     <td data-label="Order">
//     <?php echo base64_decode($row['order']); ?>    
//     </td>
//     </tr>
//     <?php
//             }
//         }
//     }
//     // echo intval($_POST['data']) + 1;
//     echo $sql;
?>