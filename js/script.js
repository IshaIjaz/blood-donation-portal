// Wait for DOM to load
document.addEventListener("DOMContentLoaded", function() {
    
    // ===== DARK MODE TOGGLE =====
    const themeToggle = document.getElementById("themeToggle");
    
    if(themeToggle) {
        // Check localStorage for saved theme
        if(localStorage.getItem("theme") === "dark") {
            document.body.classList.add("dark-mode");
            themeToggle.textContent = "☀️";
        }
        
        themeToggle.addEventListener("click", function() {
            document.body.classList.toggle("dark-mode");
            
            if(document.body.classList.contains("dark-mode")) {
                themeToggle.textContent = "☀️";
                localStorage.setItem("theme", "dark");
            } else {
                themeToggle.textContent = "🌙";
                localStorage.setItem("theme", "light");
            }
        });
    }
    
    // ===== CHARACTER COUNTER (Contact Page) =====
    const messageBox = document.getElementById("message");
    const countDisplay = document.getElementById("charCount");
    
    if(messageBox && countDisplay) {
        messageBox.addEventListener("keyup", function() {
            let count = this.value.length;
            countDisplay.innerText = count;
            
            // Color change based on length
            if(count > 400) {
                countDisplay.style.color = "red";
            } else if(count > 200) {
                countDisplay.style.color = "orange";
            } else {
                countDisplay.style.color = "green";
            }
        });
    }
    
    // ===== FORM VALIDATION (Register Page) =====
    const registerForm = document.querySelector("form[action='register.php']");
    
    if(registerForm) {
        registerForm.addEventListener("submit", function(e) {
            let isValid = true;
            let errorMessages = [];
            
            const name = document.getElementById("full_name")?.value.trim();
            const email = document.getElementById("email")?.value.trim();
            const phone = document.getElementById("phone")?.value.trim();
            const password = document.getElementById("password")?.value;
            const role = document.querySelector('input[name="role"]:checked')?.value;
            const bloodGroup = document.getElementById("blood_group")?.value;
            
            // Name validation
            if(!name || name.length < 3) {
                isValid = false;
                errorMessages.push("Name must be at least 3 characters");
            }
            
            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(!email || !emailPattern.test(email)) {
                isValid = false;
                errorMessages.push("Please enter a valid email address");
            }
            
            // Phone validation
            if(!phone || phone.length < 10) {
                isValid = false;
                errorMessages.push("Please enter a valid phone number");
            }
            
            // Password validation
            if(!password || password.length < 6) {
                isValid = false;
                errorMessages.push("Password must be at least 6 characters");
            }
            
            // Role validation
            if(!role) {
                isValid = false;
                errorMessages.push("Please select a role (Donor or Hospital)");
            }
            
            // Blood group validation for donors
            if(role === "Donor" && !bloodGroup) {
                isValid = false;
                errorMessages.push("Please select your blood group");
            }
            
            if(!isValid) {
                e.preventDefault();
                alert("Please fix these errors:\n• " + errorMessages.join("\n• "));
            }
        });
    }
    
    // ===== BLOOD GROUP FIELD TOGGLE (Register Page) =====
    const donorRadio = document.getElementById("role_donor");
    const hospitalRadio = document.getElementById("role_hospital");
    const bloodGroupField = document.getElementById("blood_group_field");
    
    if(donorRadio && hospitalRadio && bloodGroupField) {
        function toggleBloodGroupField() {
            if(donorRadio.checked) {
                bloodGroupField.style.display = "block";
                document.getElementById("blood_group").required = true;
            } else {
                bloodGroupField.style.display = "none";
                document.getElementById("blood_group").required = false;
            }
        }
        
        donorRadio.addEventListener("change", toggleBloodGroupField);
        hospitalRadio.addEventListener("change", toggleBloodGroupField);
        
        // Initial check
        toggleBloodGroupField();
    }
    
    // ===== TAB SWITCHING (Admin Dashboard) =====
    const tabBtns = document.querySelectorAll(".tab-btn");
    const tabContents = document.querySelectorAll(".tab-content");
    
    if(tabBtns.length > 0) {
        tabBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                // Remove active class from all buttons and contents
                tabBtns.forEach(b => b.classList.remove("active"));
                tabContents.forEach(c => c.classList.remove("active"));
                
                // Add active class to clicked button
                this.classList.add("active");
                
                // Show corresponding tab content
                const tabId = this.getAttribute("data-tab");
                document.getElementById(tabId).classList.add("active");
            });
        });
    }
    
    // ===== CONFIRM DELETE =====
    const deleteLinks = document.querySelectorAll(".delete-confirm");
    
    deleteLinks.forEach(link => {
        link.addEventListener("click", function(e) {
            if(!confirm("Are you sure you want to delete this item? This action cannot be undone.")) {
                e.preventDefault();
            }
        });
    });
    
    // ===== DONATE BLOOD BUTTON (Donor Dashboard) =====
    const donateBtn = document.getElementById("donateBtn");
    
    if(donateBtn) {
        donateBtn.addEventListener("click", function(e) {
            e.preventDefault();
            
            // Show loading state
            donateBtn.textContent = "Submitting...";
            donateBtn.disabled = true;
            
            // Simulate AJAX request (in real project, this would be a form submit)
            setTimeout(() => {
                alert("Donation request submitted! Waiting for admin approval.");
                donateBtn.textContent = "Donate Blood";
                donateBtn.disabled = false;
                
                // In real project, you would submit the form here
                // document.getElementById("donateForm").submit();
            }, 1000);
        });
    }
    
    // ===== REQUEST BLOOD BUTTON (Hospital Dashboard) =====
    const requestBtn = document.getElementById("requestBtn");
    
    if(requestBtn) {
        requestBtn.addEventListener("click", function(e) {
            e.preventDefault();
            
            const bloodGroup = document.getElementById("request_blood_group").value;
            const units = document.getElementById("request_units").value;
            
            if(!bloodGroup) {
                alert("Please select a blood group");
                return;
            }
            
            if(!units || units < 1) {
                alert("Please enter valid units");
                return;
            }
            
            // Show loading state
            requestBtn.textContent = "Submitting...";
            requestBtn.disabled = true;
            
            // Simulate AJAX request
            setTimeout(() => {
                alert("Blood request submitted! Waiting for admin approval.");
                requestBtn.textContent = "Submit Request";
                requestBtn.disabled = false;
            }, 1000);
        });
    }
});