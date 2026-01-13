<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username,$password,"fajerwerki");
    
    session_start();
    $koszykID = $_SESSION['koszykID']??null;

    $dodajDoKoszyka = $_POST["kod_produktu"]??null;
    if($koszykID==null)
    {
        while(true)
        {
            $_SESSION['koszykID'] = rand(0, 2147483647);
            $koszykID = $_SESSION['koszykID'];

            $z="SELECT COUNT(kod_koszyka) FROM koszyk WHERE kod_koszyka = $koszykID";
            $query=mysqli_query($conn,$z);
            $row=mysqli_fetch_row($query);

            if($row[0]==0) break;
        }
    }
    if($dodajDoKoszyka!=null)
    {
        $query=mysqli_query($conn, "SELECT COUNT(kod_produktu) FROM produkty WHERE kod_produktu = '$dodajDoKoszyka'");
        $row=mysqli_fetch_row($query);
        if($row[0]==1)
        {
            $query=mysqli_query($conn, "SELECT COUNT(kod_koszyka) FROM koszyk WHERE kod_koszyka = $koszykID AND kod_produktu = '$dodajDoKoszyka'");
            $row=mysqli_fetch_row($query);
            if($row[0]==0)
            {
                mysqli_query($conn, "INSERT INTO koszyk (kod_koszyka, kod_produktu, ilosc) VALUES ($koszykID, '$dodajDoKoszyka', 1)");
            }
            else
            {
                $query=mysqli_query($conn, "SELECT stan_magazynowy FROM produkty WHERE kod_produktu = '$dodajDoKoszyka'");
                $stan=mysqli_fetch_row($query);
                $query=mysqli_query($conn, "SELECT ilosc FROM koszyk WHERE kod_koszyka = $koszykID AND kod_produktu = '$dodajDoKoszyka'");
                $row=mysqli_fetch_row($query);
                if($row[0] < $stan[0])
                  mysqli_query($conn, "UPDATE koszyk SET ilosc=ilosc+1 WHERE kod_koszyka=$koszykID AND kod_produktu = '$dodajDoKoszyka'");
            }

            mysqli_close($conn);
            header("Location: ../produkt.php/?produkt=$dodajDoKoszyka");
            exit();
        }
      }
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
    // $query=mysqli_query($conn, "SELECT SUM(ilosc) FROM koszyk WHERE kod_koszyka = $koszykID");
    // $row=mysqli_fetch_row($query);
    // $przedmiotyKoszyk = "(".$row[0].")";
    mysqli_close($conn);
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
            <input type="text" placeholder="Wpisz czego szukasz" name="searchplace" id="">
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
           <a href="../index.php"><li class="titles">
           Strona główna
          </li></a>
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
      </div>
      <div class="content">
        <?php
          $a=$_GET["produkt"] ?? null;
          if($a==null)
          {
            return 0;
          }

          $servername = "localhost";
          $username = "root";
          $password = "";
          $conn = new mysqli($servername, $username,$password,"fajerwerki");

          $z="SELECT * FROM produkty WHERE kod_produktu = '$a'";
          $query=mysqli_query($conn,$z);
          $row=mysqli_fetch_row($query);
          echo "<div class='main-buy'>
                <div class='foto'><img src='../produkty/$row[11]' alt='Grafika produktu'></div>
                <div class='buy'>
                <div class=buy-name>
                <p>$row[1]</p>
                </div>
                <div class='buy-border'>
                <div class=buy-cart>";
            
            if($row[5]==0)
            {
               echo "<div class='buy-price'>
                        <p>$row[4] zł</p>
                        <div style='text-align:center;'>brutto/szt.</div>
                     </div>";
            }
            if($row[5]!=0)
            {
                $cena=($row[4]-($row[4]*$row[5]/100));
                
                echo "<div class='buy-price'>
                      <div class='buy-price-old'><span style='text-decoration: line-through;'>$row[4] zł</span>&nbsp;<span>(-$row[5]%)</span></div>
                       <div class='buy-price-new'>".number_format($cena,2)." zł </div>
                       <div style='text-align:center;clear:both;'>brutto/szt.</div>
                     </div>";
            }echo "
                     
                     <div class='buy-add'>
                        <form action='produkt.php' method='post'>
                            <input type='hidden' name='kod_produktu' value='$row[0]'>
                            <button class='buy-button' type='submit'><span>Do koszyka</span><span>🛒</span></button>
                        </form>
                     </div>
                </div>
                <div class='buy-info'>
                     <p>$row[6] szt. w magazynie</p>
                     <p>Darmowa i szybka dostawa</p>
                     <p>14 dni na łatwy zwrot</p>
                     <p>Bezpieczne zakupy</p>
                </div>
                </div>
                </div>
                </div>
            <div class='opis'>$row[7]<br>
            <hr>  
            <br>";

            if($row[12]!=null)
            {
              echo "<iframe width='560' height='315' src='$row[12]' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>";
            }
            echo "<table class='spec-table'>
              <tr>
                  <td><strong>Marka:</strong></td><td>$row[2]</td>
              </tr>
              <tr>
                  <td><strong>Kod produktu:</strong></td><td>$row[0]</td>
              </tr>
              <tr>
                  <td><strong>Kategoria CE:</strong></td><td>$row[10]</td>
              </tr>";
              if($row[3]=="wyrzutnie")
              {
                echo"<tr>
                  <td><strong>Kaliber:</strong></td><td>$row[9]mm</td>
                </tr>
                <tr>
                    <td><strong>Ilość strzałów:</strong></td><td>$row[8]</td>
                </tr>";
              }
             
            echo "</table>
          </div>";
          mysqli_close($conn);
        ?>
      </div> 
      <div class="bestsellers">
          <p class="bestsellers-name">Promocje</p>
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $conn = new mysqli($servername, $username,$password,"fajerwerki");
          $z="SELECT * FROM produkty ORDER BY obnizka DESC, nazwa LIMIT 3";
          $query=mysqli_query($conn,$z);
          while($row=mysqli_fetch_row($query))
          {
            $a=$row[0];
            echo "<div class='bestsellers-items'>
            <a href='../produkt.php/?produkt=$a' />
            <div class='product-img'><img src='../produkty/$row[11]' alt=''></div>
             <div class='product-name'><p>$row[1]</p></div>";
             
            $cena=number_format($row[4]-($row[4]*$row[5]/100), 2);
            if($row[5]!=0)
            {
              echo "<div class='product-price'><p><span class='product-price-1'>$cena zł</span>&nbsp;<span class='product-price-2'><span>$row[4] zł</span> (-$row[5]%)</span></p></div>
              </a></div>";
            }
            else
            {
              echo "<div class='product-price'><p>$row[4] zł</p></div>
              </a></div>";
            }
             
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