<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username,$password,"fajerwerki");
    
    session_start();
    $koszykID = $_SESSION['koszykID']??null;
    if($koszykID!=null)
    {
      $query=mysqli_query($conn, "SELECT SUM(ilosc) FROM koszyk WHERE kod_koszyka = $koszykID");
      $row=mysqli_fetch_row($query);
      $przedmiotyKoszyk = $row[0];
    }
    else
    {
      unset($przedmiotyKoszyk);
    }
    mysqli_close($conn);
?>
<?php 
  $servername = "localhost";
  $username = "root";
  $password = "";
  $conn = new mysqli($servername, $username,$password,"fajerwerki");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <title>Kaboom🧨</title>
  <style>
    .log-items a
    {
        text-decoration: none;
        color: black;
        /* poprawic padding na .log-items */
    }
    .log-items a:hover
    {
        color: rgb(205, 0, 0);
    }
  </style>
</head>

<body>

  <div class="all">
    <div class="banner">
      <div class="logo">
        <a href="../index.php"><img src="../logo.png" alt="kaboom?" class="Rico"></a>
      </div>
      <div class="banner-item">
        <div class="search">
        <form action="../kategorie.php/?kategoria=search" method="post">
            <input type="text" placeholder="Wpisz czego szukasz" name="searchplace" id="" >
            <input type="submit" value="🔍"> 
          </form>
        </div>
        <div class="log">
          <div class="log-items"><a href="../koszyk.php">Koszyk 🛒<?php if(isset($przedmiotyKoszyk)) echo "(".$przedmiotyKoszyk.")"; ?></a></div>
          <div class="log-items">Zarejestruj</div>
          <div class="log-items">Zaloguj</div>
        </div>
      </div>
    
      <div class="nav">
        <ul>
          <li class="titles">
            <a href="../index.php">Strona główna</a>
          </li>
          <li class="titles">
            O nas
          </li>
          <li class="titles">
            Kontakt
          </li>
          <li class="titles">
            Sklepy stacjonarne
          </li>
        </ul>
      </div>
    </div>

    <div class="main">
      <div class="menu">
      <a href="../kategorie.php/?kategoria=all"><p class="titles">Asortyment</p></a>
        <ul>
           <a href="../kategorie.php/?kategoria=petardy">
               <li class="point">
               Petardy
               </li>
           </a>
           <a href="../kategorie.php/?kategoria=wyrzutnie">
               <li class="point">
               Wyrzutnie
                <!-- <div class="dropCont">
                  <a href="kategorie.php/?kategoria=wyrzutnie&kaliber=20">20mm</a>
                  <a href="kategorie.php/?kategoria=wyrzutnie&kaliber=30">30mm</a>
                  <a href="kategorie.php/?kategoria=wyrzutnie&kaliber=50">50mm</a>
                </div> -->
              </li>
          </a>
          <a href="../kategorie.php/?kategoria=wulkany">
              <li class="point">
               Wulkany
              </li>
          </a>
          <a href="../kategorie.php/?kategoria=dymy">
              <li class="point">
               Dymy
              </li>
          </a>
        </ul>
        <div class="filtry">
          <div>
            <section>
              <?php if($_GET["kategoria"]=="all"):?>
                <p class="titles-no-click">Filtry</p>
                <div>
                  <form action="../kategorie.php/?kategoria=all" method="post">
                    <div class="filtry-items">Cena:</div>
                    <input type="number" name="cena1" id="" value="<?php echo $_POST['cena1']??0 ?>"> - <input type="number" name="cena2" id="" value="<?php echo $_POST['cena2']??10000 ?>">
                    <br>
                    <div class="filtry-items">Marka:</div>
                    <?php 
                       $z="SELECT DISTINCT producent FROM produkty";
                       $querry=mysqli_query($conn,$z);
                       @$marka=$_POST['marka'];
                       while($row=mysqli_fetch_row($querry))
                       {
                          echo "<label><input type='checkbox' name='marka[]' value='$row[0]'"; 
                          if(isset($_POST["marka"])) 
                          {
                            foreach($marka as $value)
                            {
                              if($value==$row[0])
                              {
                                echo " checked";
                                break;
                              }
                            }
                          }
                          echo "> $row[0]</label><br>";
                       }
                    ?>
                    <div class="filtry-items"><input type="submit" value="Zastosuj"></div>                    
                  </form>
                </div>
              <?php elseif($_GET["kategoria"]=="petardy"): ?>
                <p class="titles-no-click">Filtry</p>
                <div>
                  <form action="../kategorie.php/?kategoria=petardy" method="post">
                    <div class="filtry-items">Cena:</div>
                      <input type="number" name="cena1" id="" value="<?php echo $_POST['cena1']??0 ?>"> - <input type="number" name="cena2" id="" value="<?php echo $_POST['cena2']??10000 ?>">
                      <br>
                      <div class="filtry-items">Marka:</div>
                      <?php 
                        $z="SELECT DISTINCT producent FROM produkty WHERE kategoria='$_GET[kategoria]'";
                        $querry=mysqli_query($conn,$z);
                        @$marka=$_POST['marka'];
                        while($row=mysqli_fetch_row($querry))
                        {
                            echo "<label><input type='checkbox' name='marka[]' value='$row[0]'"; 
                            if(isset($_POST["marka"])) 
                            {
                              foreach($marka as $value)
                              {
                                if($value==$row[0])
                                {
                                  echo " checked";
                                  break;
                                }
                              }
                            }
                            echo "> $row[0]</label><br>";
                        }
                      ?>
                      <div class="filtry-items"><input type="submit" value="Zastosuj"></div> 
                  </form>
                </div>
              <?php elseif($_GET["kategoria"]=="wyrzutnie"): ?>
                <p class="titles-no-click">Filtry</p>
                <div>
                  <form action="../kategorie.php/?kategoria=wyrzutnie" method="post">
                    <div class="filtry-items">Cena:</div>
                      <input type="number" name="cena1" id="" value="<?php echo $_POST['cena1']??0 ?>"> - <input type="number" name="cena2" id="" value="<?php echo $_POST['cena2']??10000 ?>">
                      <br>
                    <div class="filtry-items">Marka:</div>
                      <?php 
                        $z="SELECT DISTINCT producent FROM produkty WHERE kategoria='$_GET[kategoria]'";
                        $querry=mysqli_query($conn,$z);
                        @$marka=$_POST['marka'];
                        while($row=mysqli_fetch_row($querry))
                        {
                            echo "<label><input type='checkbox' name='marka[]' value='$row[0]'"; 
                            if(isset($_POST["marka"])) 
                            {
                              foreach($marka as $value)
                              {
                                if($value==$row[0])
                                {
                                  echo " checked";
                                  break;
                                }
                              }
                            }
                            echo "> $row[0]</label><br>";
                        }
                      ?>
                    <div class="filtry-items">Kaliber:</div>
                    <?php @$k=$_POST['kaliber'];?>
                    <label><input type="checkbox" name="kaliber[]" id="" value="20" 
                    <?php 
                        if(isset($_POST["kaliber"])) 
                        {
                          foreach($k as $v)
                          {
                            if($v==20)
                            {
                              echo "checked";
                              break;
                            }
                          }
                        }?> > 20mm</label><br>
                    <label><input type="checkbox" name="kaliber[]" id="" value="30"
                    <?php 
                        if(isset($_POST["kaliber"]))
                        {
                          foreach($k as $v)
                          {
                            if($v==30)
                            {
                              echo "checked";
                              break;
                            }
                          }
                        }  
                      ?> > 30mm</label> <br>
                    <label><input type="checkbox" name="kaliber[]" id="" value="50"
                    <?php 
                        if(isset($_POST["kaliber"])) 
                        {
                          foreach($k as $v)
                          {
                            if($v==50)
                            {
                              echo "checked";
                              break;
                            }
                          }
                        }
                      ?> > 50mm</label> <br>
                    <div class="filtry-items"><input type="submit" value="Zastosuj"></div> 
                  </form>
                </div>
              <?php elseif($_GET["kategoria"]=="wulkany"): ?>
                <p class="titles-no-click">Filtry</p>
                <div>
                  <form action="../kategorie.php/?kategoria=wulkany" method="post">
                  <div class="filtry-items">Cena:</div>
                    <input type="number" name="cena1" id="" value="<?php echo $_POST['cena1']??0 ?>"> - <input type="number" name="cena2" id="" value="<?php echo $_POST['cena2']??10000 ?>">
                      <br>
                      <div class="filtry-items">Marka:</div>
                      <?php 
                        $z="SELECT DISTINCT producent FROM produkty WHERE kategoria='$_GET[kategoria]'";
                        $querry=mysqli_query($conn,$z);
                        @$marka=$_POST['marka'];
                        while($row=mysqli_fetch_row($querry))
                        {
                            echo "<label><input type='checkbox' name='marka[]' value='$row[0]'"; 
                            if(isset($_POST["marka"])) 
                            {
                              foreach($marka as $value)
                              {
                                if($value==$row[0])
                                {
                                  echo " checked";
                                  break;
                                }
                              }
                            }
                            echo "> $row[0]</label><br>";
                        }
                      ?>
                      <div class="filtry-items"><input type="submit" value="Zastosuj"></div> 
                  </form>
                </div>
              <?php elseif($_GET["kategoria"]=="dymy"):?>
                <p class="titles-no-click">Filtry</p>
                <div>
                  <form action="../kategorie.php/?kategoria=dymy" method="post">
                  <div class="filtry-items">Cena:</div>
                    <input type="number" name="cena1" id="" value="<?php echo $_POST['cena1']??0 ?>"> - <input type="number" name="cena2" id="" value="<?php echo $_POST['cena2']??10000 ?>">
                      <br>
                      <div class="filtry-items">Marka:</div>
                      <?php 
                        $z="SELECT DISTINCT producent FROM produkty WHERE kategoria='$_GET[kategoria]'";
                        $querry=mysqli_query($conn,$z);
                        @$marka=$_POST['marka'];
                        while($row=mysqli_fetch_row($querry))
                        {
                            echo "<label><input type='checkbox' name='marka[]' value='$row[0]'"; 
                            if(isset($_POST["marka"])) 
                            {
                              foreach($marka as $value)
                              {
                                if($value==$row[0])
                                {
                                  echo " checked";
                                  break;
                                }
                              }
                            }
                            echo "> $row[0]</label><br>";
                        }
                      ?>
                      <div class="filtry-items"><input type="submit" value="Zastosuj"></div> 
                  </form>
                </div>
              <?php endif;?>
            </section>
          </div>
        </div>
      </div>
      <div class="content">
        <?php
          $search=$_POST["searchplace"] ?? null;

          $kategoria=$_GET["kategoria"] ?? "all";
          $cena1=$_POST["cena1"]??0;
          $cena2=$_POST["cena2"]??10000;

          switch ($kategoria) 
          {
            case "all":
              $z="SELECT COUNT(kod_produktu) FROM produkty WHERE ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2) ";
              if(isset($_POST["marka"]))
              {
                $marka=$_POST["marka"];
                $z.="AND (producent='$marka[0]'";
                for($i= 1; $i< count($marka); $i++)
                {
                  $z.=" OR producent='$marka[$i]'";
                }
                $z.=")";
              }
              $querry=mysqli_query($conn,$z);
              $row=mysqli_fetch_row($querry);
              echo "<p class='titles'>Wszystkie produkty<p>(ilość produktów: $row[0])</p></p>";
              $z="SELECT * FROM produkty WHERE ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2) ";
              if(isset($_POST["marka"]))
              {
                $marka=$_POST["marka"];
                $z.="AND (producent='$marka[0]'";
                for($i= 1; $i< count($marka); $i++)
                {
                  $z.=" OR producent='$marka[$i]'";
                }
                $z.=")";
              }
              $querry=mysqli_query($conn,$z);
              while($row=mysqli_fetch_row($querry))
              {
                $oznaczenie=$row[0];
                echo "<div class='category-item'>
                <a href='../produkt.php/?produkt=$oznaczenie' />
                <div class='category-product-img'><img src='../produkty/$row[11]' alt=''></div>
                <div class='category-product-name'><p>$row[1]</p></div>";
                
                $cena=number_format($row[4]-($row[4]*$row[5]/100), 2);
                if($row[5]!=0)
                {
                  echo "<div class='category-product-price'><p><span class='category-product-price-1'>$cena zł</span>&nbsp;<span class='category-product-price-2'><span>$row[4] zł</span> (-$row[5]%)</span></p></div>
                  </a></div>";
                }
                else
                {
                    echo "<div class='category-product-price'><p>$row[4] zł</p></div>
                    </a></div>";
                }
              }
              break;
            case "search":
              $z="SELECT COUNT(kod_produktu) FROM produkty WHERE  nazwa like '%$search%' AND ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2)";
              
              $querry=mysqli_query($conn,$z);
              $row=mysqli_fetch_row($querry);
              echo "<p class='titles'>Wyniki wyszukiwania dla: $search<p>(ilość produktów: $row[0])</p></p>";
              $z="SELECT * FROM produkty WHERE  nazwa like '%$search%' AND ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2)";
              
              $querry=mysqli_query($conn,$z);
              while($row=mysqli_fetch_row($querry))
              {
                $oznaczenie=$row[0];
                echo "<div class='category-item'>
                <a href='../produkt.php/?produkt=$oznaczenie' />
                <div class='category-product-img'><img src='../produkty/$row[11]' alt=''></div>
                <div class='category-product-name'><p>$row[1]</p></div>";
                
                $cena=number_format($row[4]-($row[4]*$row[5]/100), 2);
                if($row[5]!=0)
                {
                  echo "<div class='category-product-price'><p><span class='category-product-price-1'>$cena zł</span>&nbsp;<span class='category-product-price-2'><span>$row[4] zł</span> (-$row[5]%)</span></p></div>
                  </a></div>";
                }
                else
                {
                    echo "<div class='category-product-price'><p>$row[4] zł</p></div>
                    </a></div>";
                }
              }
              break;
            case "petardy":

              $z="SELECT COUNT(kod_produktu) FROM produkty WHERE  kategoria='$kategoria' AND ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2)";
              if(isset($_POST["marka"]))
              {
                $marka=$_POST["marka"];
                $z.="AND (producent='$marka[0]'";
                for($i= 1; $i< count($marka); $i++)
                {
                  $z.=" OR producent='$marka[$i]'";
                }
                $z.=")";
              }

              $querry=mysqli_query($conn,$z);
              $row=mysqli_fetch_row($querry);
              echo "<p class='titles'>$kategoria<p>(ilość produktów: $row[0])</p></p>";
              $z="SELECT * FROM produkty WHERE  kategoria='$kategoria' AND ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2)";
              if(isset($_POST["marka"]))
              {
                $marka=$_POST["marka"];
                $z.="AND (producent='$marka[0]'";
                for($i= 1; $i< count($marka); $i++)
                {
                  $z.=" OR producent='$marka[$i]'";
                }
                $z.=")";
              }

              $querry=mysqli_query($conn,$z);
              while($row=mysqli_fetch_row($querry))
              {
                $oznaczenie=$row[0];
                echo "<div class='category-item'>
                <a href='../produkt.php/?produkt=$oznaczenie' />
                <div class='category-product-img'><img src='../produkty/$row[11]' alt=''></div>
                <div class='category-product-name'><p>$row[1]</p></div>";
                
                $cena=number_format($row[4]-($row[4]*$row[5]/100), 2);
                if($row[5]!=0)
                {
                  echo "<div class='category-product-price'><p><span class='category-product-price-1'>$cena zł</span>&nbsp;<span class='category-product-price-2'><span>$row[4] zł</span> (-$row[5]%)</span></p></div>
                  </a></div>";
                }
                else
                {
                    echo "<div class='category-product-price'><p>$row[4] zł</p></div>
                    </a></div>";
                }
              }
              break;

            case "wyrzutnie":

              $z="SELECT COUNT(kod_produktu) FROM produkty WHERE  kategoria='$kategoria' AND ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2)";
              if(isset($_POST["marka"]))
              {
                $marka=$_POST["marka"];
                $z.="AND (producent='$marka[0]'";
                for($i= 1; $i< count($marka); $i++)
                {
                  $z.=" OR producent='$marka[$i]'";
                }
                $z.=")";
              }

              if(isset($_POST["kaliber"]))
              {
                $kaliber=$_POST["kaliber"];
                $z.="AND (kaliber=$kaliber[0]";
                for($i= 1; $i< count($kaliber); $i++)
                {
                  $z.=" OR kaliber=$kaliber[$i]";
                }
                $z.=")";
              }
              $querry=mysqli_query($conn,$z);
              $row=mysqli_fetch_row($querry);
              echo "<p class='titles'>$kategoria<p>(ilość produktów: $row[0])</p></p>";
              $z="SELECT * FROM produkty WHERE  kategoria='$kategoria' AND ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2)";
              if(isset($_POST["marka"]))
              {
                $marka=$_POST["marka"];
                $z.="AND (producent='$marka[0]'";
                for($i= 1; $i< count($marka); $i++)
                {
                  $z.=" OR producent='$marka[$i]'";
                }
                $z.=")";
              }

              if(isset($_POST["kaliber"]))
              {
                $kaliber=$_POST["kaliber"];
                $z.="AND (kaliber=$kaliber[0]";
                for($i= 1; $i< count($kaliber); $i++)
                {
                  $z.=" OR kaliber=$kaliber[$i]";
                }
                $z.=")";
              }
              $querry=mysqli_query($conn,$z);
              while($row=mysqli_fetch_row($querry))
              {
                $oznaczenie=$row[0];
                echo "<div class='category-item'>
                <a href='../produkt.php/?produkt=$oznaczenie' />
                <div class='category-product-img'><img src='../produkty/$row[11]' alt=''></div>
                <div class='category-product-name'><p>$row[1]</p></div>";
                
                $cena=number_format($row[4]-($row[4]*$row[5]/100), 2);
                if($row[5]!=0)
                {
                  echo "<div class='category-product-price'><p><span class='category-product-price-1'>$cena zł</span>&nbsp;<span class='category-product-price-2'><span>$row[4] zł</span> (-$row[5]%)</span></p></div>
                  </a></div>";
                }
                else
                {
                    echo "<div class='category-product-price'><p>$row[4] zł</p></div>
                    </a></div>";
                }
              }
              break;

              case "wulkany":
                $z="SELECT COUNT(kod_produktu) FROM produkty WHERE  kategoria='$kategoria' AND ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2)";
                if(isset($_POST["marka"]))
                {
                  $marka=$_POST["marka"];
                  $z.="AND (producent='$marka[0]'";
                  for($i= 1; $i< count($marka); $i++)
                  {
                    $z.=" OR producent='$marka[$i]'";
                  }
                  $z.=")";
                }

                $querry=mysqli_query($conn,$z);
                $row=mysqli_fetch_row($querry);
                echo "<p class='titles'>$kategoria<p>(ilość produktów: $row[0])</p></p>";
                $z="SELECT * FROM produkty WHERE  kategoria='$kategoria' AND ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2)";
                if(isset($_POST["marka"]))
                {
                $marka=$_POST["marka"];
                $z.="AND (producent='$marka[0]'";
                for($i= 1; $i< count($marka); $i++)
                {
                  $z.=" OR producent='$marka[$i]'";
                }
                $z.=")";
                }

                $querry=mysqli_query($conn,$z);
                while($row=mysqli_fetch_row($querry))
                {
                  $oznaczenie=$row[0];
                  echo "<div class='category-item'>
                  <a href='../produkt.php/?produkt=$oznaczenie' />
                  <div class='category-product-img'><img src='../produkty/$row[11]' alt=''></div>
                  <div class='category-product-name'><p>$row[1]</p></div>";
                  
                  $cena=number_format($row[4]-($row[4]*$row[5]/100), 2);
                  if($row[5]!=0)
                  {
                    echo "<div class='category-product-price'><p><span class='category-product-price-1'>$cena zł</span>&nbsp;<span class='category-product-price-2'><span>$row[4] zł</span> (-$row[5]%)</span></p></div>
                    </a></div>";
                  }
                  else
                  {
                      echo "<div class='category-product-price'><p>$row[4] zł</p></div>
                      </a></div>";
                  }
                }
                break;

              case "dymy":
                $z="SELECT COUNT(kod_produktu) FROM produkty WHERE  kategoria='$kategoria' AND ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2)";
                if(isset($_POST["marka"]))
                {
                  $marka=$_POST["marka"];
                  $z.="AND (producent='$marka[0]'";
                  for($i= 1; $i< count($marka); $i++)
                  {
                    $z.=" OR producent='$marka[$i]'";
                  }
                  $z.=")";
                }
                $querry=mysqli_query($conn,$z);
                $row=mysqli_fetch_row($querry);
                echo "<p class='titles'>$kategoria<p>(ilość produktów: $row[0])</p></p>";
                $z="SELECT * FROM produkty WHERE  kategoria='$kategoria' AND ((cena*(100-obnizka)/100)>=$cena1 AND (cena*(100-obnizka)/100)<=$cena2)";
                if(isset($_POST["marka"]))
                {
                  $marka=$_POST["marka"];
                  $z.="AND (producent='$marka[0]'";
                  for($i= 1; $i< count($marka); $i++)
                  {
                    $z.=" OR producent='$marka[$i]'";
                  }
                  $z.=")";
                }
                $querry=mysqli_query($conn,$z);
                while($row=mysqli_fetch_row($querry))
                {
                  $oznaczenie=$row[0];
                  echo "<div class='category-item'>
                  <a href='../produkt.php/?produkt=$oznaczenie' />
                  <div class='category-product-img'><img src='../produkty/$row[11]' alt=''></div>
                  <div class='category-product-name'><p>$row[1]</p></div>";
                  
                  $cena=number_format($row[4]-($row[4]*$row[5]/100), 2);
                  if($row[5]!=0)
                  {
                    echo "<div class='category-product-price'><p><span class='category-product-price-1'>$cena zł</span>&nbsp;<span class='category-product-price-2'><span>$row[4] zł</span> (-$row[5]%)</span></p></div>
                    </a></div>";
                  }
                  else
                  {
                      echo "<div class='category-product-price'><p>$row[4] zł</p></div>
                      </a></div>";
                  }
                }
                break;

            default:
              echo "<h1>Błąd!</h1>";
              break;
          }

          mysqli_close($conn);
          ?>
      </div>
    </div>
    <div class="stopka">
      <h1><span>Kaboom🧨 - Fajerwerki i środki pirotechniczne</span></h1>
      <p>
        Trudno wyobrazić sobie bardziej uroczyste i efektywne zakończenie roku niż to z użyciem różnorakich wystrzałowych gadżetów.
        <span> </span>
        <strong>Profesjonalne pokazy pirotechniczne</strong>
        <span> </span>
        to absolutny must have na sylwestra! Rozbryzgujące się na niebie fajerwerki z
        <span> </span>
        wyrzutni rakietnic
        <span> </span>są idealnym zwieńczeniem imprezy. Wszyscy są nimi oczarowani i wpatrują się w rozświetlone niebo. W
        <span> </span><strong>Kaboom🧨</strong><span> </span>
        znajdziesz
        <span> </span>
        <strong>profesjonalne fajerwerki na sylwestra</strong>
        <span> </span>
        oraz inne
        <span> </span>
        <strong>środki pirotechniczne w niskich cenach</strong>
        . Nie wydasz fortuny, a przy okazji nabędziesz dobrej jakości produkty.
      </p>
    </div>
  </div>

</body>

</html>