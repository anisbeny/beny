<?php get_header() ?>
<main calass="page__404" style="
display:grid;
 place-items: center;
 height: 100vh;
  background-color: #000;
  color:#fff; ">


        <p style="
         font-family: italiana, serif;
  font-size: 150px;
  font-weight: 400;
  line-height: 1.1;">404</p>
        
    
    <p style=" font-size: 20px;">Wopsy, cette page n'existe pas 🛠️</p>
    <a href="<?php echo get_permalink(12); ?>" style="color: #fff;
font-size: 25px;
text-decoration: underline; font-weight: 600;">Accueil</a>
</div>
</main>
<?php get_footer(); 