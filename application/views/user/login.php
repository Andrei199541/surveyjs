<body class="background show-spinner">
<div class="fixed-background"></div>
<main>
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">

                        <p class=" text-white h2">MAGIC IS IN THE DETAILS</p>

                        <p class="white mb-0">
                            Please use your credentials to login.
                            <br>If you are not a member, please
                            <a href="<?php echo site_url('register');?>" class="white">register</a>.
                        </p>
                    </div>
                    <div class="form-side">
                        <a href="<?php echo site_url('main');?>">
                            <span class="logo-single"></span>
                        </a>
                        <h6 class="mb-4">Login</h6>
                        <label class="form-group has-float-label mb-4">
                            <input class="form-control" type="email" id="email" require />
                            <span>E-mail</span>
                        </label>

                        <label class="form-group has-float-label mb-4">
                            <input class="form-control" type="password" id="password" placeholder="" />
                            <span>Password</span>
                        </label>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="<?php echo site_url('forgot');?>">Forget password?</a>
                            <button class="btn btn-primary btn-lg btn-shadow loginBtn">LOGIN</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
