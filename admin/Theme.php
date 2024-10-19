<?php
include('C:/xampp/htdocs/blog/admin/partials/header.php');

?>


<input type="color" name="color" value="#6B4226"  id="color-picker" style="margin-top: 6rem;"> <button type="submit" id="setColorButton">choose</button>


<script>
  document.addEventListener('DOMContentLoaded', () => {
 const c=document.querySelector('#header');
 const colorPicker = document.getElementById('color-picker');
 const setColorButton = document.getElementById('setColorButton');
 setColorButton.addEventListener('click', () => {
    const selectedColor = colorPicker.value; // Get the color value
    document.c.style.backgroundColor = selectedColor; // Change the body's background color
});
});
  </script>














<?php
include('../partials/footer.php');
   ?>