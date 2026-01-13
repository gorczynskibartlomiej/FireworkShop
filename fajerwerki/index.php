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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
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
          <div class="log-items"><a href="koszyk.php">Koszyk 🛒<?php if(isset($przedmiotyKoszyk)) echo "(".$przedmiotyKoszyk.")"; ?></a></div>
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
      <div class="content-main">
        <a href="https://www.youtube.com/watch?v=kRpHYhTI5Fg&ab_channel=tolopaccc" target="_blank">
          <img src="reklama.png" alt="reklama" id="Rico">
       </a>
      </div>

      <div class="bestsellers-main">
        <p class="bestsellers-name">Promocje:</p>

        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $conn = new mysqli($servername, $username,$password,"fajerwerki");

          $z="SELECT * FROM produkty ORDER BY obnizka DESC, nazwa LIMIT 8";
          
          $querry=mysqli_query($conn,$z);
          while($row=mysqli_fetch_row($querry))
          {
            $a=$row[0];
            echo "<div class='bestsellers-main-items'>
            <a href='produkt.php/?produkt=$a' />
            <div class='main-product-img'><img src='produkty/$row[11]' alt='Grafika produktu'></div>
             <div class='main-product-name'><p>$row[1]</p></div>";
             
             $cena=number_format($row[4]-($row[4]*$row[5]/100), 2);
             if($row[5]!=0)
             {
                echo "<div class='product-price'><p><span class='product-price-1'>$cena zł</span>&nbsp;<span class='product-price-2'><span>$row[4] zł</span> (-$row[5]%)</span></p></div>
                </a></div>";
             }
             else
             {
                echo "<div class='main-product-price'><p>$row[4] zł</p></div>
                </a></div>";
             }
             

          }
          mysqli_close($conn);
        ?>
        <p id="fix">a</p>
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