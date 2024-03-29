<?php

include '../functions.php';
include '../paymproc.php';
// header('Content-Type:application/json; charset=utf-8');

//$userId = urldecode(base64_decode($_GET['UserId']));

$userId = urldecode(base64_decode($_GET['UserId']));
// geting user info 
// 919
$UserInfo = getUserInputMem($userId);

// write a simple for loop

if ($UserInfo) : ?>

  <?php

  $UserName = $UserInfo['member_name'];
  $UserPhoneNum = $UserInfo['member_phone'];
  $ProductNum = $UserInfo['discount'];
  $UserTgId = $UserInfo['telegramID'];
  $UserTotalAmount = $UserInfo['total_price'];
  $UserProductID = $UserInfo['product_Id'];

  $selectedItem = GetSelection(intval($UserProductID));

  $Ch_title = $selectedItem['Title'];
  $Ch_quan = $selectedItem['size'];
  $Ch_prc = $selectedItem['price'];
  $Ch_amn = $selectedItem['price'];
  $Ch_type = $selectedItem['Description'];
  $Ch_Roast = $selectedItem['subscription_period'];
  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="css/snack.css">
    <link rel="stylesheet" href="css/three-dots.css">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Tomoca Coffee Shop</title>
  </head>

  <body>
    <div id="cover-spin"></div>
    <div class="BigContaier">


      <header>
        <img src="./images/logo.jpg" class="avatar" alt="Tomoca logo here" />
        <h2>Tomoca Coffee Shop</h2>
      </header>

      <section class="subContainer">

        <div class="Card">
          <div class="DelivHeader">
            <h3 class="cardTitle">Membership Information</h3>
            <!-- <img src="./images/eshi-express-removebg.png" class="Imglogo" alt="eshi express logo here" /> -->
          </div>
          <div class="CardBody">

            <div class="ListDiv">
              <div class="divForm">
                <label class="labelForm" for="fname">User name:</label><br />
                <input type="text" name="fname" value=<?php echo $UserName; ?> readonly /><br />
              </div>
              <div class="divForm">
                <label class="labelForm" for="Markuparea">Full name:</label><br />
                <input type="text" id="fullName" name="Markuparea" rows="4" cols="50" placeholder="Please enter full name"></input>
              </div>
              <div class="divForm">
                <label class="labelForm" for="Phname">Phone Number:</label><br />
                <input type="text" name="Phname" value=<?php echo $UserPhoneNum; ?> readonly /><br />
              </div>
              <div class="divForm">
                <label class="labelForm" for="Markuparea">email:</label><br />
                <input type="text" id="LocationComment" name="Markuparea" rows="4" cols="50" placeholder="Please enter email address"></input>
              </div>
            </div>

          </div>
        </div>
        <div class="Card">
          <h3 class="cardTitle">Membership Summary</h3>
          <div class="CardBody">
            <div class="imageCon">
              <img src="./images/500g2.jpg" class="productImg" alt="image here" />
            </div>
            <div class='ProductDetail'>
              <div class='ProductTitle'>

              </div>
              <div class='ProductCheck'>
                <p>Membership Type</p>
                <p><?php echo $Ch_type; ?></p>
              </div>
              <div class='ProductCheck'>
                <p>Duration Period</p>
                <p><?php echo $Ch_Roast;  ?> Months</p>
              </div>
              <div class='ProductCheck'>
                <p>Membership Price</p>
                <p> <?php echo $Ch_prc; ?> ETB</p>
              </div>
              <div class='ProductCheck'>
                <p>Total</p>
                <p> <?php echo $Ch_amn; ?> ETB</p>
              </div>

            </div>
            <hr />


            <div class="subTotal">
              <div class='ProductCheck'>
                <p>Membership summary</p>
                <p> <?php echo $ProductNum; ?> </p>
              </div>
              <div class='ProductCheck'>
                <p>Total Cost</p>
                <p> <?php echo $Ch_amn; ?> ETB</p>
              </div>
            </div>
          </div>
        </div>


        <div class="Btns">
          <button class="CancelBtn" id="btn-tb">Cancel Order</button>
          <button class="ConfirmBtn" type="submit" id="submit" name="submit" value="Submit">Confirm Order</button>

        </div>

        <ul class="social">
          <li>
            <a href="https://www.facebook.com/CaffeTomoca/"><img src="https://i.ibb.co/x7P24fL/facebook.png" /></a>
          </li>
          <li>
            <a href="https://twitter.com/caffeetomoca"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png" /></a>
          </li>
          <li>
            <a href="https://www.instagram.com/tomoca_coffee/?hl=en"><img src="https://i.ibb.co/ySwtH4B/instagram.png" /></a>
          </li>
        </ul>
      </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script>
    <!-- <script src="./telebirr.js"></script> -->
    <!-- <script>
      var today = new Date();
      var next_day = new Date();
      next_day.setDate(today.getDate() + 1);

      const datePicker = flatpickr("#date-picker", {
        minDate: next_day,
        maxDate: new Date().fp_incr(8)
      });
    </script> -->
    <script type="text/javascript">
      const cancel = document.querySelector('#btn-tb')
      cancel.addEventListener('click', async e => {
        e.preventDefault();
        await axios.post('Cancel.php', {
          action: 'cancel',
          userId: <?php echo $userId; ?>,
          userTgId: <?php echo $UserTgId ?>,

        }).then(res => {
          window.location.replace('https://t.me/TomTomChan');
        }).then(() => {
          window.href = 'https://t.me/TomTomChan'
        })
      })


      const LocationVal = document.getElementById('LocationComment')
      const fullName = document.getElementById('fullName')
      const SubmitPay = document.querySelector('#submit')

      var userAgent = window.navigator.userAgent.toLowerCase(),
        safari = /safari/.test(userAgent),
        ios = /iphone|ipod|ipad/.test(userAgent);

      if (ios) {
        if (safari) {
          //browser
          const ReturnIOS = "Schemes"
          const BodyIOS = "t.me/TomTomChan"
        } else if (!safari) {
          //webview
          const ReturnIOS = "Schemes"
          const BodyIOS = "t.me/TomTomChan"
        };
      } else {
        //not iOS
        const ReturnIOS = "PackageName"
        const BodyIOS = "t.me/TomTomChan"
      };


      SubmitPay.addEventListener('click', async e => {
        e.preventDefault();

        const type = SubmitPay.dataset.order;
        console.log(LocationVal.value);

        if (LocationVal.value == '' || fullName.value == '') {
          console.log("null")
          alert("Dear Customer Please insert your full name and email Address in the space provided. ")
        } else {
          // here 
          $('#cover-spin').show(0)
          await axios.post('Location.php', {
            action: 'submitemail',
            comment: LocationVal.value,
            nameFull: fullName.value,
            UID: <?php echo $userId; ?>
          }).then(async res => {
            console.log(res)
            await axios.post('SUBMITMEM.php', {
              action: 'submit',
              Money: <?php echo $userId; ?>
            }).then(res => {
              // to here
              $("#cover-spin").hide();
              let respo = JSON.parse(res.data)
              window.location.href = respo.data.toPayUrl
            })
          })
        }

      })
    </script>
  </body>

  </html>

<?php else : ?>

  <html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./style2.css?v=<?php echo time(); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  </head>

  <body>
    <div class="SmallCards">
      <div class="smallestcardsub">
        <h3>No Item Selected<h3>
            <hr />
            <p>Please go to the channel to select products</p>
            <div class="butn-go"><a href="https://t.me/TomTomChan"> <button>Back to Channel</button> </a></div>
      </div>
    </div>


  </body>

  </html>

<?php endif; ?>