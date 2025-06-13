<?php include 'app/views/shares/header.php'; ?>

<section class="vh-100 gradient-custom">
    <div class="container py-2 h-100">
        <div class="row d-flex justify-content-center align-items-center mt-4">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body px-4 py-3 text-center">
                        <form action="/NguyenHienThuc_2280603165_Bai5_API/account/checklogin" method="post">
                            <div class="mb-4">
                                <h3 class="fw-bold mb-3 text-uppercase">Login</h3>
                                <p class="text-white-50 mb-4 small">Please enter your login and password!</p>

                                <div class="form-outline form-white mb-3">
                                    <input type="text" name="username" class="form-control form-control-lg" required />
                                    <label class="form-label" for="typeEmailX">Username</label>
                                </div>

                                <div class="form-outline form-white mb-3">
                                    <input type="password" name="password" class="form-control form-control-lg" required />
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>

                                <p class="small mb-3">
                                    <a class="text-white-50" href="#!">Forgot password?</a>
                                </p>

                                <button class="btn btn-outline-light btn-lg px-4" type="submit">Login</button>

                                <div class="d-flex justify-content-center text-center mt-3">
                                    <a href="#!" class="text-white mx-2"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white mx-2"><i class="fab fa-twitter fa-lg"></i></a>
                                    <a href="#!" class="text-white mx-2"><i class="fab fa-google fa-lg"></i></a>
                                </div>
                            </div>

                            <div>
                                <p class="mb-0 small">
                                    Don't have an account?
                                    <a href="/NguyenHienThuc_2280603165_Bai5_API/account/register" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>
