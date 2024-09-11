<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rangrasia Registration</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        .form-container {
            flex: 1;
            padding: 20px;
            background-color: #f4f4f4;
            border-right: 2px solid #ddd;
        }

        .content-container {
            flex: 1;
            padding: 20px;
            background-color: #fff;
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .content-container {
    width: 80%;
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

.content-container h2 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: #007BFF;
    border-bottom: 2px solid #007BFF;
    padding-bottom: 5px;
}

.highlight {
    font-size: 1rem;
    margin: 10px 0;
    line-height: 1.5;
    padding: 10px;
    background-color: #f9f9f9;
    border-left: 5px solid #007BFF;
}

p {
    margin: 10px 0;
    line-height: 1.6;
}

strong {
    color: #333;
}

ul {
    list-style: disc;
    padding-left: 20px;
    margin: 10px 0;
}

ul li {
    margin-bottom: 8px;
}

@media (max-width: 768px) {
    .content-container {
        width: 95%;
        padding: 15px;
    }
}
.notification {
    position: fixed;
    top: 10px; /* Adjust this value as needed to move the notification further down */
    left: 50%;
    transform: translateX(-50%);
    background-color: #333; /* Default background color */
    color: white; /* Default text color */
    padding: 15px 30px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    font-size: 16px;
    z-index: 1000;
    display: none; /* Hidden by default */
    }

    .notification.success {
        background-color: #28a745; /* Green for success */
    }

    .notification.error {
        background-color: #dc3545; /* Red for error */
    }
    </style>

<script>
function showNotification(message, type) {
    console.log(`Notification: ${message}, Type: ${type}`); // Debug statement
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.className = `notification ${type}`;
    notification.style.display = 'block';
    setTimeout(() => {
        notification.style.display = 'none';
    }, 5000); // Hide the notification after 5 seconds
}


function clearFormFields() {
    const form = document.querySelector('form');
    if (form) {
        form.reset(); // Clear all form fields
    }
}

window.onload = function() {
    clearFormFields(); // Clear form fields on page load

    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    
    if (status === 'success') {
        showNotification('Registration successful!', 'success');
    } else if (status === 'error') {
        showNotification('There was an error with your registration. Please try again.', 'error');
    }
    
    // Clear URL parameters to prevent form resubmission
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.pathname);
    }
};

window.onload = function() {
    // showNotification('This is a test notification!', 'success');
    
    clearFormFields(); // Clear form fields on page load

    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    
    if (status === 'success') {
        showNotification('Registration successful!', 'success');
    } else if (status === 'error') {
        showNotification('There was an error with your registration. Please try again.', 'error');
    }
    
    // Clear URL parameters to prevent form resubmission
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.pathname);
    }
};


</script>



</head>
<body>

<!-- Notification container -->
<div id="notification" class="notification"></div>

