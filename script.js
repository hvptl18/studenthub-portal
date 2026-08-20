// ===============================
// Registration Form Validation
// ===============================

// Handle form submission
document.getElementById("registrationForm").addEventListener("submit", function (e) {
  e.preventDefault(); // Stop default form submission
  let valid = true;   // Flag to track overall validation status

  // -------------------------------
  // Regex patterns for validation
  // -------------------------------
  const namePattern     = /^[A-Za-z\s]{3,}$/; // At least 3 letters
  const emailPattern    = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email format
  const mobilePattern   = /^[6-9]\d{9}$/; // 10 digits starting with 6–9
  const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=]).{8,}$/;
  // Password must include uppercase, lowercase, digit, special char, min length 8

  // -------------------------------
  // Name Validation
  // -------------------------------
  const name = document.getElementById("name").value.trim();
  if (!namePattern.test(name)) {
    document.getElementById("nameError").textContent = "Enter a valid name (min 3 letters).";
    valid = false;
  } else {
    document.getElementById("nameError").textContent = "";
  }

  // -------------------------------
  // Email Validation
  // -------------------------------
  const email = document.getElementById("email").value.trim();
  if (!emailPattern.test(email)) {
    document.getElementById("emailError").textContent = "Enter a valid email address.";
    valid = false;
  } else {
    document.getElementById("emailError").textContent = "";
  }

  // -------------------------------
  // Mobile Validation
  // -------------------------------
  const mobile = document.getElementById("mobile").value.trim();
  if (!mobilePattern.test(mobile)) {
    document.getElementById("mobileError").textContent = "Enter a valid 10-digit mobile number.";
    valid = false;
  } else {
    document.getElementById("mobileError").textContent = "";
  }

  // -------------------------------
  // Password Validation
  // -------------------------------
  const password = document.getElementById("password").value;
  if (!passwordPattern.test(password)) {
    document.getElementById("passwordError").textContent =
      "Password must be 8+ chars, include uppercase, lowercase, number & special char.";
    valid = false;
  } else {
    document.getElementById("passwordError").textContent = "";
  }

  // -------------------------------
  // Confirm Password Validation
  // -------------------------------
  const confirmPassword = document.getElementById("confirmPassword").value;
  if (password !== confirmPassword) {
    document.getElementById("confirmPasswordError").textContent = "Passwords do not match.";
    valid = false;
  } else {
    document.getElementById("confirmPasswordError").textContent = "";
  }

  // -------------------------------
  // Course Validation
  // -------------------------------
  if (document.getElementById("course").value === "") {
    document.getElementById("courseError").textContent = "Please select a course.";
    valid = false;
  } else {
    document.getElementById("courseError").textContent = "";
  }

  // -------------------------------
  // Year Validation
  // -------------------------------
  if (document.getElementById("year").value === "") {
    document.getElementById("yearError").textContent = "Please select a year.";
    valid = false;
  } else {
    document.getElementById("yearError").textContent = "";
  }

  // -------------------------------
  // Gender Validation
  // -------------------------------
  const gender = document.querySelector('input[name="gender"]:checked');
  if (!gender) {
    document.getElementById("genderError").textContent = "Please select your gender.";
    valid = false;
  } else {
    document.getElementById("genderError").textContent = "";
  }

  // -------------------------------
  // Terms Validation
  // -------------------------------
  if (!document.getElementById("terms").checked) {
    document.getElementById("termsError").textContent = "You must accept the terms.";
    valid = false;
  } else {
    document.getElementById("termsError").textContent = "";
  }

  // -------------------------------
  // Final Check
  // -------------------------------
  if (valid) {
    alert("Registration successful!");
    this.reset(); // Clear form after success
    document.getElementById("passwordStrength").value = 0; // Reset strength meter
  }
});

// ===============================
// Password Strength Meter
// ===============================
document.getElementById("password").addEventListener("input", function () {
  const strengthMeter = document.getElementById("passwordStrength");
  const val = this.value;
  let strength = 0;

  // Increment strength based on character types
  if (val.match(/[a-z]/)) strength++;
  if (val.match(/[A-Z]/)) strength++;
  if (val.match(/[0-9]/)) strength++;
  if (val.match(/[@#$%^&+=]/)) strength++;

  strengthMeter.value = strength; // Update meter value (0–4)
});
