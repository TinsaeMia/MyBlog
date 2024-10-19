<?php
include 'partials/header.php';
?>
  <!--    ================CONGTACT======================================================== -->
    <!--   <section class=" section_extra-margin contacti"> -->
       <head>  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
     <link rel="stylesheet" href="http://localhost/blog/contact/contstyle.css">
     <script src="<?= ROOT_URL?>js/main.js"></script>


      
      </head>
      
      <section id="contact">
  
  <h1 class="section-header">Contact Us</h1>
  
  <div class="contact-wrapper">
  
  <!-- Left contact page --> 
    
    <form class="form-horizontal" role="form" name="contact" action="https://formsubmit.co/nardostatiana@gmail.com" method="post" >
       
      <div class="form-group">
        <div class="col-sm-12">
          <input type="text" class="form-control" id="name" placeholder="NAME" name="name" value="" required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12">
          <input type="email" class="form-control" id="email" placeholder="EMAIL" name="email" value="" required>
        </div>
      </div>
      
      <textarea class="form-control" rows="10" placeholder="MESSAGE" name="message" required></textarea>
      <button type="submit" class="btn " name="submit">Submit</button>
      <span id="msg"></span>
    </form>
    <span id="msg"></span>
  <!-- Left contact page --> 
    
      <div class="direct-contact-container">

        <ul class="contact-list">
          <li class="list-item"><i class="uil uil-map-marker"><span class="contact-text place">Adiss Ababa, Ethiopia</span></i></li>
          
          <li class="list-item"><i class="uil uil-phone"><span class="contact-text phone"><a href="tel:1-212-555-5555" title="Give us a call">+2517656687</a></span></i></li>
          
          <li class="list-item"><i class="uil uil-envelope"></i><span class="contact-text gmail"><a href="mailto:#" title="Send me an email">Gojo@gmail.com</a></span></i></li>
          
        </ul>

        <hr>
        <ul class="social-media-list">
          <li><a href="#" target="_blank" class="contact-icon">
          <i class="uil uil-github"></i></a>
          </li>
          <li><a href="#" target="_blank" class="contact-icon">
          <i class="uil uil-facebook-f"></i></a>
          </li>
          <li><a href="#" target="_blank" class="contact-icon">
          <i class="uil uil-twitter"></i></a>
          </li>
          <li><a href="#" target="_blank" class="contact-icon">
          <i class="uil uil-instagram-alt"></i></a>
          </li>       
        </ul>
        <hr>

        <div class="copyright">&copy; Gojo</div>

      </div>
    
  </div>
  
</section>  
  
  
