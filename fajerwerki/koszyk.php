<?php
    session_start();
    $koszykID = $_SESSION['koszykID']??null;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username,$password,"fajerwerki");

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

    $query=mysqli_query($conn, "SELECT SUM(ilosc) FROM koszyk WHERE kod_koszyka = $koszykID");
    $row=mysqli_fetch_row($query);
    $przedmiotyKoszyk = "(".$row[0].")";

    $addProduct=$_POST["addProduct"]??null;
    $amountProduct=$_POST["amount"]??null;
    if($addProduct!=null && $amountProduct!=null)
    {
        if($amountProduct=="+1")
        {
            $query=mysqli_query($conn, "SELECT ilosc, stan_magazynowy FROM produkty, koszyk where koszyk.kod_produktu=produkty.kod_produktu AND kod_koszyka=$koszykID AND koszyk.kod_produktu='$addProduct'");
            $row=mysqli_fetch_row($query);
            if($row[1] > $row[0])
            {
                mysqli_query($conn, "UPDATE koszyk SET ilosc=ilosc+1 WHERE kod_koszyka=$koszykID AND kod_produktu = '$addProduct'");
            }
            else
            {
                mysqli_query($conn, "UPDATE koszyk SET ilosc=$row[1] WHERE kod_koszyka=$koszykID AND kod_produktu = '$addProduct'");
            }
        }
        else
        {
            $query=mysqli_query($conn, "SELECT ilosc, stan_magazynowy FROM produkty, koszyk where koszyk.kod_produktu=produkty.kod_produktu AND kod_koszyka=$koszykID AND koszyk.kod_produktu='$addProduct'");
            $row=mysqli_fetch_row($query);
            if($row[1] >= $row[0])
            {
                mysqli_query($conn, "UPDATE koszyk SET ilosc=ilosc-1 WHERE kod_koszyka=$koszykID AND kod_produktu = '$addProduct'");
            }
            else
            {
                mysqli_query($conn, "UPDATE koszyk SET ilosc=$row[1] WHERE kod_koszyka=$koszykID AND kod_produktu = '$addProduct'");
            }
            
            $query=mysqli_query($conn, "SELECT ilosc FROM koszyk WHERE kod_koszyka = $koszykID AND kod_produktu = '$addProduct'");
            $row=mysqli_fetch_row($query);
            if($row[0]==0) mysqli_query($conn, "DELETE FROM koszyk WHERE kod_koszyka=$koszykID AND kod_produktu = '$addProduct'");
        }
    }

    $query=mysqli_query($conn, "SELECT SUM(ilosc) FROM koszyk WHERE kod_koszyka = $koszykID");
    $row=mysqli_fetch_row($query);
    $przedmiotyKoszyk = "(".$row[0].")";

    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="koszyk.css" />
  <title>Kaboom🧨</title>
  <style>
    .log-items a
    {
        text-decoration: none;
        color: black;
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
        <a href="index.php"><img src="logo.png" alt="kaboom?" class="Rico"></a>
      </div>
      <div class="banner-item">
        <div class="search">
          <form action="kategorie.php/?kategoria=search" method="post">
            <input type="text" placeholder="Wpisz czego szukasz" name="searchplace" id="">
            <input type="submit" value="🔍"> 
          </form>
        </div>
        <div class="log">
          <div class="log-items"><a href="koszyk.php">Koszyk 🛒<?php if(isset($przedmiotyKoszyk)) echo $przedmiotyKoszyk; ?></a></div>
          <div class="log-items">Zarejestruj</div>
          <div class="log-items">Zaloguj</div>
        </div>
      </div>
    
      <div class="nav">
        <ul>
           <a href="index.php"><li class="titles">
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
      <a href="kategorie.php/?kategoria=all"><p class="titles">Asortyment</p></a>
        <ul>
           <a href="kategorie.php/?kategoria=petardy">
               <li class="point">
               Petardy
               </li>
           </a>
           <a href="kategorie.php/?kategoria=wyrzutnie">
               <li class="point">
               Wyrzutnie
                <!-- <div class="dropCont">
                  <a href="kategorie.php/?kategoria=wyrzutnie&kaliber=20">20mm</a>
                  <a href="kategorie.php/?kategoria=wyrzutnie&kaliber=30">30mm</a>
                  <a href="kategorie.php/?kategoria=wyrzutnie&kaliber=50">50mm</a>
                </div> -->
              </li>
          </a>
          <a href="kategorie.php/?kategoria=wulkany">
              <li class="point">
               Wulkany
              </li>
          </a>
          <a href="kategorie.php/?kategoria=dymy">
              <li class="point">
               Dymy
              </li>
          </a>
        </ul>
      </div>
      <div class="content">
       
        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $conn = new mysqli($servername, $username,$password,"fajerwerki");

          $z = "SELECT SUM(ilosc) FROM koszyk WHERE kod_koszyka = $koszykID";
          $querry=mysqli_query($conn,$z);
          $liczbaProduktowKoszyk=mysqli_fetch_row($querry)[0];
          echo "<p class='titles'>Twój koszyk<p>(ilość produktów: $row[0])</p></p>";

          if($liczbaProduktowKoszyk==0)
          {
              echo "<div class='cart-empty'><h1>Twój koszyk jest pusty</h2></div>";
          }

          $z="SELECT k.kod_produktu, nazwa, cena, obnizka, k.ilosc, stan_magazynowy, zdjecie FROM produkty p, koszyk k WHERE k.kod_produktu=p.kod_produktu AND kod_koszyka=$koszykID";
          $query=mysqli_query($conn,$z);
          
          while($row = mysqli_fetch_row($query))
          {
            $oznaczenie = $row[0];
            echo "<div class='cart-item'>
                    <a href='produkt.php/?produkt=$oznaczenie' />
                    <div class='cart-product-img'><img src='produkty/$row[6]' alt=''></div>
                    <div class='cart-product-name'><p>$row[1]</p></div>
                    <div class='cart-product-avaible'><p>($row[5] szt. w magazynie)</p></div>";
                    if($row[3]!=0)
                    {
                        $cena=number_format($row[2]-($row[2]*$row[3]/100), 2);
                        echo "<div class='cart-product-price'><p><span class='cart-product-price-1'>$cena zł/szt</span><br><span class='cart-product-price-2'><span>$row[2] zł</span> (-$row[3]%)</span></p></div>";
                    }
                    else
                    {
                        echo "<div class='cart-product-price'><p>$row[2] zł/szt</p></div>";
                    }
                    echo "<div class='cart-product-topay'>".number_format(($row[2]-($row[2]*$row[3]/100))*$row[4], 2)." zł</div>";
                    echo "<div class='cart-product-shopping'>
                        <form action='koszyk.php' method='post'><input type='hidden' name='addProduct' value='$oznaczenie'><input type='hidden' name='amount' value='-1'><input type='submit' value='-'></form>
                        <div class='cart-product-shopping-amount'>$row[4]</div>
                        <form action='koszyk.php' method='post'><input type='hidden' name='addProduct' value='$oznaczenie'><input type='hidden' name='amount' value='+1'><input type='submit' value='+'></form>
                    </div></a></div>";
          }

          $z="SELECT SUM(cena*ilosc), SUM((cena*(100-obnizka)/100)*ilosc), 1-(SUM((cena*(100-obnizka)/100)*ilosc)/SUM(cena*ilosc))  FROM produkty, koszyk WHERE koszyk.kod_produktu=produkty.kod_produktu AND kod_koszyka=$koszykID;";
          $query=mysqli_query($conn,$z);
          $row = mysqli_fetch_row($query);

          if(!$liczbaProduktowKoszyk==0)
          echo "<div class='cart-summary'>
                <div class='cart-summary-newprice'>".number_format($row[1], 2)." zł </div>
                <div class='cart-summary-pay'><a href='reset.php'>Zapłać</a></div>                
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
            <a href='produkt.php/?produkt=$a' />
            <div class='product-img'><img src='produkty/$row[11]' alt=''></div>
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