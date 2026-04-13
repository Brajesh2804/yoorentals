<div id="slider" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="2000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url('assets/users/images/header1.jpeg') ?>" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/users/images/header2.png') ?>" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/users/images/header3.jpeg') ?>" class="d-block w-100">
            </div>
        </div>

        <!-- SEARCH BOX -->
        <div class="search-box">
            <div class="row g-2">
                <div class="col-md-3">
                    <select class="form-control">
                        <option>What do you want to rent?</option>
                        <option>Room</option>
                        <option>Car</option>
                        <option>Marriage Hall</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-3">
                    <select class="form-control">
                        <option>Select City</option>
                        <option>Delhi</option>
                        <option>Mumbai</option>
                        <option>Patna</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </div>
    </div>