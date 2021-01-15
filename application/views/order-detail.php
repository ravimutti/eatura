<?php date_default_timezone_set('Europe/Berlin'); ?>
<script type="text/javascript">
let prepareCartItemArr = '<?= (count($this->cart->contents())) ? json_encode(array_values($this->cart->contents())) : json_encode(array())?>';
let restaurantPinCodes = '<?= json_encode(array())?>';
let currentPinCodeRow = '<?= json_encode([]) ?>';
let restaurantStatus = 1;
let errorMessageInCaseOfPinCode = '';
let byPassPickupCookie = 1;
</script>
<?php $user_data = $this->session->userdata('userdata');
$this->load->view('includes/header', array('user_data' => $user_data)); ?>

      <section class="o-detail-main">
         <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6509918.949550237!2d-123.79820902299119!3d37.184280336325216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9fe5f285e3d%3A0x8b5109a227086f55!2sCalifornia%2C%20USA!5e0!3m2!1sen!2sin!4v1604215488833!5m2!1sen!2sin" width="100%" height="380" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
         </div>
         <div class="timer"><h2><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></h2> <h6>min.s</h6></div>
         <div class="container">
            <div class="row">
            <div class="col-md-8 m-auto">
               <div class="o-detail-lft">
                  <div class="order-names">
                  <h2>Danke für Deine Bestellung.</h2>
						<div class="forget-order">
							<h5 class=m-0>Du hast etwas vergessen?</h5>
							<p > <a style="color:#56d042" class="font-weight-bold" href="<?=site_url().$this->input->cookie('uriRestaurant', true)?>">Neue Bestellung aufgeben</a>  </p>
						</div>
						<p>Ihre Bestellnummer: <span  class="font-weight-bold"><?=$order->order_id?></span> </p>
               <div class="comp-logo">
                  <div class="comp-left">
                      <div class="restro-logo">
                         <img src="<?php echo LOGOPATH . $order->restaurant->logo; ?>">
                      </div>
                      <h3><?php echo $order->restaurant->name; ?></h3>

                  </div>
                  <div class="comp-right"> <img src="<?php echo  base_url();?>assets/images/delivery-boy.gif" alt=""> </div>
               </div>
               </div>
               <div class="procesing-sec m-0 my-4">
                  <h3>Bestellstatus</h3>
                  <ul>
                     <li><div class="process"><div class="tick <?= in_array($order->order_status,['Created','Processing','Accepted','Processing','Ready to delever']) ? 'done' : ''?> "><img src="images/tick.png" alt=""></div> <h5>Bestelleingang</h5></div></li>
                     <li><div class="process"><div class="tick <?= in_array($order->order_status,['Processing','Accepted','Ready to delever']) ? 'done' : ''?>"><img src="images/tick.png" alt=""></div> <h5>Verarbeitung</h5></div></li>
                     <li><div class="process"><div class="tick <?= in_array($order->order_status,['Accepted','Processing','Ready to delever']) ? 'done' : ''?>"><img src="images/tick.png" alt=""></div> <h5>Lieferbereit</h5></div></li>
                     <li><div class="process"><div class="tick <?= in_array($order->order_status,['Accepted','Processing','Ready to delever','Delivered']) ? 'done' : ''?>"><img src="images/tick.png" alt=""></div> <h5>Ausgeliefert</h5></div></li>
                  </ul>
               </div>
               <div class="order-table">
                  <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th>Produktname</th>
                          <th>Anzahl</th>
                          <th style="border-radius:0 5px 5px 0">Zwischensumme</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $price = 0; foreach ($order->orders as $key => $item): ?>
                          <?php  $product_array = json_decode($item->product_add_ons); ?>
                             <tr>
                              <td>
                                <div class="">
                                  <p class="m-0">
                                    <?php if(trim($product_array->product->sku) !="") {?>
        														  <span class="product_sku"><?=$product_array->product->sku?></span>
        														<?php } ?>
                                    <?=$item->item_name?> <br>
                                    <small style="font-style:italic"><?=$product_array->product->addOnsString?></small>
                                  </p>
                                </div>
                              </td>
                              <td><?=$item->item_qty?></td>
                              <td><?= formatPrice($item->item_price * $item->item_qty) ?> €</td>
                            </tr>
                            <?php $price += $item->item_price * $item->item_qty ?>
                        <?php endforeach ?>
                          <tr>
                            <td></td>
                            <td>Zwischensumme</td>
                            <td><?=formatPrice($price)?> €</td>
                            
                          </tr>
                          <tr>
                            <td></td>
                            <td>Lieferkosten</td>
                            <td><?=formatPrice($order->delivery_charge)?> €</td>
                          </tr>
                            <tr>
                              <td></td>
                              <td> <b>Gesamt</b> </td>
                              <td> <?=formatPrice($price+$order->delivery_charge)?> €</td>
                            </tr>
                      </tbody>
                  </table>
               </div>
               </div>


            </div>
         </div>
         </div>
      </section>

 <?php $this->load->view('includes/footer',["pincodes" => $pincodes,"profile" => $order->restaurant,"subtotal" =>0,"cartCount" =>0,"checkout" =>true]);
 $mintuesToAdd = 25;
 if($order->pincode && isset($order->pincode->id) && trim($order->pincode->delivery_time) != "" ) {
   $mintuesToAdd = date('i',strtotime($order->pincode->delivery_time));
 }
 if($order->restaurant && isset($order->restaurant->userId) && trim($order->restaurant->minimum_order_time) != "" ) {
   $mintuesToAdd = date('i',strtotime($order->restaurant->minimum_order_time));
 }

 if($mintuesToAdd == "00")
    $mintuesToAdd = 25;
 ?>

<script type="text/javascript">

let mintuesToAdd = '<?= $mintuesToAdd?>';
let trackerTime = '<?= $trackerTime?>';
let start = '<?= strtotime("+$mintuesToAdd minutes", strtotime($trackerTime)); ?>';
var compareDate = new Date();
var endDate   = new Date(parseInt(start)*1000)

var timer;
timer = setInterval(function() {
  timeBetweenDates(endDate);
}, 1000);

function timeBetweenDates(toDate) {
  var dateEntered = toDate;
  var now = new Date();
  var difference = dateEntered.getTime() - now.getTime();

  if (difference <= 0) {

    // Timer done
    clearInterval(timer);

  } else {

    var seconds = Math.floor(difference / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    var days = Math.floor(hours / 24);

    hours %= 24;
    minutes %= 60;
    seconds %= 60;

    $(".timer").find('h2').text(minutes);
    // $("#seconds").text(seconds);
  }
}

</script>