<div class="container">
    <div class="form-container">
        <h2>Rangrasia Registration</h2>
        <form action="register.php" method="POST" >
            
            <label for="fullName">Full Name*</label>
            <input type="text" name="fullName" id="fullName" required>

            <label for="email">Email*</label>
            <input type="email" name="email" id="email" required>

            <label for="mobileNumber">Mobile Number (Calling)*</label>
            <input type="tel" name="mobileNumber" id="mobileNumber" required>

            <label for="whatsappNumber">Mobile Number (WhatsApp)*</label>
            <input type="tel" name="whatsappNumber" id="whatsappNumber" required>

            <label for="residence">Place of Residence*</label>
            <select name="residence" id="residence" required onchange="toggleOtherInput('residence')">
                <option value="Dubai">Dubai</option>
                <option value="Sharjah">Sharjah</option>
                <option value="Abu Dhabi">Abu Dhabi</option>
                <option value="Ajman">Ajman</option>
                <option value="Umm-Al-Quawain">Umm-Al-Quawain</option>
                <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                <option value="Fujairah">Fujairah</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" name="residenceOther" id="residenceOther" placeholder="Please specify" style="display:none;">

            <label for="adults">Number of Adults including Children above 12 years old*</label>
            <select name="adults" id="adults" required onchange="toggleOtherInput('adults')">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" name="adultsOther" id="adultsOther" placeholder="Please specify" style="display:none;">

            <label for="kidsAbove6">Number of Kids above 6 and below 12 years old*</label>
            <select name="kidsAbove6" id="kidsAbove6" required onchange="toggleOtherInput('kidsAbove6')">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" name="kidsAbove6Other" id="kidsAbove6Other" placeholder="Please specify" style="display:none;">

            <label for="kidsBelow6">Number of Kids below 6 years old*</label>
            <select name="kidsBelow6" id="kidsBelow6" required onchange="toggleOtherInput('kidsBelow6')">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" name="kidsBelow6Other" id="kidsBelow6Other" placeholder="Please specify" style="display:none;">

            <label for="whatsappGroup">Are you part of our WhatsApp communication group? *</label>
            <select name="whatsappGroup" id="whatsappGroup" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>

            <label for="joinWhatsappGroup">If you are not part of our WhatsApp group, would you like to become a member of it?</label>
            <select name="joinWhatsappGroup" id="joinWhatsappGroup">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="Not Applicable">Not Applicable</option>
            </select>

            <label>Have you followed the below links for more updates?*</label>

            <div>
                <!-- Facebook Icon -->
                <a href="https://www.facebook.com/yourpage" target="_blank">
                    <img src="images/facebook.png" alt="Facebook Page" style="width: 50px; height: 50px; margin-right: 20px;">
                </a>

                <!-- Instagram Icon -->
                <a href="https://www.instagram.com/yourpage" target="_blank">
                    <img src="images/instagram.png" alt="Instagram Page" style="width: 50px; height: 50px; margin-right: 20px;">
                </a>

                <!-- YouTube Icon -->
                <a href="https://www.youtube.com/yourchannel" target="_blank">
                    <img src="images/youtube.png" alt="YouTube Channel" style="width: 50px; height: 50px;">
                </a>
            </div>

            <!-- Dropdown for Yes/No -->
            <div>
                <label for="socialMediaFollow">Have you followed the above social media pages?*</label>
                <select name="socialMediaFollow" id="socialMediaFollow" required>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>


            <label for="companyName">Please name the company/Business where you work *</label>
            <input type="text" name="companyName" id="companyName" required>

            <label for="suggestion">Any suggestion?</label>
            <textarea name="suggestion" id="suggestion" rows="4"></textarea>

            <button type="submit">Register</button>
        </form>
    </div>
    <script>
    function toggleOtherInput(selectId) {
        const selectElement = document.getElementById(selectId);
        const otherInputId = selectId + 'Other';
        const otherInput = document.getElementById(otherInputId);
        otherInput.style.display = selectElement.value === 'Other' ? 'block' : 'none';
    }
</script>

    <div class="content-container">
        <h2>Highlights of the Event</h2>
        <div class="highlight">
            • Beloved Shyam Darshan - मनभावन दरबार;
        </div>
        <div class="highlight">
            • Chappan Bhog Jhanki - छप्पन भोग झांकी;
        </div>
        <div class="highlight">
            • Renowned Bhajan singers Shri Raj Parik Ji and Smt. Reshmi Sharma Ji - राज पारीक जी और रेशमी शर्मा जी की जुगलबंदी;
        </div>
        <div class="highlight">
            • Renowned Musicians team Shri Naresh Poonia Ji - नरेश पुनिया जी की नागिन धुन;
        </div>
        <div class="highlight">
            • Special arrangements for kids' activities - बच्चों के खिलोनें;
        </div>
        <div class="highlight">
            • Delicious Shyam Prasad - श्याम प्रसाद.
        </div>
        <p>Everyone is warmly invited to this unique event. It is a wonderful opportunity for all Shyam Bhakats to come together, immerse in the devotional evening.</p>
        <p><strong>Date:</strong> 7th December 2024</p>
        <p><strong>Venue:</strong> Rashidiya Grand Ball Room, Movenpick Grand Al Bustan Hotel, Al Garhoud, Dubai</p>
        <p><strong>Time:</strong> 03:00 PM Onwards</p>
        <p><strong>Contact:</strong> +971 56 661 3171, +971 50 552 4049, +971 50 346 6919, +971 52 618 5050</p>
        <p><strong>Note:</strong></p>
        <ul>
            <li>Register only when you are sure to attend as the seats are limited and those can be allocated to another Bhakat;</li>
            <li>Registration is mandatory to attend;</li>
            <li>Please ensure that there are no duplicate entries;</li>
            <li>Once the registration form is filled your registration is confirmed, you need to carry a hard/digital copy of the mail received on your E-mail ID.</li>
        </ul>
    </div>
</div>

</body>
</html>
