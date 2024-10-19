<?php
include 'partials/header.php';
?>
                                                                                                                                                                                                                                                                                                  
<link rel="stylesheet" href="<?=ROOT_URL?>about.css">
<section class="hero">
  <div class="heading">
    <br><br><br>
    <h1>About Us</h1>
  </div>
  <div class="container">
    <div class="hero-content">
      <h2>welcome to our </h2>
      <p>We are dedicated to providing a space for you to share your thoughts and ideas. Our mission is to empower individuals to express themselves creatively and connect with others through the written word. We believe that everyone has a unique story to tell, and our platform is designed to help you share that story with the world</p>
      <button class="cta-button" onclick="toogleDetails()" id="show">learn more</button>
      <button class="cta-button" style="display: none;" onclick="toogleDetails()" id="hide">Hide</button>
    </div>
    <div class="hero-image">
<!--       <img src="images/formula.png" alt=""> -->
    </div>
  </div>
</section> 
<section class="hero">
<div id="details" style="display:none;">
  <div class="container">
    <div class="hero-content">
      <h2>Our Mission</h2>
      <p>we offer a user friendly interface that makes posting and managing your content easy. Our community is supportive and engaged ensuring that your voice is heard</p>
      <h2>How We Help Our Clients</h2>
      <p>We provide tools and resources to help you grow your audience and connect with like-minded individuals. Our platform is designed to enhance your blogging experience, offering features like analytics and customization options</p>
      <h2>Our History </h2>
      <p>We are a newly starting blogging website, launched with the vision of creating a vibrant community for writers and readers alike. Our journey has just begun, and we are excited to grow together with you</p>
      <h2>Our Team</h2>
      <p>Our team is made up of passionate individuals who believe in the power of sharing ideas. We are committed to supporting our users every step of the way</p>
    </div>  
</div>
</section>
<script>
function toogleDetails(){
  var details=document.getElementById("details");
  var show=document.getElementById("show");
  var hide=document.getElementById("hide");
  if(details.style.display=="none"){
    details.style.display="block";
    hide.style.display="block";
    show.style.display="none";
  }
  else{
    details.style.display="none";
    show.style.display="block";
    hide.style.display="none";
  }
}
</script>

<!--       ----------------END OF ABOUT===== -->
  <!--<footer>-->
<?php
include 'partials/footer.php';
?>