<?php
include 'config.php';
include 'php/index.php';
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #collegeSuggestions {
            max-height: 200px;
            overflow-y: auto;
            display: none;
            position: absolute;
            z-index: 1000;
            width: 100%;
        }

        #collegeSuggestions li {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5 pt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center">Registration Form</h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="track" class="form-label">Track</label>
                        <select name="track" class="form-select" required>
                            <option value="ML">ML</option>
                            <option value="DL">DL</option>
                            <option value="WD">WD</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="college" class="form-label">College</label>
                        <input type="text" name="college" id="college" class="form-control" autocomplete="off" oninput="searchColleges()">
                        <ul id="collegeSuggestions" class="list-group position-absolute"></ul>
                    </div>

                    <div class="mb-3">
                        <label for="qualification" class="form-label">Qualification</label>
                        <input type="text" name="qualification" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="referral" class="form-label">Referral</label>
                        <select name="referral" class="form-select" required>
                            <option value="Friends">Friends</option>
                            <option value="Instagram">Instagram</option>
                            <option value="LinkedIn">LinkedIn</option>
                            <option value="College">College</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
