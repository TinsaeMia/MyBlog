<?php
require('C:/xampp/htdocs/blog/connectfooter.php');
$all_categories_query="SELECT * FROM categories";
$all_categories=mysqli_query($connection,$all_categories_query);

?>
<footer>
    <div class="footer_socials">
      <a href="https://www.facebook.com/" target="_blank"><i class="uil uil-facebook-f"></i></a>
      <a href="https://www.youtube.com/" target="_blank"><i class="uil uil-youtube"></i></a>
      <a href="https://www.instagram.com/" target="_blank"><i class="uil uil-instagram-alt"></i></a>
      <a href="https://www.linkedin.com/" target="_blank"><i class="uil uil-linkedin"></i></a>
      <a href="https://www.twitter.com/" target="_blank"><i class="uil uil-twitter"></i></a>
    </div>
    <div class="container footer_container">
      <article>
        <h4>Categories</h4>
        <ul>
        <?php while($category=mysqli_fetch_assoc($all_categories)):?>
          <li><a href="<?=ROOT_URL?>category-posts.php?id=<?=$category['id']//id of the category?>" >
     <?=$category['title']?>
   </a>
   <?php endwhile?>
        </ul>
      </article>
      <article>
        <h4>Support</h4>
        <ul>
          <li><a href="">Online Support</a></li>
          <li><a href="">Call Numbers</a></li>
          <li><a href="">Emails</a></li>
          <li><a href="">Social Support</a></li>
          <li><a href="">Location </a></li>
        </ul>
      </article>

      </article>
      <article>
        <h4>Permalinks</h4>
        <ul>
          <li><a href="<?=ROOT_URL?>">Home</a></li>
          <li><a href="<?=ROOT_URL?>blog.php">Blog </a></li>
          <li><a href="<?=ROOT_URL?>about.php">About</a></li>
          <li><a href="<?=ROOT_URL?>services.php">Services</a></li>
          <li><a href="<?=ROOT_URL?>contact.php">Contact </a></li>

        </ul>
      </article>
    </div>
    <div class="footer__copyright">
      <small>Copyright &copy;Tutorial</small>
    </div>
  </footer>



  <script src="<?= ROOT_URL?>js/main.js"></script>
</body>

</html>