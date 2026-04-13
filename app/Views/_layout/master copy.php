<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yoo Rental</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('public/assets/css/style.css') ?>" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="<?= base_url('assets/admin/images/logo1a.png') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/upload/css/style.css') ?>">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand brand-logo-mini" href="<?= base_url('admin/dashboard') ?>">
        <img src="<?= base_url('assets/admin/images/logo1a.png') ?>" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo" href="<?= base_url('admin/dashboard') ?>">
        <img src="<?= base_url('assets/admin/images/logo1b.png') ?>" alt="logo" />
      </a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item ms-3">
            <a href="<?= base_url('/login') ?>" class="login-btn-outline">Login</a>
          </li>
          <li class="nav-item ms-2">
            <a href="<?= base_url('/register') ?>" class="login-btn-outline">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Product Grid -->
  <?php /* <div class="container">
<div class="row g-4">

<!-- Product Card 1 -->
<?php if(!empty($products)){
foreach($products as $list){ ?>
<div class="col-sm-6 col-md-4 col-lg-3">
<div class="card h-100 text-center">
<a href="<?=base_url('product/'.$list->url)?>" style="text-decoration:none;">
<img src="<?= base_url('public/assets/upload/images/'.$list->image) ?>"
   class="img-fluid mx-auto d-block mt-3"
   alt="<?=$list->product_name?>"
   style="width: 120px; height: 120px; object-fit: contain;">
</a>
<div class="card-body d-flex flex-column">
<h5 class="card-title"><?=$list->product_name?></h5>
<p class="card-text text-success fw-bold">₹<?=$list->price?> <small class="text-muted">(<?=$list->unit.$list->measur?>)</small></p>
<button class="btn btn-warning mt-auto add-to-cart" data-pro_id="<?=$list->pro_id?>">Add to Cart</button>
</div>
</div>
</div>
<?php } }else{
echo '<p class="text-danger">Product not available</p>';
} ?>



</div>
</div> */ ?>

  <?= $this->renderSection("content"); ?>



  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JavaScript for Cart Count -->
  <script>
    var href = "<?= base_url('/checkout') ?>";
    $(".add-to-cart").click(function () {
      var pro_id = $(this).attr('data-pro_id');

      // alert(pro_id);
      if (pro_id) {
        $.ajax({
          type: 'post',
          url: "<?= base_url('/add_to_cart') ?>",
          data: { pro_id: pro_id },
          dataType: 'json',
          success: function (res) {
            console.log(res);
            if (res.result == 'success') {
              $("#cart-count").html(res.cartCount);
              $("#checkout").attr("href", href);
            } else {
              alert("Error:");
            }
          }
        });
      } else {
        return false;
      }
    });

  </script>
  <style>
    .login-btn-outline {
      border: 2px solid #4f46e5;
      color: #4f46e5;
      padding: 8px 18px;
      border-radius: 8px;
      text-decoration: none;
    }

    .login-btn-outline:hover {
      background: #4f46e5;
      color: #fff;
    }
  </style>
</body>

</html>