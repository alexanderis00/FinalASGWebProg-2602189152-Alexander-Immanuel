<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-check-input:checked + .form-check-label::before {
            content: ''; 
            color: green;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Register</h1>
        <form id="mainForm" class="p-3 pt-5 pe-4 ps-4" action="{{ route('register.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputName1" name="name" aria-describedby="nameHelp" required autofocus>
                @if ($errors->has('name'))
                    <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                @if ($errors->has('password'))
                    <div class="text-danger mt-2">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select id="gender" name="gender" class="form-select" required>
                    <option value="selectOne">--Select one--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @if ($errors->has('gender'))
                    <div class="text-danger mt-2">{{ $errors->first('gender') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputMobile1" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="exampleInputMobile1" name="phone" aria-describedby="mobileHelp" pattern="\d*" title="Please enter only numbers" required>
                @if ($errors->has('phone'))
                    <div class="text-danger mt-2">{{ $errors->first('phone') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputUsername1" class="form-label">IG Username</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name="username" aria-describedby="igusernameHelp" required>
                @if ($errors->has('username'))
                    <div class="text-danger mt-2">{{ $errors->first('username') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Hobby</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Swimming" id="hobby1">
                    <label class="form-check-label" for="hobby1">Swimming</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Drinking" id="hobby2">
                    <label class="form-check-label" for="hobby2">Drinking</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Drawing" id="hobby3">
                    <label class="form-check-label" for="hobby3">Drawing</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Painting" id="hobby4">
                    <label class="form-check-label" for="hobby4">Painting</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Eating" id="hobby5">
                    <label class="form-check-label" for="hobby5">Eating</label>
                </div>
                @if ($errors->has('hobby'))
                    <div class="text-danger mt-2">{{ $errors->first('hobby') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Register</button>

            <div class="mt-3">
                <p>Already have an account? <a href="/login" class="btn btn-link">Login</a></p>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('mainForm').addEventListener('submit', function(event) {
            const checkboxes = document.querySelectorAll('input[name="hobby[]"]:checked');
            if (checkboxes.length < 3) {
                alert('Please select at least 3 hobbies.');
                event.preventDefault(); 
                return; 
            }
    
            const password = document.getElementById('exampleInputPassword1').value;
            const confirmPassword = document.getElementById('exampleInputPassword2').value;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                event.preventDefault(); 
                return; 
            }
    
            const genderSelect = document.getElementById('gender');
            const selectedGender = genderSelect.value;
    
            if (selectedGender === 'selectOne') {
                alert('Please select a valid gender.');
                event.preventDefault(); 
                return; 
            }
        });
    </script>    
</body>
</html>
