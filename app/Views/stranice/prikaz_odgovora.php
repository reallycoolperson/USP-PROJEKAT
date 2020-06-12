<!--Marija Lalic 0616/17-->
<!DOCTYPE html>
<html>
<head>
<title> Rjesenja </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/stil.css'); ?>">
</head>

<script>


</script>



<body>
<div  style = "margin-top: 490px; margin-left: 100px; position: fixed">
        <a href="<?= site_url("Igrac/index")?>"> Nazad</a>
</div>

<div class = "naslov_mastermind" style = "position: relative;  margin-top: 100px; font-size: 60px"> <h2> <?php if($_SESSION['trenutnoIgra'] == 'gost')
 { echo  $_SESSION['cntGostaTacno'] . '/' .sizeof($_SESSION['pitanja']);   }
else  { echo  $_SESSION['tacnoIgraca'] . '/' .sizeof($_SESSION['pitanja']);   }
 ?> </h2></div>

<img src="<?php echo base_url('slike/pink.png') ?>" alt = "nope" class ="user" style = "z-index: -10; position: relative; margin-top: -30px;">

<div class="container" id = "prikaz_pitanja" style = "margin-top: 60px; width: 60%;" >
<?php
$uk = sizeof($_SESSION['pitanja']);
$pitanjakviz = $_SESSION['pitanja'];
$odgovori = $_SESSION['izabran_odgovor'];

for($i = 0; $i<$uk; $i++)
{
?>
<table  style = "background: rgba(000, 000, 000, 0.4); width: 100%;" >
<tr align = "center">
<td >
<font color = "white" size = "3px">
  <label id = ""> <label id = "broj"> <font size="6px"> <?php $inc = $i+1; echo "$inc." ?></font></label>
</font>
</td>
</tr>
<tr align = "center">
<td>
<label id = "pitanje"> <font color = "white" style = "opacity: 2;"><i> <?php echo $pitanjakviz[$i]['tekstPitanja'] ?></i> </font></label>
</td>
</tr>


<tr>
<td>
<div class="form-group has-success has-feedback">
<input type="text" class="form-control" id="tacanKviz" style ="color: green;" value= '<?php echo $pitanjakviz[$i]['tacan']; ?>' disabled>
<span class="glyphicon glyphicon-ok form-control-feedback"></span>
</div>
</td>
</tr>

<?php if($pitanjakviz[$i]['tacan']==$odgovori[$i]) {?>
  <tr>
  <td>
  <div class="form-group has-success has-feedback">
  <input type="text" class="form-control" id="tacanKviz2" style ="color: green;" value= '<?php echo $odgovori[$i]; ?>' disabled>
  <span class="glyphicon glyphicon-ok form-control-feedback"></span>
  </div>
  </td>
  </tr>

<?php } else {?>
<tr>
<td>
<div class="form-group has-error has-feedback" >
<input type="text" class="form-control" id="pogresanIgrac" style ="color: red; opacity: 0.4"   value= "<?php echo $odgovori[$i]; ?>" disabled>
<span class="glyphicon glyphicon-remove form-control-feedback"></span>
</div>
</td>
</tr>

<?php } ?> <!--else-->


<tr>
<td  colspan = "4">

</td>
</tr>



</table>

<br /> <br /> <br />
<?php }
?>

<i>
  <?php  if(!empty ($_SESSION['poruka_preporuka']))
echo "<div style = 'background: #b000e6; opacity: 0.4; color: white;  font-weight: bold'>". $_SESSION['poruka_preporuka'] ."</div>";
?>
</i>
<br />
<br />
<br />


</div> <!--end_container-->
</body>
</html>
