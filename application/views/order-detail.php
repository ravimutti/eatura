
<?php $user_data = $this->session->userdata('userdata');
$this->load->view('includes/header', array('user_data' => $user_data)); ?>

      <section class="o-detail-main">
         <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6509918.949550237!2d-123.79820902299119!3d37.184280336325216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9fe5f285e3d%3A0x8b5109a227086f55!2sCalifornia%2C%20USA!5e0!3m2!1sen!2sin!4v1604215488833!5m2!1sen!2sin" width="100%" height="380" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
         </div>
         <div class="timer"><h2>25</h2> <h6>min.s</h6></div>
         <div class="container">
            <div class="row">
            <div class="col-md-8 m-auto">
               <div class="o-detail-lft">
                  <div class="order-names">
                  <h2>Thank you for your order.</h2>
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
               <div class="order-table">
                  <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th>Product Name</th>
                          <th>Qty</th>
                          <th style="border-radius:0 5px 5px 0">Sub Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($order->orders as $key => $item): ?>
                             <tr>
                              <td><?=$item->item_name?></td>
                              <td><?=$item->item_qty?></td>
                              <td><?= formatPrice($item->item_price * $item->item_qty) ?> €</td>
                            </tr>
                        <?php endforeach ?>
                       
                                              
                      </tbody>
                  </table>
               </div>
               </div>
               <div class="procesing-sec">
                  <h3>Order Status</h3>
                  <ul>
                     <li><div class="process"><div class="tick <?= in_array($order->order_status,['Created','Processing','Accepted','Processing','Ready to delever']) ? 'done' : ''?> "><img src="images/tick.png" alt=""></div> <h5>Accepted</h5></div></li>
                     <li><div class="process"><div class="tick <?= in_array($order->order_status,['Processing','Accepted','Ready to delever']) ? 'done' : ''?>"><img src="images/tick.png" alt=""></div> <h5>Processing</h5></div></li>
                     <li><div class="process"><div class="tick <?= in_array($order->order_status,['Accepted','Processing','Ready to delever']) ? 'done' : ''?>"><img src="images/tick.png" alt=""></div> <h5>Ready to Deliver</h5></div></li>
                     <li><div class="process"><div class="tick <?= in_array($order->order_status,['Accepted','Processing','Ready to delever','Delivered']) ? 'done' : ''?>"><img src="images/tick.png" alt=""></div> <h5>Delivered</h5></div></li>
                  </ul>
               </div>
            </div>
         </div>
         </div>
      </section>
         
 <?php $this->load->view('includes/footer'); ?>