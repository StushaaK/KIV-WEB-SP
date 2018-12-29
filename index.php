<!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="x-ua-compatible" content="ie=edge">
     <title>Konference</title>

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
     <link rel="stylesheet" href="css/master.css">

   </head>
   <body>

    <div id="wrapper">
      <!-- Sidebar -->

      <nav id="sidebar-wrapper">
        <a href="#">Domů</a>
        <a href="blog.php">Články</a>
        <a href="about.php">O Konferenci</a>
        <a href="login.php">Přihlásit se</a>
        <a href="register.php">Registrovat</a>
      </nav>



      <!-- Page content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div clas="row">
            <div class="col-lg-12">
              <div id="menu-toggle" onclick="toggleMenu(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
              </div>
              <div class="top-title">
                <img src="img/logo_bl.png" class="logo" alt="Logo">
  							<h1 class="animated infinite bounceInDown">TechSense</h1>
  							<h6 class="logo-title animated pulse">Co-operation is the best solution</h6>
						  </div>
              <div class="main-content">
                <img src="https://www.placecage.com/g/300/300" alt="placeholder">
                <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio eligendi itaque rem, sunt id assumenda molestiae deserunt dolore reprehenderit beatae nihil minima modi, saepe cupiditate ex reiciendis voluptates sequi dolor eaque, eum, laboriosam iusto consequatur. Voluptates accusamus, praesentium quasi, totam modi itaque. Hic animi dolorum nisi perspiciatis recusandae eaque inventore assumenda distinctio veritatis obcaecati illum, architecto quis maiores, in omnis enim velit voluptatem officiis eum ratione a. Cum molestiae dignissimos id officia, enim repellendus praesentium deleniti accusantium, pariatur culpa in laboriosam vitae magnam totam rerum voluptatibus, corrupti dolores quia dolore assumenda tempore ea reiciendis unde libero. In facere adipisci quasi totam numquam quo a, dolores atque libero tempore eaque quisquam officiis impedit est, omnis cum. Repudiandae consectetur repellendus voluptate iusto illo perferendis cum delectus alias expedita nostrum quae aperiam, tempore recusandae, obcaecati a doloremque nulla. Dignissimos quam assumenda autem recusandae, temporibus doloremque fugit illo deserunt sapiente dicta impedit dolore at magni, vero sunt cumque dolor velit a blanditiis voluptatibus eaque culpa voluptas corporis. Magnam expedita placeat quas, reiciendis at voluptatum perferendis quos officiis, labore tempore! Vel iure deserunt nemo maiores officia aperiam porro quisquam, repudiandae, laudantium voluptatum quia illo soluta omnis consectetur nobis, labore libero expedita tempora temporibus molestias quibusdam sed? Inventore modi, vel doloribus, reiciendis harum quae ullam sed ratione magni dignissimos facilis labore perspiciatis aut, est eius soluta animi eveniet delectus, incidunt dolor qui? Fugit rem aliquid dolor facilis tempore, consequatur animi reprehenderit labore repellendus, esse, quaerat. Saepe ab iure quo, culpa natus aperiam officia? Quod sequi odio incidunt recusandae dignissimos minima mollitia sit vero voluptates quis pariatur, similique explicabo, voluptas magni, ipsam quasi. Asperiores laudantium hic non maxime fuga id impedit provident temporibus ad esse mollitia, dolores nostrum est eaque quisquam, aspernatur dolore quas maiores saepe. Consequuntur aliquam hic est repudiandae commodi provident laborum vel, animi! Necessitatibus cum sed quod molestiae porro magnam voluptas dolores aliquid reiciendis quis ipsam quos, eos nostrum, delectus libero nam, quam rem exercitationem sequi adipisci. Quibusdam adipisci molestias architecto hic ducimus recusandae porro sint. Quam accusamus totam cumque error sit voluptates culpa, delectus reprehenderit praesentium rerum mollitia beatae illo nostrum sed laboriosam laborum alias eius! Voluptas incidunt porro sequi non libero dolorem dolore, voluptatibus magnam, molestiae praesentium asperiores accusamus facilis. Quo, officiis tempore est pariatur ab, id reprehenderit.
              </p>
            </div>
            </div>
          </div>
        </div>
      </div>

    </div>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>

     <!-- Menu script -->
     <script>
       $("#menu-toggle").click( function (e) {
         e.preventDefault();
         $("#wrapper").toggleClass("menuDisplayed");
       });

       function toggleMenu(x) {
        x.classList.toggle("change");
    }
     </script>

   </body>
 </html>
