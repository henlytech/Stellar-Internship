<?php
include 'config.php';
include 'php/index.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="img/icon.png">
  <title>
    Internship Registration
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="pages/dashboard.html">
                <img src="img/logo.png" alt="Logo" style="height: 40px;"> 
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Home
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="pages/profile.html">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    About-Us
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="pages/sign-up.html">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Services
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="pages/sign-in.html">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Contact
                  </a>
                </li>
              </ul>
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a href="" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">Join Now</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-7">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome to Henly Tech!</h3>
                  <p class="mb-0">Join our internship program!</p>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your full name" aria-label="Full Name" required>
                            </div>

                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-select" aria-label="Gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                    
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" aria-label="Email" required>
                            </div>
                    
                    
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" aria-label="Phone" required>
                            </div>
                    
                            <div class="col-md-6">
                                <label for="track" class="form-label">Track</label>
                                <select name="track" class="form-select" aria-label="Track" required>
                                    <option value="WD">Web Development</option>
                                    <option value="ML">Machine Learning</option>
                                    <option value="DL">Deep Learning</option>
                                </select>
                            </div>
                    
                            <div class="col-md-6">
                                <label for="college" class="form-label">College</label>
                                <input type="text" name="college" class="form-control" placeholder="Enter your college name" aria-label="College" required>
                            </div>
                    
                            <div class="col-md-6">
                                <label for="qualification" class="form-label">Qualification</label>
                                <input type="text" name="qualification" class="form-control" placeholder="Enter your qualification" aria-label="Qualification" required>
                            </div>
                    
                            <div class="col-md-6">
                                <label for="referral" class="form-label">Referral</label>
                                <select name="referral" class="form-select" aria-label="Referral" required>
                                    <option value="Friends">Friends</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="College">College</option>
                                </select>
                            </div>
                    
                            <div class="col-md-6">
                                <label for="resume" class="form-label">Upload Resume</label>
                                <input type="file" name="resume" class="form-control" aria-label="Upload Resume" accept=".pdf,.doc,.docx" required>
                            </div>
                    
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                    <label class="form-check-label" for="agreeTerms">I agree to the terms and conditions</label>
                                </div>
                            </div>
                    
                            <div class="col-12 text-center">
                                <button type="submit" class="btn bg-gradient-info w-100 mt-2 mb-0">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    function searchColleges() {
        const input = document.getElementById('college').value;
        const suggestionBox = document.getElementById('collegeSuggestions');
        
        if (input.length > 0) {
            suggestionBox.style.display = 'block';
            
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'search_colleges.php?q=' + encodeURIComponent(input), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const colleges = JSON.parse(xhr.responseText);
                    suggestionBox.innerHTML = '';
                    
                    if (colleges.length > 0) {
                        colleges.forEach(college => {
                            const li = document.createElement('li');
                            li.classList.add('list-group-item');
                            li.textContent = college;
                            li.onclick = function() {
                                document.getElementById('college').value = college;
                                suggestionBox.style.display = 'none';
                            };
                            suggestionBox.appendChild(li);
                        });
                    } else {
                        const li = document.createElement('li');
                        li.classList.add('list-group-item');
                        li.textContent = 'No colleges found';
                        suggestionBox.appendChild(li);
                    }
                }
            };
            xhr.send();
        } else {
            suggestionBox.style.display = 'none';
        }
    }
</script>
  
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>